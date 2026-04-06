{{--
    Filters Sidebar Block - Bootstrap Italia Style
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html
--}}
@props(['data' => []])

@php
    $title = $data['title'] ?? 'categoria';
    $filters = $data['filters'] ?? [];
@endphp

<div class="col-lg-3 d-none d-lg-block">
    <fieldset>
        <legend class="h6 text-uppercase category-list__title">{{ $title }}</legend>
        <div class="categoy-list pb-4">
            <ul>
                @foreach($filters as $filter)
                <li>
                    <div class="form-check">
                        <div class="checkbox-body border-light py-1">
                            <input type="checkbox" id="{{ $filter['id'] }}" name="category" value="{{ $filter['value'] ?? '' }}">
                            <label for="{{ $filter['id'] }}" class="subtitle-small_semi-bold mb-0 category-list__list">
                                {{ $filter['label'] }} ({{ $filter['count'] ?? 0 }})
                            </label> 
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </fieldset>
</div>
