{{-- BMAD + Second Brain + Filament Blueprint: Google Login button --}}
{{-- Folio + Volt + Filament, NO controllers/web.php --}}
{{-- Route: oauth.redirect (redirect provider), NOT oauth.callback --}}
@props(['size' => 'md', 'variant' => 'primary'])

@php
    $classes = match ($size) {
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
        default => 'px-6 py-3 text-base',
    };
@endphp

@if (Route::has('oauth.redirect'))
<div x-data="{ open: false }" class="google-login-wrapper w-full">
    <a
        href="{{ route('oauth.redirect', ['provider' => 'google']) }}"
        class="inline-flex items-center justify-center w-full {{ $classes }} font-medium rounded-xl border border-gray-200 bg-white text-gray-900 hover:bg-gray-50 hover:border-gray-300 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-500 shadow-sm transition-all duration-200"
    >
        <img src="https://accounts.google.com/favicon.ico" alt="Google icon" class="w-5 h-5 mr-2" loading="eager" />
        <span>{{ __('user::auth.login.google.button.text') }}</span>
    </a>
</div>
@endif
