<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Controllers;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> edd328a (.)
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Themes\Sixteen\Events\CieAuthenticated;
use Themes\Sixteen\Events\CieLoggedOut;
use Themes\Sixteen\Models\User;
use Themes\Sixteen\Actions\CieAuthAction;

/**
 * Controller per l'autenticazione CIE
 *
 * Gestisce il flusso completo di autenticazione CIE secondo le specifiche AGID
 */
class CieAuthController extends Controller
{
    public function __construct(
        protected CieAuthAction $cieService
    ) {}

    /**
     * Reindirizza a CIE per l'autenticazione web
     */
    public function login(Request $request): RedirectResponse
    {
        try {
            $returnUrl = $request->query('return_url', route('dashboard'));
=======
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Datas\XotData;
use Themes\Sixteen\Events\CieAuthenticated;
use Themes\Sixteen\Events\CieLoggedOut;
use Themes\Sixteen\Services\CieAuthService;

class CieAuthController extends Controller
{
    public function __construct(
        protected CieAuthService $cieService
    ) {}

    public function login(Request $request): RedirectResponse
    {
        try {
            $returnUrl = SafeStringCastAction::cast($request->query('return_url', route('dashboard')));
>>>>>>> edd328a (.)

            Log::info('CIE login initiated', [
                'method' => 'web',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

<<<<<<< HEAD
            $loginUrl = $this->cieService->getLoginUrl($returnUrl);

            return redirect()->to($loginUrl);
=======
            return redirect()->to($this->cieService->getLoginUrl($returnUrl));
>>>>>>> edd328a (.)
        } catch (\Exception $e) {
            Log::error('CIE login error', [
                'method' => 'web',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')
                ->with('error', 'Errore durante l\'avvio dell\'autenticazione CIE. Riprova più tardi.');
        }
    }

<<<<<<< HEAD
    /**
     * Reindirizza all'app CieID mobile
     */
    public function mobileLogin(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $returnUrl = $request->query('return_url', route('dashboard'));
=======
    public function mobileLogin(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $returnUrl = SafeStringCastAction::cast($request->query('return_url', route('dashboard')));
>>>>>>> edd328a (.)

            Log::info('CIE mobile login initiated', [
                'method' => 'mobile',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            $mobileUrl = $this->cieService->getMobileLoginUrl($returnUrl);
<<<<<<< HEAD

            // Se è una richiesta AJAX, ritorna JSON per gestire il deep linking
=======
            $fallbackUrl = $this->cieService->getLoginUrl($returnUrl);
            $timeout = (int) config('cie.mobile.deep_link_timeout', 10) * 1000;

>>>>>>> edd328a (.)
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'mobile_url' => $mobileUrl,
<<<<<<< HEAD
                    'fallback_url' => $this->cieService->getLoginUrl($returnUrl),
                    'timeout' => config('cie.mobile.deep_link_timeout', 10) * 1000, // millisecondi
                ]);
            }

            // Redirect diretto per browser
=======
                    'fallback_url' => $fallbackUrl,
                    'timeout' => $timeout,
                ]);
            }

>>>>>>> edd328a (.)
            return redirect()->to($mobileUrl);
        } catch (\Exception $e) {
            Log::error('CIE mobile login error', [
                'method' => 'mobile',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Errore durante l\'avvio dell\'autenticazione CIE mobile.',
                    'fallback_url' => route('cie.login', ['return_url' => $request->query('return_url')]),
                ], 500);
            }

            return redirect()->route('login')
                ->with('error', 'Errore durante l\'avvio dell\'autenticazione CIE mobile. Riprova più tardi.');
        }
    }

<<<<<<< HEAD
    /**
     * Gestisce il callback OAuth2 da CIE
     */
    public function callback(Request $request): RedirectResponse
    {
        try {
            // Processa la response OAuth2
            $userAttributes = $this->cieService->processCallback($request);

            // Trova o crea l'utente
            $user = $this->findOrCreateUser($userAttributes);

            // Effettua il login
            Auth::login($user, true);

            // Salva i dati CIE in sessione
            Session::put('cie.authenticated', true);
            Session::put('cie.user_data', $userAttributes);

            // Trigger evento
=======
    public function callback(Request $request): RedirectResponse
    {
        try {
            /** @var array<string, mixed> $userAttributes */
            $userAttributes = $this->cieService->processCallback($request);
            $user = $this->findOrCreateUser($userAttributes);

            Auth::login($user, true);

            Session::put('cie.authenticated', true);
            Session::put('cie.user_data', $userAttributes);

>>>>>>> edd328a (.)
            event(new CieAuthenticated($user, $userAttributes));

            Log::info('CIE authentication completed', [
                'user_id' => $user->id,
<<<<<<< HEAD
                'auth_method' => $userAttributes['auth_method'],
                'fiscal_code' => $userAttributes['fiscal_code'],
            ]);

            // Redirect all'URL di ritorno
            $returnUrl = Session::pull('cie.return_url', route('dashboard'));
=======
                'auth_method' => $userAttributes['auth_method'] ?? null,
                'fiscal_code' => $userAttributes['fiscal_code'] ?? null,
            ]);

            $returnUrl = SafeStringCastAction::cast(Session::pull('cie.return_url', route('dashboard')));
>>>>>>> edd328a (.)

            return redirect()->to($returnUrl)
                ->with('success', 'Autenticazione CIE completata con successo.');
        } catch (\Exception $e) {
            Log::error('CIE callback error', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

<<<<<<< HEAD
            // Pulisci la sessione in caso di errore
=======
>>>>>>> edd328a (.)
            $this->cieService->logout();

            return redirect()->route('login')
                ->with('error', 'Errore durante l\'autenticazione CIE: '.$e->getMessage());
        }
    }

<<<<<<< HEAD
    /**
     * Gestisce il logout CIE
     */
=======
>>>>>>> edd328a (.)
    public function logout(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();
            $userData = Session::get('cie.user_data');
<<<<<<< HEAD
            $returnUrl = $request->query('return_url', route('home'));

            if ($user && $userData) {
                Log::info('CIE logout initiated', [
                    'user_id' => $user->id,
                    'auth_method' => $userData['auth_method'] ?? 'cie',
                ]);

                // Trigger evento prima del logout
                event(new CieLoggedOut($user, $userData));
            }

            // Effettua logout locale
=======
            $returnUrl = SafeStringCastAction::cast($request->query('return_url', route('home')));

            if ($user instanceof User && is_array($userData)) {
                /** @var array<string, mixed> $cieAttributes */
                $cieAttributes = $userData;
                Log::info('CIE logout initiated', [
                    'user_id' => $user->id,
                    'auth_method' => $cieAttributes['auth_method'] ?? 'cie',
                ]);

                event(new CieLoggedOut($user, $cieAttributes));
            }

>>>>>>> edd328a (.)
            Auth::logout();
            $this->cieService->logout();
            Session::invalidate();
            Session::regenerateToken();

<<<<<<< HEAD
            // Se configurato, usa il logout endpoint CIE
            if (config('cie.logout_endpoint_enabled', false)) {
                $logoutUrl = $this->cieService->getLogoutUrl($returnUrl);

                return redirect()->to($logoutUrl);
=======
            if (config('cie.logout_endpoint_enabled', false)) {
                return redirect()->to($this->cieService->getLogoutUrl($returnUrl));
>>>>>>> edd328a (.)
            }

            return redirect()->to($returnUrl)
                ->with('success', 'Logout effettuato con successo.');
        } catch (\Exception $e) {
            Log::error('CIE logout error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

<<<<<<< HEAD
            // Forza logout locale in caso di errore
=======
>>>>>>> edd328a (.)
            Auth::logout();
            $this->cieService->logout();
            Session::invalidate();
            Session::regenerateToken();

            return redirect()->route('home')
                ->with('warning', 'Logout locale completato.');
        }
    }

<<<<<<< HEAD
    /**
     * Rinnova l'access token usando il refresh token
     */
=======
>>>>>>> edd328a (.)
    public function refresh(Request $request): JsonResponse
    {
        try {
            if (! $this->cieService->isAuthenticated()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Utente non autenticato con CIE',
                ], 401);
            }

            $tokenData = $this->cieService->refreshToken();

<<<<<<< HEAD
            if (! $tokenData) {
=======
            if ($tokenData === null) {
>>>>>>> edd328a (.)
                return response()->json([
                    'success' => false,
                    'error' => 'Impossibile rinnovare il token',
                ], 400);
            }

            Log::info('CIE token refreshed', [
                'user_id' => Auth::id(),
                'expires_in' => $tokenData['expires_in'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'expires_in' => $tokenData['expires_in'] ?? null,
                'token_type' => $tokenData['token_type'] ?? 'Bearer',
            ]);
        } catch (\Exception $e) {
            Log::error('CIE token refresh error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Errore nel rinnovare il token',
            ], 500);
        }
    }

<<<<<<< HEAD
    /**
     * Fornisce informazioni sullo stato dell'autenticazione CIE
     */
=======
>>>>>>> edd328a (.)
    public function status(Request $request): JsonResponse
    {
        try {
            $isAuthenticated = $this->cieService->isAuthenticated();
            $userData = $isAuthenticated ? $this->cieService->getAuthenticatedUser() : null;

            return response()->json([
                'authenticated' => $isAuthenticated,
                'provider' => 'cie',
<<<<<<< HEAD
                'auth_method' => $userData['auth_method'] ?? null,
                'user_data' => $userData ? [
                    'name' => $userData['name'],
                    'surname' => $userData['surname'],
                    'fiscal_code' => $userData['fiscal_code'],
=======
                'auth_method' => is_array($userData) ? ($userData['auth_method'] ?? null) : null,
                'user_data' => is_array($userData) ? [
                    'name' => $userData['name'] ?? null,
                    'surname' => $userData['surname'] ?? null,
                    'fiscal_code' => $userData['fiscal_code'] ?? null,
>>>>>>> edd328a (.)
                    'auth_time' => $userData['auth_time'] ?? null,
                ] : null,
                'config_status' => $this->cieService->isConfigured(),
            ]);
        } catch (\Exception $e) {
            Log::error('CIE status check error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'authenticated' => false,
                'error' => 'Errore nel verificare lo stato CIE',
            ], 500);
        }
    }

<<<<<<< HEAD
    /**
     * Endpoint per debugging (solo in sviluppo)
     */
=======
>>>>>>> edd328a (.)
    public function debug(Request $request): JsonResponse
    {
        if (! config('app.debug') || ! app()->environment(['local', 'development'])) {
            abort(404);
        }

<<<<<<< HEAD
=======
        $authUser = Auth::user();

>>>>>>> edd328a (.)
        return response()->json([
            'config_info' => $this->cieService->getConfigInfo(),
            'session_data' => [
                'authenticated' => Session::get('cie.authenticated'),
                'has_user_data' => Session::has('cie.user_data'),
                'has_access_token' => Session::has('cie.access_token'),
                'state' => Session::get('cie.state'),
                'auth_method' => Session::get('cie.auth_method'),
            ],
<<<<<<< HEAD
            'auth_user' => Auth::check() ? [
                'id' => Auth::id(),
                'email' => Auth::user()->email,
                'fiscal_code' => Auth::user()->fiscal_code ?? null,
=======
            'auth_user' => $authUser instanceof User ? [
                'id' => $authUser->id,
                'email' => $authUser->email,
>>>>>>> edd328a (.)
            ] : null,
        ]);
    }

    /**
<<<<<<< HEAD
     * Trova o crea un utente basato sui dati CIE
     */
    protected function findOrCreateUser(array $attributes): User
    {
        $fiscalCode = $attributes['fiscal_code'];

        if (empty($fiscalCode)) {
            throw new \Exception('Codice fiscale mancante nei dati CIE');
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
            throw new \Exception('Codice fiscale mancante nei dati CIE');
        }

        $user = $this->resolveUserByAuthEmail($attributes, 'cie', $fiscalCode);
        if ($user instanceof User) {
>>>>>>> edd328a (.)
            $this->updateUserFromCie($user, $attributes);

            return $user;
        }

<<<<<<< HEAD
        // Crea nuovo utente
        return $this->createUserFromCie($attributes);
    }

    /**
     * Crea un nuovo utente dai dati CIE
     */
    protected function createUserFromCie(array $attributes): User
    {
        $userData = [
            'name' => $attributes['name'],
            'surname' => $attributes['surname'],
            'email' => $attributes['email'],
            'fiscal_code' => $attributes['fiscal_code'],
            'birth_date' => $attributes['birth_date'],
            'birth_place' => $attributes['birth_place'],
            'gender' => $attributes['gender'],
            'phone' => $attributes['phone'],
            'address' => $attributes['address'],
            'cie_provider' => 'cie',
            'auth_method' => 'cie',
            'email_verified_at' => $attributes['email_verified'] ?? false ? now() : null,
            'phone_verified_at' => $attributes['phone_verified'] ?? false ? now() : null,
        ];

        // Genera email temporanea se mancante o non verificata
        if (empty($userData['email']) || ! ($attributes['email_verified'] ?? false)) {
            $userData['email'] = 'cie.'.$attributes['fiscal_code'].'@noemail.local';
            $userData['email_verified_at'] = null;
        }

        return User::create($userData);
    }

    /**
     * Aggiorna un utente esistente con i dati CIE
=======
        return $this->createUserFromCie($attributes, $fiscalCode);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function createUserFromCie(array $attributes, string $fiscalCode): User
    {
        $email = $this->resolveAuthEmail($attributes, 'cie', $fiscalCode);
        $emailVerified = ($attributes['email_verified'] ?? false) === true;

        /** @var class-string<User&Model> $userClass */
        $userClass = XotData::make()->getUserClass();

        /** @var User $user */
        $user = $userClass::query()->create([
            'name' => SafeStringCastAction::cast($attributes['name'] ?? ''),
            'first_name' => SafeStringCastAction::cast($attributes['name'] ?? ''),
            'last_name' => SafeStringCastAction::cast($attributes['surname'] ?? ''),
            'email' => $email,
            'phone' => SafeStringCastAction::cast($attributes['phone'] ?? ''),
            'password' => Hash::make(Str::random(32)),
            'email_verified_at' => $emailVerified ? now() : null,
        ]);

        return $user;
    }

    /**
     * @param  array<string, mixed>  $attributes
>>>>>>> edd328a (.)
     */
    protected function updateUserFromCie(User $user, array $attributes): void
    {
        $updateData = [];
<<<<<<< HEAD

        // Aggiorna campi se diversi e più recenti
        if ($user->name !== $attributes['name']) {
            $updateData['name'] = $attributes['name'];
        }

        if ($user->surname !== $attributes['surname']) {
            $updateData['surname'] = $attributes['surname'];
        }

        // Aggiorna email solo se verificata in CIE
        if (($attributes['email_verified'] ?? false) &&
            $attributes['email'] &&
            $user->email !== $attributes['email']) {
            $updateData['email'] = $attributes['email'];
            $updateData['email_verified_at'] = now();
        }

        // Aggiorna telefono solo se verificato in CIE
        if (($attributes['phone_verified'] ?? false) &&
            $attributes['phone'] &&
            $user->phone !== $attributes['phone']) {
            $updateData['phone'] = $attributes['phone'];
            $updateData['phone_verified_at'] = now();
        }

        // Aggiorna metodo auth se CIE
        if ($user->auth_method !== 'cie') {
            $updateData['auth_method'] = 'cie';
            $updateData['cie_provider'] = 'cie';
        }

        // Aggiorna ultimo accesso
        $updateData['last_login_at'] = now();

        if (! empty($updateData)) {
            $user->update($updateData);
        }
=======
        $name = SafeStringCastAction::cast($attributes['name'] ?? '');
        $surname = SafeStringCastAction::cast($attributes['surname'] ?? '');
        $email = SafeStringCastAction::cast($attributes['email'] ?? '');

        if ($name !== '' && $user->name !== $name) {
            $updateData['name'] = $name;
            $updateData['first_name'] = $name;
        }

        if ($surname !== '' && $user->last_name !== $surname) {
            $updateData['last_name'] = $surname;
        }

        if (($attributes['email_verified'] ?? false) === true && $email !== '' && $user->email !== $email) {
            $updateData['email'] = $email;
            $updateData['email_verified_at'] = now();
        }

        $phone = SafeStringCastAction::cast($attributes['phone'] ?? '');
        if (($attributes['phone_verified'] ?? false) === true && $phone !== '' && $user->phone !== $phone) {
            $updateData['phone'] = $phone;
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
        $emailVerified = ($attributes['email_verified'] ?? false) === true;

        if ($email !== '' && ($provider !== 'cie' || $emailVerified)) {
            return $email;
        }

        return $provider.'.'.$fiscalCode.'@noemail.local';
>>>>>>> edd328a (.)
    }
}
