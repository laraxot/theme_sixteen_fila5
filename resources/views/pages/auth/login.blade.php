<x-layouts.app>
    <x-slot name="title">
        {{ __('user::auth.login.page.meta_title.label') }}
    </x-slot>

    <section class="min-h-screen bg-slate-50 py-10 sm:py-14">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
            <header class="mb-8">
                <p class="text-sm font-semibold tracking-wide text-primary-700 uppercase">
                    {{ __('user::auth.login.page.kicker.label') }}
                </p>
                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    {{ __('user::auth.login.page.title.label') }}
                </h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-600">
                    {{ __('user::auth.login.page.description.label') }}
                </p>
            </header>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        @livewire(\Modules\User\Filament\Widgets\Auth\LoginWidget::class)
                    </div>
                </div>

                <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-slate-900">
                        {{ __('user::auth.login.page.support_title.label') }}
                    </h2>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li>{{ __('user::auth.login.page.support_item_email.label') }}</li>
                        <li>{{ __('user::auth.login.page.support_item_password.label') }}</li>
                        <li>{{ __('user::auth.login.page.support_item_help.label') }}</li>
                    </ul>
                </aside>
            </div>

            @if (Route::has('register'))
                <div class="mt-8 rounded-xl border border-primary-200 bg-primary-50 p-4 text-sm text-primary-900">
                    {{ __('user::auth.login.page.register_cta_text.label') }}
                    <a href="{{ route('register') }}" class="ml-1 font-semibold underline decoration-primary-700 underline-offset-2">
                        {{ __('user::auth.login.page.register_cta_link.label') }}
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{--
    Legacy CTA/UI kept commented for historical reference.
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
                @livewire(\Modules\User\Filament\Widgets\Auth\LoginWidget::class)
            </div>
            @if (Route::has('register'))
                <div class="registration-cta mt-8 fade-in-up">
                    <p class="text-gray-700 mb-4 font-medium">
                        {{ __('Non hai ancora un account?') }}
                    </p>
                    <a href="{{ route('register') }}" class="registration-button">
                        {{ __('Crea il tuo account') }}
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
    --}}
</x-layouts.app>
