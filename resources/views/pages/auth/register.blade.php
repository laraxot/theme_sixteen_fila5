<x-layouts.app>
    <x-slot name="title">
        {{ __('user::auth.register.title.text') }}
    </x-slot>

    <section class="min-h-screen bg-slate-50 py-10 sm:py-14">
        <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
            <header class="mb-8">
                <p class="text-sm font-semibold tracking-wide text-primary-700 uppercase">
                    {{ __('user::auth.register.subtitle.text') }}
                </p>
                <h1 class="mt-1 text-3xl font-bold text-slate-900">
                    {{ __('user::auth.register.title.text') }}
                </h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-600">
                    {{ __('user::auth.register.description.text') }}
                </p>
            </header>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                        @livewire(\Modules\User\Filament\Widgets\Auth\RegisterWidget::class)
                    </div>
                </div>

                <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-slate-900">
                        {{ __('user::auth.register.sidebar.support_title.text') }}
                    </h2>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li>{{ __('user::auth.register.sidebar.help_email.text') }}</li>
                        <li>{{ __('user::auth.register.sidebar.help_password.text') }}</li>
                        <li>{{ __('user::auth.register.sidebar.help_support.text') }}</li>
                    </ul>
                </aside>
            </div>
        </div>
    </section>
</x-layouts.app>