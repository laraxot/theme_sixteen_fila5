@include('pub_theme::components.blocks.segnalazioni.layout', ['data' => [
    'title' => __('pub_theme::segnalazione.elenco.title'),
    'subtitle' => __('pub_theme::segnalazione.elenco.subtitle', ['count' => 73]),
    'breadcrumb' => [
        ['label' => __('pub_theme::footer.home'), 'url' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/')],
        ['label' => __('pub_theme::segnalazione.elenco.title'), 'active' => true],
    ],
    'tabs' => ['items' => [
        ['id' => 'map', 'label' => __('pub_theme::segnalazione.elenco.map_tab'), 'active' => true],
        ['id' => 'list', 'label' => __('pub_theme::segnalazione.elenco.list_tab')],
    ]],
    'filters' => ['title' => __('pub_theme::segnalazione.filters.legend.label')],
    'main_content' => ['cta' => [
        'title' => __('pub_theme::segnalazione.elenco.make_report_title'),
        'text' => __('pub_theme::segnalazione.elenco.make_report_text'),
        'button_text' => __('pub_theme::segnalazione.elenco.make_report_btn'),
    ]],
]])
