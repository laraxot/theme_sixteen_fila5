@props([
    'title' => 'Riepilogo',
    'status_message' => 'Richiesta salvata con successo',
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
    'confirm_button' => 'Conferma e invia',
    'cancel_button' => 'Annulla',
])

<div class="confirmation-block mb-5">
    <div class="alert alert-success mb-4" style="background:#e6f4ea; border-left:4px solid #007A52;">
        <strong>{{ $status_message }}</strong>
    </div>

    <h2 class="h4-semi-bold mb-3">{{ $title }}</h2>

    @if($location)
    <section class="mb-4">
        <h3 class="h6-semi-bold mb-2">Luogo</h3>
        <p class="mb-1"><strong>Indirizzo:</strong> {{ $location }}</p>
        <x-blocks.map-location label="" placeholder="" use_location_button="" map_url="{{ $map_url }}" />
    </section>
    @endif

    @if($disservice_type)
    <section class="mb-4">
        <h3 class="h6-semi-bold mb-2">Disservizio</h3>
        <div class="card shadow-sm border-light p-3">
            <p><strong>Tipo:</strong> {{ $disservice_type }}</p>
            <p><strong>Titolo:</strong> {{ $disservice_title }}</p>
            <p><strong>Dettagli:</strong> {{ $disservice_details }}</p>
            @if(count($images) > 0)
            <div class="mt-2">
                <strong>Immagini:</strong>
                <div class="d-flex gap-2 mt-1">
                    @foreach($images as $img)
                    <img src="{{ $img }}" alt="Immagine allegata" class="img-thumbnail" style="width:80px;height:80px;object-fit:cover;border-radius:4px;">
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if($author_name)
    <section class="mb-4">
        <h3 class="h6-semi-bold mb-2">Autore della segnalazione</h3>
        <div class="card shadow-sm border-light p-3">
            <p><strong>Nome:</strong> {{ $author_name }}</p>
            @if($author_cf) <p><strong>Codice Fiscale:</strong> {{ $author_cf }}</p> @endif
            @if($author_phone) <p><strong>Telefono:</strong> {{ $author_phone }}</p> @endif
            @if($author_email) <p><strong>Email:</strong> {{ $author_email }}</p> @endif
        </div>
    </section>
    @endif

    <div class="d-flex gap-3 mt-4">
        <a href="{{ $terms_url }}" class="text-decoration-underline">Leggi termini e condizioni</a>
    </div>
    <div class="d-flex gap-3 mt-3">
        <button type="button" class="btn btn-primary fw-bold" style="background:#007A52;border:#007A52;">{{ $confirm_button }}</button>
        <button type="button" class="btn btn-outline-secondary fw-bold">{{ $cancel_button }}</button>
    </div>
</div>