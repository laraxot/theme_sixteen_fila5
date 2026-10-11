<?php

declare(strict_types=1);

use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('container1.token');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $slug0 = '';
    public string $container1 = '';
    public string $token = '';
};
?>

<x-layouts.app :title="__('Reimposta la password')">
    @volt('container1.token')
        @if ($container0 === 'auth' && $slug0 === 'password' && $container1 === 'reset')
            <section class="bg-slate-50 px-4 py-12 sm:px-6 lg:px-8" aria-labelledby="auth-password-token-heading">
                <div class="mx-auto max-w-md">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h1 id="auth-password-token-heading" class="text-3xl font-bold tracking-tight text-slate-950">{{ __('Reimposta la password') }}</h1>
                        <p class="mt-2 text-slate-700">{{ __('Scegli una nuova password per il tuo account.') }}</p>
                        <div class="mt-8">@livewire(\Modules\User\Filament\Widgets\Auth\ResetPasswordWidget::class)</div>
                    </div>
                </div>
            </section>
        @endif
    @endvolt
</x-layouts.app>
