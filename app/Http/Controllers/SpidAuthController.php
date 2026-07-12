<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Datas\XotData;
use Themes\Sixteen\Events\SpidAuthenticated;
use Themes\Sixteen\Events\SpidLoggedOut;
use Themes\Sixteen\Services\SpidAuthService;

class SpidAuthController extends Controller
{
    public function __construct(
        protected SpidAuthService $spidService
    ) {}

    public function login(Request $request, string $provider): RedirectResponse
    {
        try {
            $level = (int) $request->query('level', 2);
            $returnUrl = SafeStringCastAction::cast($request->query('return_url', route('dashboard')));

            $providers = $this->spidService->getProviders();
            if (! isset($providers[$provider])) {
                throw new \InvalidArgumentException("Provider SPID '{$provider}' non supportato");
            }

            if (! in_array($level, [1, 2, 3], true)) {
                throw new \InvalidArgumentException("Livello SPID non valido: {$level}");
            }

            Log::info('SPID login initiated', [
                'provider' => $provider,
                'level' => $level,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->to($this->spidService->getLoginUrl($provider, $level, $returnUrl));
        } catch (\Exception $e) {
            Log::error('SPID login error', [
                'provider' => $provider,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')
                ->with('error', 'Errore durante l\'avvio dell\'autenticazione SPID. Riprova più tardi.');
        }
    }

    public function callback(Request $request): RedirectResponse
    {
        try {
            /** @var array<string, mixed> $userAttributes */
            $userAttributes = $this->spidService->processCallback($request);
            $user = $this->findOrCreateUser($userAttributes);

            Auth::login($user, true);

            Session::put('spid.authenticated', true);
            Session::put('spid.user_data', $userAttributes);

            event(new SpidAuthenticated($user, $userAttributes));

            Log::info('SPID authentication completed', [
                'user_id' => $user->id,
                'provider' => $userAttributes['provider'] ?? null,
                'fiscal_code' => $userAttributes['fiscal_code'] ?? null,
            ]);

            $returnUrl = SafeStringCastAction::cast(Session::pull('spid.return_url', route('dashboard')));

            return redirect()->to($returnUrl)
                ->with('success', 'Autenticazione SPID completata con successo.');
        } catch (\Exception $e) {
            Log::error('SPID callback error', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->spidService->logout();

            return redirect()->route('login')
                ->with('error', 'Errore durante l\'autenticazione SPID: '.$e->getMessage());
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();
            $userData = Session::get('spid.user_data');
            $provider = SafeStringCastAction::cast(Session::get('spid.provider'));

            if ($user instanceof User && is_array($userData) && $provider !== '') {
                $nameId = SafeStringCastAction::cast($userData['name_id'] ?? null);
                $sessionIndex = SafeStringCastAction::cast($userData['session_index'] ?? null);

                if ($nameId !== '' && $sessionIndex !== '') {
                    Log::info('SPID logout initiated', [
                        'user_id' => $user->id,
                        'provider' => $provider,
                    ]);

                    $logoutUrl = $this->spidService->getLogoutUrl($provider, $nameId, $sessionIndex);

                    Auth::logout();
                    $this->spidService->logout();
                    Session::invalidate();
                    Session::regenerateToken();

                    event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));

                    return redirect()->to($logoutUrl);
                }
            }

            Auth::logout();
            $this->spidService->logout();
            Session::invalidate();
            Session::regenerateToken();

            if ($user instanceof User && is_array($userData)) {
                event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));
            }

            return redirect()->route('home')
                ->with('success', 'Logout effettuato con successo.');
        } catch (\Exception $e) {
            Log::error('SPID logout error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

            Auth::logout();
            $this->spidService->logout();
            Session::invalidate();
            Session::regenerateToken();

            return redirect()->route('home')
                ->with('warning', 'Logout locale completato. Potrebbero essere necessarie operazioni aggiuntive.');
        }
    }

    public function singleLogout(Request $request): Response
    {
        try {
            $relayState = SafeStringCastAction::cast($request->input('RelayState'));

            Log::info('SPID SLO received', [
                'relay_state' => $relayState,
                'user_id' => Auth::id(),
            ]);

            if (Auth::check()) {
                $user = Auth::user();
                $userData = Session::get('spid.user_data', []);
                if (! is_array($userData)) {
                    $userData = [];
                }

                Auth::logout();
                $this->spidService->logout();
                Session::invalidate();

                if ($user instanceof User) {
                    event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));
                }
            }

            $sloResponse = $this->generateSloResponse($relayState);

            return response($sloResponse)
                ->header('Content-Type', 'text/xml');
        } catch (\Exception $e) {
            Log::error('SPID SLO error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response($this->generateSloErrorResponse(), 500)
                ->header('Content-Type', 'text/xml');
        }
    }

    public function metadata(): Response
    {
        try {
            $metadata = $this->spidService->getMetadata();

            return response($metadata)
                ->header('Content-Type', 'application/samlmetadata+xml')
                ->header('Content-Disposition', 'inline; filename="metadata.xml"');
        } catch (\Exception $e) {
            Log::error('SPID metadata generation error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            abort(500, 'Errore nella generazione del metadata');
        }
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function findOrCreateUser(array $attributes): User
    {
        $fiscalCode = SafeStringCastAction::cast($attributes['fiscal_code'] ?? null);
        if ($fiscalCode === '') {
            throw new \Exception('Codice fiscale mancante nei dati SPID');
        }

        $user = $this->resolveUserByAuthEmail($attributes, 'spid', $fiscalCode);
        if ($user instanceof User) {
            $this->updateUserFromSpid($user, $attributes);

            return $user;
        }

        return $this->createUserFromSpid($attributes, $fiscalCode);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function createUserFromSpid(array $attributes, string $fiscalCode): User
    {
        $email = $this->resolveAuthEmail($attributes, 'spid', $fiscalCode);

        /** @var class-string<User&Model> $userClass */
        $userClass = XotData::make()->getUserClass();

        /** @var User $user */
        $user = $userClass::query()->create([
            'name' => SafeStringCastAction::cast($attributes['name'] ?? ''),
            'first_name' => SafeStringCastAction::cast($attributes['name'] ?? ''),
            'last_name' => SafeStringCastAction::cast($attributes['surname'] ?? ''),
            'email' => $email,
            'phone' => SafeStringCastAction::cast($attributes['mobile'] ?? ''),
            'password' => Hash::make(Str::random(32)),
            'email_verified_at' => $email !== '' ? now() : null,
        ]);

        return $user;
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function updateUserFromSpid(User $user, array $attributes): void
    {
        $updateData = [];
        $name = SafeStringCastAction::cast($attributes['name'] ?? '');
        $surname = SafeStringCastAction::cast($attributes['surname'] ?? '');
        $email = SafeStringCastAction::cast($attributes['email'] ?? '');
        $mobile = SafeStringCastAction::cast($attributes['mobile'] ?? '');

        if ($name !== '' && $user->name !== $name) {
            $updateData['name'] = $name;
            $updateData['first_name'] = $name;
        }

        if ($surname !== '' && $user->last_name !== $surname) {
            $updateData['last_name'] = $surname;
        }

        if ($email !== '' && $user->email !== $email) {
            $updateData['email'] = $email;
            $updateData['email_verified_at'] = now();
        }

        if ($mobile !== '' && $user->phone !== $mobile) {
            $updateData['phone'] = $mobile;
        }

        if ($updateData !== []) {
            $user->update($updateData);
        }

        $user->touch();
    }

  /**
     * @param  array<string, mixed>  $attributes
     */
    protected function resolveUserByAuthEmail(array $attributes, string $provider, string $fiscalCode): ?User
    {
        $email = $this->resolveAuthEmail($attributes, $provider, $fiscalCode);
        /** @var class-string<User&Model> $userClass */
        $userClass = XotData::make()->getUserClass();

        $user = $userClass::query()->where('email', $email)->first();

        return $user instanceof User ? $user : null;
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function resolveAuthEmail(array $attributes, string $provider, string $fiscalCode): string
    {
        $email = SafeStringCastAction::cast($attributes['email'] ?? '');

        if ($email !== '') {
            return $email;
        }

        return $provider.'.'.$fiscalCode.'@noemail.local';
    }

    /**
     * @param  array<mixed, mixed>  $attributes
     * @return array<string, mixed>
     */
    protected function normalizeSessionAttributes(array $attributes): array
    {
        /** @var array<string, mixed> $normalized */
        $normalized = $attributes;

        return $normalized;
    }

    protected function generateSloResponse(string $relayState): string
    {
        unset($relayState);

        $responseId = 'res_'.bin2hex(random_bytes(16));
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');
        $entityId = SafeStringCastAction::cast(config('spid.entity_id'));

        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
               '<samlp:LogoutResponse xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL.
               '                      xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL.
               '                      ID="'.$responseId.'"'.PHP_EOL.
               '                      Version="2.0"'.PHP_EOL.
               '                      IssueInstant="'.$issueInstant.'">'.PHP_EOL.
               '  <saml:Issuer>'.$entityId.'</saml:Issuer>'.PHP_EOL.
               '  <samlp:Status>'.PHP_EOL.
               '    <samlp:StatusCode Value="urn:oasis:names:tc:SAML:2.0:status:Success"/>'.PHP_EOL.
               '  </samlp:Status>'.PHP_EOL.
               '</samlp:LogoutResponse>';
    }

    protected function generateSloErrorResponse(): string
    {
        $responseId = 'res_'.bin2hex(random_bytes(16));
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');
        $entityId = SafeStringCastAction::cast(config('spid.entity_id'));

        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
               '<samlp:LogoutResponse xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL.
               '                      xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL.
               '                      ID="'.$responseId.'"'.PHP_EOL.
               '                      Version="2.0"'.PHP_EOL.
               '                      IssueInstant="'.$issueInstant.'">'.PHP_EOL.
               '  <saml:Issuer>'.$entityId.'</saml:Issuer>'.PHP_EOL.
               '  <samlp:Status>'.PHP_EOL.
               '    <samlp:StatusCode Value="urn:oasis:names:tc:SAML:2.0:status:Responder"/>'.PHP_EOL.
               '  </samlp:Status>'.PHP_EOL.
               '</samlp:LogoutResponse>';
    }
}
