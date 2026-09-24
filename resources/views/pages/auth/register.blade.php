<x-layouts.app bodyPage="auth-register">
    <x-slot name="title">
        {{ __('user::registration.title') }}
    </x-slot>

    <x-slot name="metaDescription">
        {{ __('user::registration.description') }}
    </x-slot>

    <section class="bg-slate-50 py-10 sm:py-14">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
            <header class="mb-8">
                <p class="text-sm font-semibold tracking-wide text-primary-700 uppercase">
                    {{ __('user::registration.subtitle') }}
                </p>
                <h1 class="mt-1 text-3xl font-bold text-slate-900" id="auth-register-heading">
                    {{ __('user::registration.title') }}
                </h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-600">
                    {{ __('user::registration.description') }}
                </p>
            </header>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="auth-register-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        @livewire(\Modules\User\Filament\Widgets\Auth\RegisterWidget::class)
                    </div>
                </div>

                <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" aria-labelledby="auth-register-support-heading">
                    <h2 class="text-base font-semibold text-slate-900" id="auth-register-support-heading">
                        {{ __('user::registration.sidebar.support_title') }}
                    </h2>
                    <ul class="mt-4 list-disc space-y-3 pl-5 text-sm text-slate-600" role="list">
                        <li id="auth-register-hint-email">{{ __('user::registration.sidebar.help_email') }}</li>
                        <li id="auth-register-hint-password">{{ __('user::registration.sidebar.help_password') }}</li>
                        <li>{{ __('user::registration.sidebar.help_support') }}</li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>
</x-layouts.app>
