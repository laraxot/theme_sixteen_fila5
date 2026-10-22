<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('register');

?>

<x-layouts.app>
    <x-slot name="title">{{ __('Crea un nuovo account') }}</x-slot>

    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-primary-600 to-primary-800 px-8 py-6 text-white">
                    <h1 class="text-2xl font-extrabold leading-9 tracking-tight drop-shadow-sm">{{ __('Crea un nuovo account') }}</h1>
                    <p class="text-blue-100 text-sm mt-1">{{ __('Accedi ai servizi del Comune') }}</p>
                </div>

                <div class="p-8 space-y-6">
                    <x-validation-errors class="mb-2" />

                    <form method="POST" action="{{ route('register') }}" class="space-y-4" autocomplete="on">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Nome') }}</label>
                            <input id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-900 dark:text-white sm:text-sm py-2 px-3" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Email') }}</label>
                            <input id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-900 dark:text-white sm:text-sm py-2 px-3" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Password') }}</label>
                            <input id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-900 dark:text-white sm:text-sm py-2 px-3" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Conferma password') }}</label>
                            <input id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-900 dark:text-white sm:text-sm py-2 px-3" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="flex items-start space-x-2">
                                <input type="checkbox" id="terms" name="terms" required class="mt-1 h-4 w-4 text-primary-600 rounded border-gray-300 focus:ring-primary-500" />
                                <label for="terms" class="text-sm text-gray-600 dark:text-gray-300 leading-snug">
                                    {!! __('Accetto i :terms e la :privacy', [
                                        'terms' => '<a href="'.route('terms.show').'" class="underline hover:text-primary-700 dark:hover:text-primary-400">'.__('Termini di servizio').'</a>',
                                        'privacy' => '<a href="'.route('policy.show').'" class="underline hover:text-primary-700 dark:hover:text-primary-400">'.__('Privacy').'</a>',
                                    ]) !!}
                                </label>
                            </div>
                        @endif

                        <div class="pt-2">
                            <button type="submit" class="w-full rounded-md bg-gradient-to-r from-primary-600 to-primary-800 px-4 py-2.5 text-sm font-semibold text-white shadow-md hover:from-primary-700 hover:to-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
                                {{ __('Registrati') }}
                            </button>
                        </div>
                    </form>

                    <div class="text-center text-sm leading-5 text-gray-600 dark:text-gray-400 space-y-1">
                        <p>
                            {{ __('Hai già un account?') }} <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-800 underline transition-colors">{{ __('Accedi') }}</a>
                        </p>
                        <p>
                            {{ __('Hai dimenticato la password?') }} <a href="{{ route('password.request') }}" class="font-medium text-primary-600 hover:text-primary-800 underline transition-colors">{{ __('Recupera la password') }}</a>
                        </p>
                    </div>
                </div>
            </div>

            @if (Route::has('register'))
                <div class="mt-6 text-center fade-in-up">
                    <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-primary-600 transition-colors bg-white/10 backdrop-blur px-4 py-2 rounded-full border border-white/20 shadow-sm">
                        <span>{{ __('Crea il tuo account') }}</span>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            @endif

            <div class="text-center text-xs text-white/80 mt-8 p-4 bg-white/10 rounded-xl border border-white/20 backdrop-blur-sm fade-in-up">
                <p class="mb-2">
                    <strong>{{ __('Accessibilità') }}:</strong> {{ __('Conforme a WCAG 2.1 AA') }} •
                    <a href="{{ url('/pages/accessibility') }}" class="text-white underline hover:text-blue-100 transition-colors">{{ __('Dichiarazione di accessibilità') }}</a>
                </p>
                <p><strong>{{ __('Navigazione') }}:</strong> {{ __('Tab per spostarsi • Invio per confermare') }}</p>
            </div>
        </div>
    </section>
</x-layouts.app>
