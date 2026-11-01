{{--
    Campo di caricamento documenti. `$upload`: label, label_class, files[] {name, state: success|error, visually_hidden, weight}, input_id, link_label, info.
    Solo markup (nessun caricamento reale): il riferimento e' statico.
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="cmp-upload">
    <span class="{{ $upload['label_class'] ?? 'cmp-upload__label mb-3' }}">{{ $upload['label'] ?? '' }}</span>
    <ul class="upload-file-list cmp-upload__list m-0">
        @foreach ($upload['files'] ?? [] as $file)
            <li class="upload-file {{ $file['state'] ?? 'success' }}">
                <svg class="icon icon-sm" aria-hidden="true"><use href="{{ $icon('it-file') }}"></use></svg>
                @if (($file['state'] ?? 'success') === 'success')
                    <p class="cmp-upload__list-item"><span class="visually-hidden">{{ $file['visually_hidden'] ?? '' }}</span> {{ $file['name'] ?? '' }} </p>
                @else
                    <p><span class="visually-hidden">{{ $file['visually_hidden'] ?? '' }}</span> {{ $file['name'] ?? '' }}
                        <span class="upload-file-weight">{{ $file['weight'] ?? '' }}</span></p>
                @endif
                <button><span class="visually-hidden">{{ $file['remove_label'] ?? '' }}</span>
                    <svg class="{{ ($file['state'] ?? 'success') === 'success' ? 'icon icon-sm' : 'icon' }}" aria-hidden="true"><use href="{{ $icon('it-close') }}"></use></svg></button>
            </li>
        @endforeach
    </ul>
    <input type="file" name="upload1" id="{{ $upload['input_id'] ?? '' }}" class="upload" multiple="multiple">
    <label for="{{ $upload['input_id'] ?? '' }}" class="w-100 d-flex justify-content-center w-100">
        <svg class="icon icon-sm" aria-hidden="true"><use href="{{ $icon('it-upload') }}"></use></svg>
        <span>{{ $upload['link_label'] ?? '' }}</span></label>
    <p class="mt-2 cmp-upload__info mb-4">{{ $upload['info'] ?? '' }}</p>
</div>
