@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione disservizio';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = $data['current_step'] ?? 2;
    $totalSteps = $data['total_steps'] ?? 3;
    $steps = $data['steps'] ?? [
        'Informativa sulla privacy',
        'Dati di segnalazione',
        'Riepilogo',
    ];
    $text = is_array($data['text'] ?? null) ? $data['text'] : [];
    $placeholders = is_array($data['placeholders'] ?? null) ? $data['placeholders'] : [];
    $placeholderSearch = $placeholders['search_place'] ?? 'Cerca un luogo*';
    $placeholderInefficiency = $placeholders['inefficiency_type'] ?? 'Tipo di disservizio*';
    $placeholderTitle = $placeholders['title'] ?? 'Titolo*';
    $placeholderDetails = $placeholders['details'] ?? 'Dettagli**';
    $user = $data['user'] ?? [
        'name' => 'Giulia Bianchi',
        'cf' => 'GLABNC72H25H501Y',
        'phone' => '+39 331 1234567',
        'email' => 'mario.rossi@gmail.com',
    ];
    $contacts = is_array($data['contacts'] ?? null) ? $data['contacts'] : [];
    $phoneLabel = trim((string) ($contacts['phone'] ?? '05 0505'));
    $phoneHref = (string) ($contacts['phone_url'] ?? '#');
    $locale = app()->getLocale();
    $homeUrl = (string) ($data['home_url'] ?? url($locale.'/tests/homepage'));
    $servicesUrl = (string) ($data['services_url'] ?? '#');
    $prevUrl = (string) ($data['prev_url'] ?? url($locale.'/tests/segnalazione-01-privacy'));
    $nextUrl = (string) ($data['next_url'] ?? url($locale.'/tests/segnalazione-03-riepilogo'));
@endphp

<div class="container" id="main-container">
    <div class="justify-content-center row">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav aria-label="breadcrumb" class="breadcrumb-container">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ $homeUrl }}">{{ __("fixcity::segnalazione.breadcrumb.home.label") }}</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item"><a href="{{ $servicesUrl }}">{{ __("fixcity::segnalazione.breadcrumb.services.label") }}</a><span class="separator">/</span></li>
                        <li aria-current="page" class="active breadcrumb-item">Segnalazione disservizio</li>
                    </ol>
                </nav>
            </div>
            <div class="cmp-heading pb-3 pb-lg-4">
                <h1 class="title-xxxlarge">Segnalazione disservizio</h1>
            </div>
        </div>
        <div class="col-12">
            <div class="steppers">
                <div class="steppers-header">
                    <ul>
                        <li class="confirmed">Informativa sulla privacy<svg aria-hidden="true" class="icon steppers-success">
                                <use href="{{ $sprite }}#it-check"></use>
                            </svg><span class="visually-hidden">{{ __('fixcity::segnalazione.steps.confirmed.label') }}</span></li>
                        <li class="active">Dati di segnalazione<span class="visually-hidden">{{ __('fixcity::segnalazione.steps.active.label') }}</span></li>
                        <li class="">Riepilogo</li>
                    </ul>
                    <span aria-hidden="true" class="steppers-index">2/3</span>
                </div>
            </div>
            <p class="d-lg-none my-5 title-xsmall">{{ __('fixcity::segnalazione.fields.required.note.label') }}</p>
        </div>
    </div>

    <div class="row" x-data="{ accordionOpen: true, parentsOpen: false }">
        <div class="col-12 col-lg-3 d-lg-block d-none mb-4">
            <div aria-labelledby="accordion-title-one" class="cmp-navscroll sticky-top">
                <nav aria-label="INFORMAZIONI RICHIESTE" class="it-navscroll-wrapper navbar navbar-expand-lg">
                    <div class="navbar-custom" id="navbarNavProgress">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                            <button aria-controls="collapse-one" aria-expanded="true" class="accordion-button pb-10 px-3" data-bs-target="#collapse-one" data-bs-toggle="collapse" type="button" @click="accordionOpen = !accordionOpen">
                                                INFORMAZIONI RICHIESTE
                                                <svg class="icon icon-xs right">
                                                    <use href="{{ $sprite }}#it-expand"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <div class="progress">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" class="it-navscroll-progressbar progress-bar" role="progressbar"></div>
                                        </div>
                                        <div aria-labelledby="accordion-title-one" class="accordion-collapse collapse show" id="collapse-one" role="region" x-show="accordionOpen" x-cloak>
                                            <div class="accordion-body">
                                                <ul class="link-list" data-element="page-index">
                                                    <li class="nav-item"><a class="nav-link" href="#report-place"><span>Luogo</span></a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#report-info"><span>Disservizio</span></a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#report-author"><span>Autore della segnalazione</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="col-12 col-lg-8 offset-lg-1">
            <div aria-live="polite" class="steppers-content">
                <div class="it-page-sections-container">
                    <section class="it-page-section" id="report-place">
                        <div class="cmp-card mb-40">
                            <div class="card has-bkg-grey p-big p-lg-4 shadow-sm">
                                <div class="border-0 card-header m-0 mb-lg-20 p-0">
                                    <div class="d-flex">
                                        <h2 class="mb-1 title-xxlarge">Luogo</h2>
                                    </div>
                                    <p class="mb-0 subtitle-small">Indica il luogo del disservizio</p>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cmp-input-autocomplete">
                                        <div class="bg-white form-group mb-0 mt-3 p-3">
                                            <label class="d-none label-input mb-2" for="autocomplete-regioni">Cerca un luogo*</label>
                                            <input class="autocomplete" data-bs-autocomplete="[{&quot;text&quot;:&quot;Abruzzo&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Basilicata&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Calabria&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Campania&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Emilia Romagna&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Friuli Venezia Giulia&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Lazio&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Liguria&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Lombardia&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Marche&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Molise&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Piemonte&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Puglia&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Sardegna&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Sicilia&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Toscana&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Trentino Alto Adige&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Umbria&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Valle d’Aosta&quot;,&quot;link&quot;:&quot;#&quot;},{&quot;text&quot;:&quot;Veneto&quot;,&quot;link&quot;:&quot;#&quot;}]" id="autocomplete-regioni" name="autocomplete-regioni" placeholder="{{ $placeholderSearch }}" type="search">
                                            <div class="link-wrapper mt-3">
                                                <a class="active icon-left list-item" href="#">
                                                    <span class="list-item-title-icon-wrapper">
                                                        <svg aria-hidden="true" class="icon icon-primary icon-sm mb-1">
                                                            <use href="{{ $sprite }}#it-map-marker"></use>
                                                        </svg>
                                                        <span class="list-item-title t-primary">Usa la tua posizione</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="it-page-section" id="report-info">
                        <div class="cmp-card mb-40">
                            <div class="card has-bkg-grey p-big shadow-sm">
                                <div class="border-0 card-header m-0 mb-lg-20 p-0">
                                    <div class="d-flex">
                                        <h2 class="icon-required mb-3 title-xxlarge">Disservizio</h2>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-lg-4 p-md-3 pb-lg-0 select-partials select-wrapper">
                                        <label class="visually-hidden" for="inefficiency">{{ $placeholderInefficiency }}</label>
                                        <select class="u-grey-dark" id="inefficiency">
                                            <option selected="selected" value="">{{ $placeholderInefficiency }}</option>
                                            <option value="property_damage">{{ __("fixcity::segnalazione.inefficiency_types.property_damage.label") }}</option>
                                        </select>
                                    </div>
                                    <div class="bg-white p-3 pb-lg-0 pt-lg-5 px-lg-4 text-area-wrapper">
                                        <div class="cmp-input form-group mb-0">
                                            <label class="cmp-input__label" for="title">Titolo*</label>
                                            <input class="form-control" id="title" name="title" type="text">
                                        </div>
                                    </div>
                                    <div class="bg-white cmp-text-area m-0 p-3 pb-lg-4 pt-lg-5 px-lg-4">
                                        <div class="form-group">
                                            <label class="d-block" for="details">Dettagli**</label>
                                            <textarea class="text-area" id="details" rows="2"></textarea>
                                            <span class="label">{{ __("fixcity::segnalazione.fields.details.max_chars.label") }}</span>
                                        </div>
                                    </div>
                                    <div class="bg-white btn-wrapper pb-3 pb-lg-4 pt-2 pt-lg-0 px-3 px-lg-4" x-data="{ removeFileLabel: '{{ __('fixcity::segnalazione.actions.remove_file.aria.label') }}', files: [], maxFiles: 5, maxSize: 5 * 1024 * 1024, addFiles(event) { const newFiles = Array.from(event.target.files); newFiles.forEach(file => { if (this.files.length < this.maxFiles && file.size <= this.maxSize) { this.files.push({ name: file.name, size: file.size, type: file.type, preview: file.type.startsWith('image/') ? URL.createObjectURL(file) : null }); } }); event.target.value = ''; }, removeFile(index) { if (this.files[index]?.preview) { URL.revokeObjectURL(this.files[index].preview); } this.files.splice(index, 1); } }">
                                        <label class="ms-2 pb-2 title-xsmall-bold u-grey-dark">Immagini</label>
                                        <template x-if="files.length === 0">
                                            <div class="align-items-center d-flex justify-content-between upload-wrapper">
                                                <img alt="" class="img" src="/themes/Sixteen/design-comuni/assets/images/img-disservizio-thumbnail.png">
                                                <span class="fw-bold ms-2 t-primary w-100">6yhakandsahm413d8.jpg</span>
                                                <a aria-label="{{ __("fixcity::segnalazione.actions.remove_image.aria.label") }}" class="align-self-center" href="#">
                                                    <svg class="icon icon-primary icon-sm mb-1">
                                                        <use href="{{ $sprite }}#it-close"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </template>
                                        <hr>
                                        <template x-for="(file, index) in files" :key="index">
                                            <div>
                                                <div class="align-items-center d-flex justify-content-between upload-wrapper">
                                                    <template x-if="file.preview">
                                                        <img :src="file.preview" alt="" class="img" style="width:48px;height:48px;object-fit:cover;border-radius:4px;">
                                                    </template>
                                                    <template x-if="!file.preview">
                                                        <svg aria-hidden="true" class="icon icon-primary" style="width:48px;height:48px;flex-shrink:0;">
                                                            <use href="{{ $sprite }}#it-file"></use>
                                                        </svg>
                                                    </template>
                                                    <span class="fw-bold ms-2 t-primary w-100" x-text="file.name"></span>
                                                    <a href="#" class="align-self-center" :aria-label="removeFileLabel + ' ' + file.name" @click.prevent="removeFile(index)">
                                                        <svg aria-hidden="true" class="icon icon-primary icon-sm mb-1">
                                                            <use href="{{ $sprite }}#it-close"></use>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <hr>
                                            </div>
                                        </template>
                                        <input type="file" id="file-upload-attachments" name="attachments[]" class="d-none" accept="image/jpeg,image/png,image/gif,image/webp" @change="addFiles($event)">
                                        <button type="button" aria-label="Carica file per il disservizio" class="btn btn-primary fw-bold w-100" @click="document.getElementById('file-upload-attachments').click()">
                                            <span class="rounded-icon">
                                                <svg aria-hidden="true" class="icon icon-sm icon-white">
                                                    <use href="{{ $sprite }}#it-upload"></use>
                                                </svg>
                                            </span>
                                            <span>Carica file</span>
                                        </button>
                                        <p class="mb-0 pt-10 title-xsmall u-grey-dark">Seleziona una o più immagini da allegare alla segnalazione</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="it-page-section" id="report-author">
                        <div class="cmp-card">
                            <div class="card has-bkg-grey shadow-sm">
                                <div class="border-0 card-header m-0 mb-lg-20 p-0">
                                    <div class="d-flex">
                                        <h2 class="mb-1 title-xxlarge">Autore della segnalazione</h2>
                                    </div>
                                    <p class="mb-0 subtitle-small">Informazione su di te</p>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cmp-info-button-card mt-3">
                                        <div class="card p-3 p-lg-4">
                                            <div class="card-body p-0">
                                                <h3 class="big-title mb-0">Giulia Bianchi</h3>
                                                <p class="card-info">Codice Fiscale<br><span>GLABNC72H25H501Y</span></p>
                                                <div class="accordion-item">
                                                    <div class="accordion-header" id="heading-collapse-parents">
                                                        <button @click="parentsOpen = !parentsOpen" aria-controls="collapse-parents" aria-expanded="false" class="accordion-button collapsed" data-bs-target="#collapse-parents" data-bs-toggle="collapse" type="button">
                                                            <span class="align-items-center d-flex">Mostra tutto<svg class="icon icon-primary icon-sm">
                                                                    <use href="{{ $sprite }}#it-expand"></use>
                                                                </svg></span>
                                                        </button>
                                                    </div>
                                                    <div class="accordion-collapse collapse" id="collapse-parents" role="region" x-show="parentsOpen" x-cloak>
                                                        <div class="accordion-body p-0">
                                                            <div class="bg-white cmp-info-summary has-border">
                                                                <div class="card">
                                                                    <div class="border-bottom border-light card-header d-flex d-flex justify-content-between justify-content-end mb-0 p-0">
                                                                        <h4 class="mb-3 title-large-semi-bold">Contatti</h4><a class="d-none text-decoration-none" href="#"><span class="t-primary text-button-sm-semi">Modifica</span></a>
                                                                    </div>
                                                                    <div class="card-body p-0">
                                                                        <div class="border-light single-line-info">
                                                                            <div class="text-paragraph-small">Telefono</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">+39 331 1234567</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="border-light single-line-info">
                                                                            <div class="text-paragraph-small">Email</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">mario.rossi@gmail.com</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer d-none p-0"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="cmp-nav-steps" x-data="{ showSaveAlert: false }">
                    <nav aria-label="Step" class="steppers-nav">
                        <button class="btn btn-sm p-0 steppers-btn-prev" type="button" onclick="window.location.href='{{ $prevUrl }}'">
                            <svg aria-hidden="true" class="icon icon-primary icon-sm">
                                <use href="{{ $sprite }}#it-chevron-left"></use>
                            </svg>
                            <span class="t-primary text-button-sm">{{ __('fixcity::segnalazione.actions.back.label') }}</span>
                        </button>
                        <button class="bg-white btn btn-outline-primary btn-sm d-lg-block d-none saveBtn steppers-btn-save" type="button" @click="showSaveAlert = true; setTimeout(() => showSaveAlert = false, 4000)">
                            <span class="t-primary text-button-sm">{{ __('fixcity::segnalazione.actions.save.label') }}</span>
                        </button>
                        <button class="bg-white btn btn-outline-primary btn-sm center d-block d-lg-none saveBtn steppers-btn-save" type="button" @click="showSaveAlert = true; setTimeout(() => showSaveAlert = false, 4000)">
                            <span class="t-primary text-button-sm">{{ __('fixcity::segnalazione.actions.save_short.label') }}</span>
                        </button>
                        <button class="btn btn-primary btn-sm steppers-btn-confirm" data-bs-target="#" data-bs-toggle="modal" type="button" onclick="window.location.href='{{ $nextUrl }}'">
                            <span class="text-button-sm">{{ __('fixcity::segnalazione.actions.next.label') }}</span>
                            <svg aria-hidden="true" class="icon icon-sm icon-white">
                                <use href="{{ $sprite }}#it-chevron-right"></use>
                            </svg>
                        </button>
                    </nav>
                    <div class="alert alert-success cmp-disclaimer d-none rounded" id="alert-message" role="alert" :class="{ 'd-none': !showSaveAlert }" x-cloak x-transition>
                        <span class="cmp-disclaimer__message d-inline-block text-uppercase">Richiesta salvata con successo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

