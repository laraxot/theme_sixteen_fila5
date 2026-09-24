<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
<<<<<<< HEAD
use Themes\Sixteen\Events\CieAuthenticated;
use Themes\Sixteen\Events\CieLoggedOut;
use Themes\Sixteen\Models\User;
use Themes\Sixteen\Actions\CieAuthAction;

/**
 * Controller per l'autenticazione CIE
=======
use Themes\Sixteen\Actions\CieAuthAction;
use Themes\Sixteen\Events\CieAuthenticated;
use Themes\Sixteen\Events\CieLoggedOut;
use Themes\Sixteen\Models\User;

/**
 * Controller per l'autenticazione CIE.
>>>>>>> laraxot/dev
 *
 * Gestisce il flusso completo di autenticazione CIE secondo le specifiche AGID
 */
class CieAuthController extends Controller
{
    public function __construct(
        protected CieAuthAction $cieService
    ) {}

    /**
<<<<<<< HEAD
     * Reindirizza a CIE per l'autenticazione web
=======
     * Reindirizza a CIE per l'autenticazione web.
>>>>>>> laraxot/dev
     */
    public function login(Request $request): RedirectResponse
    {
        try {
            $returnUrl = $request->query('return_url', route('dashboard'));

            Log::info('CIE login initiated', [
                'method' => 'web',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

<<<<<<< HEAD
            $loginUrl = $this->cieService->getLoginUrl($returnUrl);
=======
            $loginUrl = $this->cieService->getLoginUrl((string) $returnUrl);
>>>>>>> laraxot/dev

            return redirect()->to($loginUrl);
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

    /**
<<<<<<< HEAD
     * Reindirizza all'app CieID mobile
=======
     * Reindirizza all'app CieID mobile.
>>>>>>> laraxot/dev
     */
    public function mobileLogin(Request $request): RedirectResponse|JsonResponse
    {
        try {
            $returnUrl = $request->query('return_url', route('dashboard'));

            Log::info('CIE mobile login initiated', [
                'method' => 'mobile',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

<<<<<<< HEAD
            $mobileUrl = $this->cieService->getMobileLoginUrl($returnUrl);
=======
            $mobileUrl = $this->cieService->getMobileLoginUrl((string) $returnUrl);
>>>>>>> laraxot/dev

            // Se è una richiesta AJAX, ritorna JSON per gestire il deep linking
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'mobile_url' => $mobileUrl,
<<<<<<< HEAD
                    'fallback_url' => $this->cieService->getLoginUrl($returnUrl),
=======
                    'fallback_url' => $this->cieService->getLoginUrl((string) $returnUrl),
>>>>>>> laraxot/dev
                    'timeout' => config('cie.mobile.deep_link_timeout', 10) * 1000, // millisecondi
                ]);
            }

            // Redirect diretto per browser
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

    /**
<<<<<<< HEAD
     * Gestisce il callback OAuth2 da CIE
=======
     * Gestisce il callback OAuth2 da CIE.
>>>>>>> laraxot/dev
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
            event(new CieAuthenticated($user, $userAttributes));

            Log::info('CIE authentication completed', [
                'user_id' => $user->id,
                'auth_method' => $userAttributes['auth_method'],
                'fiscal_code' => $userAttributes['fiscal_code'],
            ]);

            // Redirect all'URL di ritorno
            $returnUrl = Session::pull('cie.return_url', route('dashboard'));

<<<<<<< HEAD
            return redirect()->to($returnUrl)
=======
            return redirect()->to((string) $returnUrl)
>>>>>>> laraxot/dev
                ->with('success', 'Autenticazione CIE completata con successo.');
        } catch (\Exception $e) {
            Log::error('CIE callback error', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Pulisci la sessione in caso di errore
            $this->cieService->logout();

            return redirect()->route('login')
                ->with('error', 'Errore durante l\'autenticazione CIE: '.$e->getMessage());
        }
    }

    /**
<<<<<<< HEAD
     * Gestisce il logout CIE
=======
     * Gestisce il logout CIE.
>>>>>>> laraxot/dev
     */
    public function logout(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();
            $userData = Session::get('cie.user_data');
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
            Auth::logout();
            $this->cieService->logout();
            Session::invalidate();
            Session::regenerateToken();

            // Se configurato, usa il logout endpoint CIE
            if (config('cie.logout_endpoint_enabled', false)) {
<<<<<<< HEAD
                $logoutUrl = $this->cieService->getLogoutUrl($returnUrl);
=======
                $logoutUrl = $this->cieService->getLogoutUrl((string) $returnUrl);
>>>>>>> laraxot/dev

                return redirect()->to($logoutUrl);
            }

<<<<<<< HEAD
            return redirect()->to($returnUrl)
=======
            return redirect()->to((string) $returnUrl)
>>>>>>> laraxot/dev
                ->with('success', 'Logout effettuato con successo.');
        } catch (\Exception $e) {
            Log::error('CIE logout error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Forza logout locale in caso di errore
            Auth::logout();
            $this->cieService->logout();
            Session::invalidate();
            Session::regenerateToken();

            return redirect()->route('home')
                ->with('warning', 'Logout locale completato.');
        }
    }

    /**
<<<<<<< HEAD
     * Rinnova l'access token usando il refresh token
     */
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

            if (! $tokenData) {
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

    /**
     * Fornisce informazioni sullo stato dell'autenticazione CIE
     */
    public function status(Request $request): JsonResponse
    {
        try {
            $isAuthenticated = $this->cieService->isAuthenticated();
            $userData = $isAuthenticated ? $this->cieService->getAuthenticatedUser() : null;

            return response()->json([
                'authenticated' => $isAuthenticated,
                'provider' => 'cie',
                'auth_method' => $userData['auth_method'] ?? null,
                'user_data' => $userData ? [
                    'name' => $userData['name'],
                    'surname' => $userData['surname'],
                    'fiscal_code' => $userData['fiscal_code'],
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

    /**
     * Endpoint per debugging (solo in sviluppo)
     */
    public function debug(Request $request): JsonResponse
    {
        if (! config('app.debug') || ! app()->environment(['local', 'development'])) {
            abort(404);
        }

        return response()->json([
            'config_info' => $this->cieService->getConfigInfo(),
            'session_data' => [
                'authenticated' => Session::get('cie.authenticated'),
                'has_user_data' => Session::has('cie.user_data'),
                'has_access_token' => Session::has('cie.access_token'),
                'state' => Session::get('cie.state'),
                'auth_method' => Session::get('cie.auth_method'),
            ],
            'auth_user' => Auth::check() ? [
                'id' => Auth::id(),
                'email' => Auth::user()->email,
                'fiscal_code' => Auth::user()->fiscal_code ?? null,
            ] : null,
        ]);
    }

    /**
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
            $this->updateUserFromCie($user, $attributes);

            return $user;
        }

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
     * Trova o crea un utente basato sugli attributi CIE.
     *
     * @param  array<string, mixed>  $attributes
     */
    protected function findOrCreateUser(array $attributes): User
    {
        $user = User::where('fiscal_code', $attributes['fiscal_code'])->first();

        if (! $user) {
            $user = User::create([
                'name' => $attributes['given_name'].' '.$attributes['family_name'],
                'email' => $attributes['email'] ?? $attributes['fiscal_code'].'@cie.internal',
                'password' => bcrypt(str_random(16)),
                'fiscal_code' => $attributes['fiscal_code'],
                'given_name' => $attributes['given_name'],
                'family_name' => $attributes['family_name'],
                'birth_date' => $attributes['date_of_birth'],
            ]);
        }

        $this->updateUserFromCie($user, $attributes);

        return $user;
    }

    /**
     * Aggiorna i dati dell'utente con le informazioni CIE più recenti.
     *
     * @param  array<string, mixed>  $attributes
>>>>>>> laraxot/dev
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
=======
        if (isset($attributes['auth_method'])) {
>>>>>>> laraxot/dev
            $updateData['auth_method'] = 'cie';
            $updateData['cie_provider'] = 'cie';
        }

        // Aggiorna ultimo accesso
        $updateData['last_login_at'] = now();

        if (! empty($updateData)) {
            $user->update($updateData);
        }
    }
}
