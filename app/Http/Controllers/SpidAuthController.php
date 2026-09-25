<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Controllers;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> edd328a (.)
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Themes\Sixteen\Events\SpidAuthenticated;
use Themes\Sixteen\Events\SpidLoggedOut;
use Themes\Sixteen\Models\User;
use Themes\Sixteen\Actions\SpidAuthAction;

/**
 * Controller per l'autenticazione SPID
 *
 * Gestisce il flusso completo di autenticazione SPID secondo le specifiche AGID
 */
class SpidAuthController extends Controller
{
    public function __construct(
        protected SpidAuthAction $spidService
    ) {}

    /**
     * Reindirizza al provider SPID per l'autenticazione
     */
=======
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

>>>>>>> edd328a (.)
    public function login(Request $request, string $provider): RedirectResponse
    {
        try {
            $level = (int) $request->query('level', 2);
<<<<<<< HEAD
            $returnUrl = $request->query('return_url', route('dashboard'));

            // Valida il provider
=======
            $returnUrl = SafeStringCastAction::cast($request->query('return_url', route('dashboard')));

>>>>>>> edd328a (.)
            $providers = $this->spidService->getProviders();
            if (! isset($providers[$provider])) {
                throw new \InvalidArgumentException("Provider SPID '{$provider}' non supportato");
            }

<<<<<<< HEAD
            // Valida il livello SPID
            if (! in_array($level, [1, 2, 3])) {
=======
            if (! in_array($level, [1, 2, 3], true)) {
>>>>>>> edd328a (.)
                throw new \InvalidArgumentException("Livello SPID non valido: {$level}");
            }

            Log::info('SPID login initiated', [
                'provider' => $provider,
                'level' => $level,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

<<<<<<< HEAD
            $loginUrl = $this->spidService->getLoginUrl($provider, $level, $returnUrl);

            return redirect()->to($loginUrl);
=======
            return redirect()->to($this->spidService->getLoginUrl($provider, $level, $returnUrl));
>>>>>>> edd328a (.)
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

<<<<<<< HEAD
    /**
     * Gestisce il callback dal provider SPID
     */
    public function callback(Request $request): RedirectResponse
    {
        try {
            // Processa la response SAML
            $userAttributes = $this->spidService->processCallback($request);

            // Trova o crea l'utente
            $user = $this->findOrCreateUser($userAttributes);

            // Effettua il login
            Auth::login($user, true);

            // Salva i dati SPID in sessione
            Session::put('spid.authenticated', true);
            Session::put('spid.user_data', $userAttributes);

            // Trigger evento
=======
    public function callback(Request $request): RedirectResponse
    {
        try {
            /** @var array<string, mixed> $userAttributes */
            $userAttributes = $this->spidService->processCallback($request);
            $user = $this->findOrCreateUser($userAttributes);

            Auth::login($user, true);

            Session::put('spid.authenticated', true);
            Session::put('spid.user_data', $userAttributes);

>>>>>>> edd328a (.)
            event(new SpidAuthenticated($user, $userAttributes));

            Log::info('SPID authentication completed', [
                'user_id' => $user->id,
<<<<<<< HEAD
                'provider' => $userAttributes['provider'],
                'fiscal_code' => $userAttributes['fiscal_code'],
            ]);

            // Redirect all'URL di ritorno
            $returnUrl = Session::pull('spid.return_url', route('dashboard'));
=======
                'provider' => $userAttributes['provider'] ?? null,
                'fiscal_code' => $userAttributes['fiscal_code'] ?? null,
            ]);

            $returnUrl = SafeStringCastAction::cast(Session::pull('spid.return_url', route('dashboard')));
>>>>>>> edd328a (.)

            return redirect()->to($returnUrl)
                ->with('success', 'Autenticazione SPID completata con successo.');
        } catch (\Exception $e) {
            Log::error('SPID callback error', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

<<<<<<< HEAD
            // Pulisci la sessione in caso di errore
=======
>>>>>>> edd328a (.)
            $this->spidService->logout();

            return redirect()->route('login')
                ->with('error', 'Errore durante l\'autenticazione SPID: '.$e->getMessage());
        }
    }

<<<<<<< HEAD
    /**
     * Gestisce il logout SPID
     */
=======
>>>>>>> edd328a (.)
    public function logout(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();
            $userData = Session::get('spid.user_data');
<<<<<<< HEAD
            $provider = Session::get('spid.provider');

            if ($user && $userData && $provider) {
                // Se abbiamo i dati per il Single Logout, usiamoli
                if (isset($userData['name_id']) && isset($userData['session_index'])) {
=======
            $provider = SafeStringCastAction::cast(Session::get('spid.provider'));

            if ($user instanceof User && is_array($userData) && $provider !== '') {
                $nameId = SafeStringCastAction::cast($userData['name_id'] ?? null);
                $sessionIndex = SafeStringCastAction::cast($userData['session_index'] ?? null);

                if ($nameId !== '' && $sessionIndex !== '') {
>>>>>>> edd328a (.)
                    Log::info('SPID logout initiated', [
                        'user_id' => $user->id,
                        'provider' => $provider,
                    ]);

<<<<<<< HEAD
                    $logoutUrl = $this->spidService->getLogoutUrl(
                        $provider,
                        $userData['name_id'],
                        $userData['session_index']
                    );

                    // Effettua logout locale
=======
                    $logoutUrl = $this->spidService->getLogoutUrl($provider, $nameId, $sessionIndex);

>>>>>>> edd328a (.)
                    Auth::logout();
                    $this->spidService->logout();
                    Session::invalidate();
                    Session::regenerateToken();

<<<<<<< HEAD
                    // Trigger evento
                    event(new SpidLoggedOut($user, $userData));

                    // Redirect al logout SPID
=======
                    event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));

>>>>>>> edd328a (.)
                    return redirect()->to($logoutUrl);
                }
            }

<<<<<<< HEAD
            // Fallback a logout locale se SLO non disponibile
=======
>>>>>>> edd328a (.)
            Auth::logout();
            $this->spidService->logout();
            Session::invalidate();
            Session::regenerateToken();

<<<<<<< HEAD
            if ($user && $userData) {
                event(new SpidLoggedOut($user, $userData));
=======
            if ($user instanceof User && is_array($userData)) {
                event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));
>>>>>>> edd328a (.)
            }

            return redirect()->route('home')
                ->with('success', 'Logout effettuato con successo.');
        } catch (\Exception $e) {
            Log::error('SPID logout error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

<<<<<<< HEAD
            // Forza logout locale in caso di errore
=======
>>>>>>> edd328a (.)
            Auth::logout();
            $this->spidService->logout();
            Session::invalidate();
            Session::regenerateToken();

            return redirect()->route('home')
                ->with('warning', 'Logout locale completato. Potrebbero essere necessarie operazioni aggiuntive.');
        }
    }

<<<<<<< HEAD
    /**
     * Gestisce il Single Logout (SLO) dal provider SPID
     */
    public function singleLogout(Request $request): Response
    {
        try {
            // Processa la richiesta SLO
            $logoutRequest = $request->input('SAMLRequest');
            $relayState = $request->input('RelayState');
=======
    public function singleLogout(Request $request): Response
    {
        try {
            $relayState = SafeStringCastAction::cast($request->input('RelayState'));
>>>>>>> edd328a (.)

            Log::info('SPID SLO received', [
                'relay_state' => $relayState,
                'user_id' => Auth::id(),
            ]);

<<<<<<< HEAD
            // Effettua logout se l'utente è loggato
            if (Auth::check()) {
                $user = Auth::user();
                $userData = Session::get('spid.user_data', []);
=======
            if (Auth::check()) {
                $user = Auth::user();
                $userData = Session::get('spid.user_data', []);
                if (! is_array($userData)) {
                    $userData = [];
                }
>>>>>>> edd328a (.)

                Auth::logout();
                $this->spidService->logout();
                Session::invalidate();

<<<<<<< HEAD
                event(new SpidLoggedOut($user, $userData));
            }

            // Genera response SLO
=======
                if ($user instanceof User) {
                    event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));
                }
            }

>>>>>>> edd328a (.)
            $sloResponse = $this->generateSloResponse($relayState);

            return response($sloResponse)
                ->header('Content-Type', 'text/xml');
        } catch (\Exception $e) {
            Log::error('SPID SLO error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

<<<<<<< HEAD
            // Response di errore
            $errorResponse = $this->generateSloErrorResponse();

            return response($errorResponse, 500)
=======
            return response($this->generateSloErrorResponse(), 500)
>>>>>>> edd328a (.)
                ->header('Content-Type', 'text/xml');
        }
    }

<<<<<<< HEAD
    /**
     * Fornisce i metadata SAML del Service Provider
     */
=======
>>>>>>> edd328a (.)
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
<<<<<<< HEAD
     * Trova o crea un utente basato sui dati SPID
     */
    protected function findOrCreateUser(array $attributes): User
    {
        $fiscalCode = $attributes['fiscal_code'];

        if (empty($fiscalCode)) {
            throw new \Exception('Codice fiscale mancante nei dati SPID');
        }

        // Cerca utente per codice fiscale
        $user = User::where('fiscal_code', $fiscalCode)->first();

        if ($user) {
            // Aggiorna i dati se necessario
=======
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
>>>>>>> edd328a (.)
            $this->updateUserFromSpid($user, $attributes);

            return $user;
        }

<<<<<<< HEAD
        // Crea nuovo utente
        return $this->createUserFromSpid($attributes);
    }

    /**
     * Crea un nuovo utente dai dati SPID
     */
    protected function createUserFromSpid(array $attributes): User
    {
        $userData = [
            'name' => $attributes['name'],
            'surname' => $attributes['surname'],
            'email' => $attributes['email'],
            'fiscal_code' => $attributes['fiscal_code'],
            'birth_date' => $attributes['birth_date'],
            'birth_place' => $attributes['birth_place'],
            'gender' => $attributes['gender'],
            'mobile_phone' => $attributes['mobile'],
            'address' => $attributes['address'],
            'spid_provider' => $attributes['provider'],
            'auth_method' => 'spid',
            'email_verified_at' => $attributes['email'] ? now() : null,
        ];

        // Genera email temporanea se mancante
        if (empty($userData['email'])) {
            $userData['email'] = 'spid.'.$attributes['fiscal_code'].'@noemail.local';
        }

        return User::create($userData);
    }

    /**
     * Aggiorna un utente esistente con i dati SPID
=======
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
>>>>>>> edd328a (.)
     */
    protected function updateUserFromSpid(User $user, array $attributes): void
    {
        $updateData = [];
<<<<<<< HEAD

        // Aggiorna campi se diversi
        if ($user->name !== $attributes['name']) {
            $updateData['name'] = $attributes['name'];
        }

        if ($user->surname !== $attributes['surname']) {
            $updateData['surname'] = $attributes['surname'];
        }

        if ($attributes['email'] && $user->email !== $attributes['email']) {
            $updateData['email'] = $attributes['email'];
            $updateData['email_verified_at'] = now();
        }

        if ($attributes['mobile'] && $user->mobile_phone !== $attributes['mobile']) {
            $updateData['mobile_phone'] = $attributes['mobile'];
        }

        // Aggiorna provider se diverso
        if ($user->spid_provider !== $attributes['provider']) {
            $updateData['spid_provider'] = $attributes['provider'];
        }

        // Aggiorna ultimo accesso
        $updateData['last_login_at'] = now();

        if (! empty($updateData)) {
            $user->update($updateData);
        }
    }

    /**
     * Genera risposta SLO di successo
     */
    protected function generateSloResponse(string $relayState): string
    {
        $responseId = 'res_'.bin2hex(random_bytes(16));
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');
=======
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
>>>>>>> edd328a (.)

        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
               '<samlp:LogoutResponse xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL.
               '                      xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL.
               '                      ID="'.$responseId.'"'.PHP_EOL.
               '                      Version="2.0"'.PHP_EOL.
               '                      IssueInstant="'.$issueInstant.'">'.PHP_EOL.
<<<<<<< HEAD
               '  <saml:Issuer>'.config('spid.entity_id').'</saml:Issuer>'.PHP_EOL.
=======
               '  <saml:Issuer>'.$entityId.'</saml:Issuer>'.PHP_EOL.
>>>>>>> edd328a (.)
               '  <samlp:Status>'.PHP_EOL.
               '    <samlp:StatusCode Value="urn:oasis:names:tc:SAML:2.0:status:Success"/>'.PHP_EOL.
               '  </samlp:Status>'.PHP_EOL.
               '</samlp:LogoutResponse>';
    }

<<<<<<< HEAD
    /**
     * Genera risposta SLO di errore
     */
=======
>>>>>>> edd328a (.)
    protected function generateSloErrorResponse(): string
    {
        $responseId = 'res_'.bin2hex(random_bytes(16));
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');
<<<<<<< HEAD
=======
        $entityId = SafeStringCastAction::cast(config('spid.entity_id'));
>>>>>>> edd328a (.)

        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
               '<samlp:LogoutResponse xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL.
               '                      xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL.
               '                      ID="'.$responseId.'"'.PHP_EOL.
               '                      Version="2.0"'.PHP_EOL.
               '                      IssueInstant="'.$issueInstant.'">'.PHP_EOL.
<<<<<<< HEAD
               '  <saml:Issuer>'.config('spid.entity_id').'</saml:Issuer>'.PHP_EOL.
=======
               '  <saml:Issuer>'.$entityId.'</saml:Issuer>'.PHP_EOL.
>>>>>>> edd328a (.)
               '  <samlp:Status>'.PHP_EOL.
               '    <samlp:StatusCode Value="urn:oasis:names:tc:SAML:2.0:status:Responder"/>'.PHP_EOL.
               '  </samlp:Status>'.PHP_EOL.
               '</samlp:LogoutResponse>';
    }
}
