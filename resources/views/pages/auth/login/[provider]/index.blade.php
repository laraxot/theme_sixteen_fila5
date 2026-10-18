<?php

declare(strict_types=1);

use function Laravel\Folio\name;
use function Laravel\Folio\middleware;
use Livewire\Volt\Component;

name('oauth.redirect');
middleware(['guest']);

new class extends Component {
    public string $provider = '';

    public function mount(string $provider): void
    {
        $this->provider = $provider;

        $allowed = ['google', 'microsoft', 'github'];
        if (!in_array($provider, $allowed, true)) {
            abort(404, __('user::auth.login.invalid_provider'));
        }

        $driver = \Laravel\Socialite\Facades\Socialite::driver($provider);
        redirect()->to($driver->redirect()->getTargetUrl());
    }
};
?>

<x-layouts.auth>
    @volt('oauth-redirect')
    <div class="min-h-screen bg-gradient-to-br from-primary-50 to-primary-100 dark:from-gray-900 dark:to-gray-800 px-4 sm:px-6 lg:px-8 flex items-center justify-center" aria-label="Redirecting to OAuth provider" role="region">
        <div class="p-8 bg-white dark:bg-gray-800 shadow-xl rounded-2xl border border-gray-200/60 card-wrapper cmp-card-simple text-center max-w-md w-full">
            <x-filament::icon icon="heroicon-o-arrow-path" class="w-12 h-12 mx-auto text-primary-600 animate-pulse mb-4" aria-hidden="true" />
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2 title-large">{{ __('user::auth.login.redirecting') }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('user::auth.login.redirect_to_provider', ['provider' => ucfirst($provider ?? '')]) }}</p>
        </div>
    </div>
    @endvolt
</x-layouts.auth>
