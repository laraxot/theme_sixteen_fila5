@props([
    'title' => __('pub_theme::blocks_content.confirmation.summary.title'),
    'status_message' => __('pub_theme::blocks_content.confirmation.request_saved_successfully.message'),
    'location' => '',
    'map_url' => 'https://maps.google.com',
    'disservice_type' => '',
    'disservice_title' => '',
    'disservice_details' => '',
    'images' => [],
    'author_name' => '',
    'author_cf' => '',
    'author_phone' => '',
    'author_email' => '',
    'terms_url' => '#',
    'confirm_button' => __('pub_theme::blocks_content.confirmation.confirm_and_submit.label'),
    'cancel_button' => __('pub_theme::blocks_content.confirmation.cancel.label'),
])

<div class="confirmation-block mb-5">
    <div class="alert alert-success mb-4" style="background:#e6f4ea; border-left:4px solid #007A52;">
        <strong>{{ $status_message }}</strong>
    </div>

    <h2 class="h4-semi-bold mb-3">{{ $title }}</h2>

    @if($location)
    <section class="mb-4">
        <h3 class="h6-semi-bold mb-2">{{ __('pub_theme::blocks_common.shared.place.label') }}</h3>
        <p class="mb-1"><strong>{{ __('pub_theme::blocks_content.confirmation.address_colon.label') }}</strong> {{ $location }}</p>
        <x-blocks.map-location label="" placeholder="" use_location_button="" map_url="{{ $map_url }}" />
    </section>
    @endif

    @if($disservice_type)
    <section class="mb-4">
        <h3 class="h6-semi-bold mb-2">{{ __('pub_theme::blocks_common.shared.service_issue.label') }}</h3>
        <div class="card shadow-sm border-light p-3">
            <p><strong>{{ __('pub_theme::blocks_content.confirmation.type_colon.label') }}</strong> {{ $disservice_type }}</p>
            <p><strong>{{ __('pub_theme::blocks_content.confirmation.title_colon.label') }}</strong> {{ $disservice_title }}</p>
            <p><strong>{{ __('pub_theme::blocks_content.confirmation.details_colon.label') }}</strong> {{ $disservice_details }}</p>
            @if(count($images) > 0)
            <div class="mt-2">
                <strong>{{ __('pub_theme::blocks_content.confirmation.images_colon.label') }}</strong>
                <div class="d-flex gap-2 mt-1">
                    @foreach($images as $img)
                    <img src="{{ $img }}" alt="{{ __('pub_theme::blocks_content.confirmation.attached_image.label') }}" class="img-thumbnail" style="width:80px;height:80px;object-fit:cover;border-radius:4px;">
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if($author_name)
    <section class="mb-4">
        <h3 class="h6-semi-bold mb-2">{{ __('pub_theme::blocks_common.shared.report_author.label') }}</h3>
        <div class="card shadow-sm border-light p-3">
            <p><strong>{{ __('pub_theme::blocks_content.confirmation.name_colon.label') }}</strong> {{ $author_name }}</p>
            @if($author_cf) <p><strong>{{ __('pub_theme::blocks_content.confirmation.tax_code_colon.label') }}</strong> {{ $author_cf }}</p> @endif
            @if($author_phone) <p><strong>{{ __('pub_theme::blocks_common.shared.phone_colon.label') }}</strong> {{ $author_phone }}</p> @endif
            @if($author_email) <p><strong>{{ __('pub_theme::blocks_common.shared.email_colon.label') }}</strong> {{ $author_email }}</p> @endif
        </div>
    </section>
    @endif

    <div class="d-flex gap-3 mt-4">
        <a href="{{ $terms_url }}" class="text-decoration-underline">{{ __('pub_theme::blocks_content.confirmation.read_terms_and_conditions.label') }}</a>
    </div>
    <div class="d-flex gap-3 mt-3">
        <button type="button" class="btn btn-primary fw-bold" style="background:#007A52;border:#007A52;">{{ $confirm_button }}</button>
        <button type="button" class="btn btn-outline-secondary fw-bold">{{ $cancel_button }}</button>
    </div>
</div>