@props(['data' => []])
{{--
    Pagina "Notifiche" dell'area personale (DCP-111), JSON `area-personale.notifiche`. Il blocco e' solo l'adattatore: intestazione, briciole e
    link alle impostazioni; l'elenco e la scrittura di "segna come letta" sono del componente Livewire PersonalAreaNotificationsWidget
    (Action BuildPersonalAreaNotificationsDataAction / MarkPersonalAreaNotificationsAsReadAction). Nessun testo qui: tutto da
    fixcity::personal_area_settings.*. Markup e classi: Design Comuni (cmp-heading, cmp-breadcrumbs, cmp-card-latest-messages).
--}}
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include('pub_theme::components.blocks.personal-area-settings.breadcrumb', ['current' => __('fixcity::personal_area_settings.notifications.title')])
            <div class="cmp-heading pb-3 pb-lg-4">
                <h1 class="title-xxxlarge">{{ __('fixcity::personal_area_settings.notifications.title') }}</h1>
                <p class="subtitle-small">{{ __('fixcity::personal_area_settings.notifications.subtitle') }}</p>
            </div>
            <p class="text-paragraph mb-3">{{ __('fixcity::personal_area_settings.notifications.settings_hint') }}</p>
            <p class="mb-4"><a class="btn btn-outline-primary" href="{{ route('container0.view', ['container0' => 'area-personale', 'slug0' => 'impostazioni']) }}">{{ __('fixcity::personal_area_settings.notifications.settings_link') }}</a></p>
            @livewire(\Modules\Fixcity\Livewire\PersonalAreaNotificationsWidget::class)
        </div>
    </div>
</div>
