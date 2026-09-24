<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Controllers;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> 464cfc5 (.)
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

>>>>>>> 464cfc5 (.)
    public function login(Request $request, string $provider): RedirectResponse
    {
        try {
            $level = (int) $request->query('level', 2);
<<<<<<< HEAD
            $returnUrl = $request->query('return_url', route('dashboard'));

            // Valida il provider
=======
            $returnUrl = SafeStringCastAction::cast($request->query('return_url', route('dashboard')));

>>>>>>> 464cfc5 (.)
            $providers = $this->spidService->getProviders();
            if (! isset($providers[$provider])) {
                throw new \InvalidArgumentException("Provider SPID '{$provider}' non supportato");
            }

<<<<<<< HEAD
            // Valida il livello SPID
            if (! in_array($level, [1, 2, 3])) {
=======
            if (! in_array($level, [1, 2, 3], true)) {
>>>>>>> 464cfc5 (.)
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
>>>>>>> 464cfc5 (.)
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

>>>>>>> 464cfc5 (.)
            event(new SpidAuthenticated($user, $userAttributes));

            Log::info('SPID authentication completed', [
                'user_id' => $user->id,
<<<<<<< HEAD
                'provider' => $userAttributes['provider'],
                'fiscal_code' => $userAttributes['fiscal_code'],
            ]);

            // Redirect all'URL di ritorno
<<<<<<< HEAD
            $returnUrl = Session::pull('spid.return_url');
            $returnUrl = is_string($returnUrl) && $returnUrl !== '' ? $returnUrl : route('dashboard');
=======
            $returnUrl = Session::pull('spid.return_url', route('dashboard'));
=======
                'provider' => $userAttributes['provider'] ?? null,
                'fiscal_code' => $userAttributes['fiscal_code'] ?? null,
            ]);

            $returnUrl = SafeStringCastAction::cast(Session::pull('spid.return_url', route('dashboard')));
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)

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
>>>>>>> 464cfc5 (.)
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
>>>>>>> 464cfc5 (.)
    public function logout(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();
<<<<<<< HEAD
            $sessionUserData = Session::get('spid.user_data');
            $userData = is_array($sessionUserData) ? $sessionUserData : null;
            $sessionProvider = Session::get('spid.provider');
            $provider = is_string($sessionProvider) ? $sessionProvider : null;
=======
            $userData = Session::get('spid.user_data');
<<<<<<< HEAD
            $provider = Session::get('spid.provider');
>>>>>>> 9e18142 (.)

            if ($user !== null && $userData !== null && $provider !== null) {
                // Se abbiamo i dati per il Single Logout, usiamoli
<<<<<<< HEAD
                $nameId = $userData['name_id'] ?? null;
                $sessionIndex = $userData['session_index'] ?? null;

                if (is_string($nameId) && is_string($sessionIndex)) {
=======
                if (isset($userData['name_id']) && isset($userData['session_index'])) {
=======
            $provider = SafeStringCastAction::cast(Session::get('spid.provider'));

            if ($user instanceof User && is_array($userData) && $provider !== '') {
                $nameId = SafeStringCastAction::cast($userData['name_id'] ?? null);
                $sessionIndex = SafeStringCastAction::cast($userData['session_index'] ?? null);

                if ($nameId !== '' && $sessionIndex !== '') {
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
                    Log::info('SPID logout initiated', [
                        'user_id' => $user->id,
                        'provider' => $provider,
                    ]);

<<<<<<< HEAD
                    $logoutUrl = $this->spidService->getLogoutUrl(
                        $provider,
                        $nameId,
                        $sessionIndex
                    );

                    // Effettua logout locale
=======
                    $logoutUrl = $this->spidService->getLogoutUrl($provider, $nameId, $sessionIndex);

>>>>>>> 464cfc5 (.)
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

>>>>>>> 464cfc5 (.)
                    return redirect()->to($logoutUrl);
                }
            }

<<<<<<< HEAD
            // Fallback a logout locale se SLO non disponibile
=======
>>>>>>> 464cfc5 (.)
            Auth::logout();
            $this->spidService->logout();
            Session::invalidate();
            Session::regenerateToken();

<<<<<<< HEAD
            if ($user !== null && $userData !== null) {
=======
<<<<<<< HEAD
            if ($user && $userData) {
>>>>>>> 9e18142 (.)
                event(new SpidLoggedOut($user, $userData));
=======
            if ($user instanceof User && is_array($userData)) {
                event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));
>>>>>>> 464cfc5 (.)
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
>>>>>>> 464cfc5 (.)
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
<<<<<<< HEAD
            $relayState = $request->string('RelayState')->toString();
=======
            $relayState = $request->input('RelayState');
=======
    public function singleLogout(Request $request): Response
    {
        try {
            $relayState = SafeStringCastAction::cast($request->input('RelayState'));
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)

            Log::info('SPID SLO received', [
                'relay_state' => $relayState,
                'user_id' => Auth::id(),
            ]);

<<<<<<< HEAD
            // Effettua logout se l'utente è loggato
            if (Auth::check()) {
                $user = Auth::user();
<<<<<<< HEAD
                $sessionUserData = Session::get('spid.user_data', []);
                $userData = is_array($sessionUserData) ? $sessionUserData : [];
=======
                $userData = Session::get('spid.user_data', []);
=======
            if (Auth::check()) {
                $user = Auth::user();
                $userData = Session::get('spid.user_data', []);
                if (! is_array($userData)) {
                    $userData = [];
                }
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)

                Auth::logout();
                $this->spidService->logout();
                Session::invalidate();

<<<<<<< HEAD
                if ($user !== null) {
                    event(new SpidLoggedOut($user, $userData));
                }
=======
<<<<<<< HEAD
                event(new SpidLoggedOut($user, $userData));
>>>>>>> 9e18142 (.)
            }

            // Genera response SLO
=======
                if ($user instanceof User) {
                    event(new SpidLoggedOut($user, $this->normalizeSessionAttributes($userData)));
                }
            }

>>>>>>> 464cfc5 (.)
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
>>>>>>> 464cfc5 (.)
                ->header('Content-Type', 'text/xml');
        }
    }

<<<<<<< HEAD
    /**
     * Fornisce i metadata SAML del Service Provider
     */
=======
>>>>>>> 464cfc5 (.)
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
     *
     * @param  array<string, mixed>  $attributes
     */
    protected function findOrCreateUser(array $attributes): UserContract
    {
        $fiscalCode = $attributes['fiscal_code'] ?? null;

        if (! is_string($fiscalCode) || $fiscalCode === '') {
            throw new \Exception('Codice fiscale mancante nei dati SPID');
        }

        // Cerca utente per codice fiscale
        $userClass = XotData::make()->getUserClass();
        $user = $userClass::where('fiscal_code', $fiscalCode)->first();

        if ($user instanceof UserContract) {
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
>>>>>>> 464cfc5 (.)
            $this->updateUserFromSpid($user, $attributes);

            return $user;
        }

<<<<<<< HEAD
        if ($user !== null) {
            Log::error('SPID: existing user record does not implement UserContract', [
                'user_class' => $user::class,
                'fiscal_code' => $fiscalCode,
            ]);
        }

=======
<<<<<<< HEAD
>>>>>>> 9e18142 (.)
        // Crea nuovo utente
        return $this->createUserFromSpid($attributes);
    }

    /**
     * Crea un nuovo utente dai dati SPID
     *
     * @param  array<string, mixed>  $attributes
     */
    protected function createUserFromSpid(array $attributes): UserContract
    {
        $fiscalCode = $attributes['fiscal_code'] ?? null;

        if (! is_string($fiscalCode) || $fiscalCode === '') {
            throw new \Exception('Codice fiscale mancante nei dati SPID');
        }

        $email = $attributes['email'] ?? null;
        $emailIsValid = is_string($email) && $email !== '';

        $userData = [
            'name' => $attributes['name'] ?? null,
            'surname' => $attributes['surname'] ?? null,
            'email' => $emailIsValid ? $email : null,
            'fiscal_code' => $fiscalCode,
            'birth_date' => $attributes['birth_date'] ?? null,
            'birth_place' => $attributes['birth_place'] ?? null,
            'gender' => $attributes['gender'] ?? null,
            'mobile_phone' => $attributes['mobile'] ?? null,
            'address' => $attributes['address'] ?? null,
            'spid_provider' => $attributes['provider'] ?? null,
            'auth_method' => 'spid',
            'email_verified_at' => $emailIsValid ? now() : null,
        ];

        // Genera email temporanea se mancante
        if (empty($userData['email'])) {
            $userData['email'] = 'spid.'.$fiscalCode.'@noemail.local';
        }

        $userClass = XotData::make()->getUserClass();
        $user = $userClass::create($userData);

        if (! $user instanceof UserContract) {
            throw new \Exception('La classe utente configurata non implementa UserContract');
        }

        return $user;
    }

    /**
     * Aggiorna un utente esistente con i dati SPID
<<<<<<< HEAD
     *
     * @param  array<string, mixed>  $attributes
=======
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function updateUserFromSpid(UserContract $user, array $attributes): void
    {
        $updateData = [];
<<<<<<< HEAD

        // Aggiorna campi se diversi
        if ($user->name !== $attributes['name']) {
            $updateData['name'] = $attributes['name'];
        }

        if ($user->getAttribute('surname') !== $attributes['surname']) {
            $updateData['surname'] = $attributes['surname'];
        }

        if ($attributes['email'] && $user->email !== $attributes['email']) {
            $updateData['email'] = $attributes['email'];
            $updateData['email_verified_at'] = now();
        }

        if ($attributes['mobile'] && $user->getAttribute('mobile_phone') !== $attributes['mobile']) {
            $updateData['mobile_phone'] = $attributes['mobile'];
        }

        // Aggiorna provider se diverso
        if ($user->getAttribute('spid_provider') !== $attributes['provider']) {
            $updateData['spid_provider'] = $attributes['provider'];
        }

        // Aggiorna ultimo accesso
        $updateData['last_login_at'] = now();

        $user->update($updateData);
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
>>>>>>> 464cfc5 (.)

        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
               '<samlp:LogoutResponse xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL.
               '                      xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL.
               '                      ID="'.$responseId.'"'.PHP_EOL.
               '                      Version="2.0"'.PHP_EOL.
               '                      IssueInstant="'.$issueInstant.'">'.PHP_EOL.
<<<<<<< HEAD
               '  <saml:Issuer>'.config()->string('spid.entity_id').'</saml:Issuer>'.PHP_EOL.
=======
<<<<<<< HEAD
               '  <saml:Issuer>'.config('spid.entity_id').'</saml:Issuer>'.PHP_EOL.
=======
               '  <saml:Issuer>'.$entityId.'</saml:Issuer>'.PHP_EOL.
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
>>>>>>> 464cfc5 (.)
    protected function generateSloErrorResponse(): string
    {
        $responseId = 'res_'.bin2hex(random_bytes(16));
        $issueInstant = gmdate('Y-m-d\TH:i:s\Z');
<<<<<<< HEAD
=======
        $entityId = SafeStringCastAction::cast(config('spid.entity_id'));
>>>>>>> 464cfc5 (.)

        return '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
               '<samlp:LogoutResponse xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"'.PHP_EOL.
               '                      xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"'.PHP_EOL.
               '                      ID="'.$responseId.'"'.PHP_EOL.
               '                      Version="2.0"'.PHP_EOL.
               '                      IssueInstant="'.$issueInstant.'">'.PHP_EOL.
<<<<<<< HEAD
               '  <saml:Issuer>'.config()->string('spid.entity_id').'</saml:Issuer>'.PHP_EOL.
=======
<<<<<<< HEAD
               '  <saml:Issuer>'.config('spid.entity_id').'</saml:Issuer>'.PHP_EOL.
=======
               '  <saml:Issuer>'.$entityId.'</saml:Issuer>'.PHP_EOL.
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
               '  <samlp:Status>'.PHP_EOL.
               '    <samlp:StatusCode Value="urn:oasis:names:tc:SAML:2.0:status:Responder"/>'.PHP_EOL.
               '  </samlp:Status>'.PHP_EOL.
               '</samlp:LogoutResponse>';
    }
}
