@props(['data' => []])

@php
    use Modules\Fixcity\Models\Ticket;

    $ns = 'fixcity::ticket';
    $blockData = is_array($data) ? $data : [];

    $t = function ($value, $default = '') {
        if (empty($value)) {
            return $default;
        }

        return str_contains((string) $value, '::') ? __((string) $value) : (string) $value;
    };

    $breadcrumbItems = [];
    foreach ($blockData['breadcrumb'] ?? [] as $item) {
        $breadcrumbItems[] = [
            'label' => $t($item['label'] ?? ''),
            // i link nel JSON sono senza lingua ("/"): si prefissano qui; schemi e ancore restano intatti
            'url' => isset($item['url']) && str_starts_with((string) $item['url'], '/')
                ? \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl((string) $item['url'])
                : ($item['url'] ?? null),
            'active' => $item['active'] ?? false,
        ];
    }

    $title = $t($blockData['title'] ?? '', __($ns . '.heading.title.label'));

    $resolvedCount = (int) ($blockData['resolved_count'] ?? Ticket::query()
        ->where('status', 'resolved')
        ->where('updated_at', '>=', now()->subYear())
        ->count());
    $subtitleRaw = $blockData['subtitle'] ?? '';
    $subtitleKey = (! empty($subtitleRaw) && str_contains((string) $subtitleRaw, '::'))
        ? (string) $subtitleRaw
        : $ns . '.heading.subtitle.text';
    $subtitle = trans_choice($subtitleKey, $resolvedCount, ['count' => $resolvedCount]);
@endphp

<div class="w-full max-w-4xl">
    <div class="mb-6" role="navigation">
        <nav aria-label="{{ __('fixcity::global.breadcrumb') }}">
            <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-700" data-element="breadcrumb">
                @foreach ($breadcrumbItems as $item)
                    <li class="flex items-center gap-2{{ $item['active'] ?? false ? ' font-semibold text-slate-950' : '' }}"@if ($item['active'] ?? false) aria-current="page"@endif>
                        @if ($item['url'] ?? false)
                            <a class="underline decoration-slate-400 underline-offset-4 hover:text-sky-800" href="{{ $item['url'] }}">{{ $item['label'] }}</a><span aria-hidden="true">/</span>
                        @else
                            {{ $item['label'] }}
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
    <div>
        <h1 class="text-4xl font-bold tracking-tight text-slate-950 sm:text-5xl">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-700">{{ $subtitle }}</p>
        @endif
    </div>
</div>
