{{--
  Callers: Themes/Sixteen auth-register.blade.php → @livewire(Gdpr RegisterWidget).
  Vestito FO; logica create-user/consensi nel widget modulo. Nessuna card annidata.
  Stili inline: 14-auth-login.css e utility Tailwind isolati da data-dc.
--}}
<div>
    <style>
        form[aria-labelledby="auth-register-heading"] legend {
            display: block;
            width: 100%;
            margin: 0 0 1rem;
            padding: 0;
            font-size: 1.125rem;
            font-weight: 700;
            color: #1a1a1a;
            border-bottom: 1px solid #d9e1e8;
            padding-bottom: 0.35rem;
        }
        form[aria-labelledby="auth-register-heading"] .auth-register-fields {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }
        form[aria-labelledby="auth-register-heading"] label.auth-register-field {
            display: block;
            width: 100%;
            font-size: 0.9375rem;
            font-weight: 600;
            color: #1a1a1a;
        }
        form[aria-labelledby="auth-register-heading"] .auth-register-req {
            color: #007a52;
            font-weight: 700;
            margin-right: 0.15rem;
        }
        form[aria-labelledby="auth-register-heading"] input[type="text"],
        form[aria-labelledby="auth-register-heading"] input[type="email"],
        form[aria-labelledby="auth-register-heading"] input[type="password"] {
            display: block !important;
            width: 100% !important;
            min-height: 2.75rem !important;
            box-sizing: border-box !important;
            margin-top: 0.4rem;
            padding: 0.5rem 0.75rem !important;
            /* !important: Design Comuni azzera top/left/right → solo underline */
            border: 1px solid #5b6f82 !important;
            border-radius: 0.25rem !important;
            background: #fff !important;
            color: #1a1a1a !important;
            font-size: 1rem !important;
            box-shadow: none !important;
        }
        form[aria-labelledby="auth-register-heading"] input:focus {
            border-color: #007a52;
            outline: 2px solid #007a52;
            outline-offset: 1px;
        }
        form[aria-labelledby="auth-register-heading"] .auth-register-hint {
            display: block;
            margin-top: 0.35rem;
            font-size: 0.875rem;
            font-weight: 400;
            color: #5c6f82;
        }
        form[aria-labelledby="auth-register-heading"] .auth-register-error {
            display: block;
            margin-top: 0.35rem;
            font-size: 0.875rem;
            font-weight: 400;
            color: #d9364f;
        }
        form[aria-labelledby="auth-register-heading"] .auth-register-toggle {
            margin-top: 0.35rem;
            min-height: 2.75rem;
            padding: 0.25rem 0;
            border: 0;
            background: transparent;
            color: #007a52;
            font: inherit;
            font-size: 0.9375rem;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
            cursor: pointer;
        }
        form[aria-labelledby="auth-register-heading"] .auth-register-toggle:focus-visible {
            outline: 2px solid #007a52;
            outline-offset: 2px;
        }
        form[aria-labelledby="auth-register-heading"] .auth-register-consents {
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid #d9e1e8;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        form[aria-labelledby="auth-register-heading"] label.auth-register-check {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            min-height: 2.75rem;
            font-size: 0.9375rem;
            font-weight: 400;
            color: #1a1a1a;
        }
        form[aria-labelledby="auth-register-heading"] input[type="checkbox"] {
            appearance: auto !important;
            -webkit-appearance: auto !important;
            accent-color: #007a52 !important;
            background-image: none !important;
            width: 1.25rem !important;
            height: 1.25rem !important;
            min-width: 1.25rem !important;
            margin-top: 0.2rem;
            flex-shrink: 0;
            opacity: 1 !important;
        }
        form[aria-labelledby="auth-register-heading"] a {
            color: #007a52;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        form[aria-labelledby="auth-register-heading"] button[type="submit"] {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 100% !important;
            min-height: 2.75rem !important;
            margin-top: 1.25rem !important;
            padding: 0.75rem 1.25rem !important;
            background: #007a52 !important;
            border: 2px solid #007a52 !important;
            border-radius: 0.25rem !important;
            color: #fff !important;
            font-weight: 600 !important;
        }
        form[aria-labelledby="auth-register-heading"] button[type="submit"]:hover:not(:disabled) {
            background: #006945 !important;
            border-color: #006945 !important;
        }
        form[aria-labelledby="auth-register-heading"] button[type="submit"]:focus-visible {
            outline: 2px solid #007a52;
            outline-offset: 2px;
        }
        form[aria-labelledby="auth-register-heading"] button[type="submit"]:disabled {
            opacity: 0.7;
            cursor: progress;
        }
        .auth-register-alert {
            margin-bottom: 1.25rem;
            border: 2px solid #d9364f;
            border-radius: 0.25rem;
            background: #fff5f6;
            padding: 1rem;
        }
        .auth-register-alert__title {
            margin: 0;
            font-size: 0.9375rem;
            font-weight: 700;
            color: #961e22;
        }
        .auth-register-alert ul {
            margin: 0.5rem 0 0;
            padding-left: 1.25rem;
            color: #961e22;
            font-size: 0.875rem;
        }
    </style>

    @php
        $registerErrors = collect($errors->all())->filter()->unique()->values();
        $req = '<span class="auth-register-req" aria-hidden="true">*</span>';
    @endphp

    @if ($registerErrors->isNotEmpty())
        <div class="auth-register-alert" role="alert" aria-live="assertive">
            <p class="auth-register-alert__title">{{ __('user::registration.actions.register.error') }}</p>
            <ul>
                @foreach ($registerErrors as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        wire:submit="submit"
        class="w-full min-w-0"
        aria-labelledby="auth-register-heading"
        aria-describedby="auth-register-hint-email auth-register-hint-password"
        novalidate
    >
        <fieldset>
            <legend>{{ __('gdpr::register.sections.user_info') }}</legend>
            <div class="auth-register-fields">
                <label class="auth-register-field" for="first_name">
                    {!! $req !!}{{ __('gdpr::register.fields.first_name.label') }}
                    <input id="first_name" type="text" wire:model="first_name" autocomplete="given-name" required aria-required="true" />
                    @error('first_name') <span class="auth-register-error">{{ $message }}</span> @enderror
                </label>

                <label class="auth-register-field" for="last_name">
                    {!! $req !!}{{ __('gdpr::register.fields.last_name.label') }}
                    <input id="last_name" type="text" wire:model="last_name" autocomplete="family-name" required aria-required="true" />
                    @error('last_name') <span class="auth-register-error">{{ $message }}</span> @enderror
                </label>

                <label class="auth-register-field" for="email">
                    {!! $req !!}{{ __('gdpr::register.fields.email.label') }}
                    <input id="email" type="email" wire:model="email" autocomplete="email" required aria-required="true" aria-describedby="auth-register-hint-email" />
                    <span id="auth-register-hint-email" class="auth-register-hint">{{ __('gdpr::register.fields.email.helper_text') }}</span>
                    @error('email') <span class="auth-register-error">{{ $message }}</span> @enderror
                </label>

                <div x-data="{ show: false }">
                    <label class="auth-register-field" for="password">
                        {!! $req !!}{{ __('gdpr::register.fields.password.label') }}
                        <input id="password" :type="show ? 'text' : 'password'" wire:model="password" autocomplete="new-password" required aria-required="true" aria-describedby="auth-register-hint-password" />
                    </label>
                    <p id="auth-register-hint-password" class="auth-register-hint">{{ __('gdpr::register.fields.password.helper_text') }}</p>
                    <button type="button" class="auth-register-toggle" @click="show = !show" :aria-pressed="show.toString()">
                        <span x-text="show ? '{{ __('Nascondi password') }}' : '{{ __('Mostra password') }}'"></span>
                    </button>
                    @error('password') <span class="auth-register-error">{{ $message }}</span> @enderror
                </div>

                <label class="auth-register-field" for="password_confirmation">
                    {!! $req !!}{{ __('gdpr::register.fields.password_confirmation.label') }}
                    <input id="password_confirmation" type="password" wire:model="password_confirmation" autocomplete="new-password" required aria-required="true" />
                    @error('password_confirmation') <span class="auth-register-error">{{ $message }}</span> @enderror
                </label>
            </div>
        </fieldset>

        <fieldset class="auth-register-consents">
            <legend>{{ __('gdpr::register.consents.title') }}</legend>
            <label class="auth-register-check">
                <input type="checkbox" wire:model="privacy_accepted" required aria-required="true" />
                <span>
                    {{ __('gdpr::register.consents.privacy_policy_label') }}
                    <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/privacy') }}" target="_blank" rel="noopener">
                        {{ __('gdpr::register.consents.privacy_policy_link') }}
                        <span class="sr-only"> ({{ __('gdpr::register.consents.opens_new_tab') }})</span>
                    </a>
                </span>
            </label>
            <label class="auth-register-check">
                <input type="checkbox" wire:model="terms_accepted" required aria-required="true" />
                <span>
                    {{ __('gdpr::register.consents.terms_label') }}
                    <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/terms') }}" target="_blank" rel="noopener">
                        {{ __('gdpr::register.consents.terms_link') }}
                        <span class="sr-only"> ({{ __('gdpr::register.consents.opens_new_tab') }})</span>
                    </a>
                </span>
            </label>
            <label class="auth-register-check">
                <input type="checkbox" wire:model="marketing_consent" />
                <span>{{ __('gdpr::register.consents.marketing_label') }}</span>
            </label>
        </fieldset>

        <x-filament::button
            type="submit"
            color="primary"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-70"
            wire:target="submit"
            class="w-full min-h-[44px]"
            aria-describedby="auth-register-submit-status"
        >
            <span wire:loading.remove wire:target="submit">
                {{ __('user::registration.actions.register.label') }}
            </span>
            <span wire:loading wire:target="submit" class="inline-flex items-center gap-2" role="status" aria-live="polite">
                <svg class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                {{ __('fixcity::auth.login.loading.text') }}
            </span>
        </x-filament::button>
        <span id="auth-register-submit-status" class="sr-only" wire:loading wire:target="submit" role="status" aria-live="polite">
            {{ __('fixcity::auth.login.loading.text') }}
        </span>
    </form>
</div>
