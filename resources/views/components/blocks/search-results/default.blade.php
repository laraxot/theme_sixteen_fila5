@props([
    'query' => '',
    'results' => [],
    'result_count' => null,
])

@php
    $count = $result_count ?? count($results);
@endphp

<section class="section section-muted pb-90 pb-lg-50">
    <div class="container-xl px-lg-5 pt-0">
        <div class="row">
            <div class="col-12">
                <div class="row variable-gutters">
                    <div class="col-12">
                        <h1 class="title-xl-1-semi-bold mb-4">
                            {{ __('fixcity::search.results.title', ['count' => $count, 'query' => $query]) }}
                        </h1>
                        @if ($count > 0)
                            <p class="mb-4">
                                {{ __('fixcity::search.results.subtitle', ['count' => $count]) }}
                            </p>
                        @else
                            <p class="mb-4">
                                {{ __('fixcity::search.results.empty') }}
                            </p>
                        @endif
                    </div>
                </div>
                @if ($count > 0)
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-8">
                                @if (isset($results) && is_array($results))
                                    @foreach ($results as $result)
                                        <div class="card card-body shadow-sm mb-3">
                                            <h2 class="title-medium-2-semi-bold mb-1">
                                                @isset($result['url'])
                                                    <a href="{{ $result['url'] }}" @if (isset($result['new_window'])) target="_blank" rel="noopener" @endif>{{ $result['title'] }}</a>
                                                @else
                                                    {{ $result['title'] }}
                                                @endisset
                                            </h2>
                                            @if (isset($result['type']))
                                                <span class="badge rounded-pill bg-secondary">{{ $result['type'] }}</span>
                                            @endif
                                            @isset($result['description'])
                                                <p class="mb-0">{{ $result['description'] }}</p>
                                            @endisset
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <div class="alert alert-secondary">
                            {{ __('fixcity::search.results.empty') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
