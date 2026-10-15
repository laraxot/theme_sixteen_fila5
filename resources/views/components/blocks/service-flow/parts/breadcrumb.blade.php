@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
@endphp
<div class="cmp-breadcrumbs" role="navigation">
    <nav class="breadcrumb-container" aria-label="breadcrumb"><ol class="breadcrumb p-0" data-element="breadcrumb">
        @foreach ($d('breadcrumb.items', []) as $crumb)
            <li class="breadcrumb-item"><a href="{{ $crumb['url'] ?? '#' }}">{{ $crumb['label'] ?? '' }}</a><span class="separator">/</span></li>
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{ $d('breadcrumb.current') }}</li>
    </ol></nav>
</div>
