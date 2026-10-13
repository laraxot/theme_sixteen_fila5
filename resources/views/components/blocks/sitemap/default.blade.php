@props(['data' => []])

<style>
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap{max-width:1176px;margin:0 auto;padding:48px 16px 80px;color:#17324d}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap h1{margin:0 0 36px;color:#191919;font-size:2.75rem;font-weight:600}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap__section{border-bottom:1px solid #d9e2e8;padding:22px 0}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap__section>a,body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap__group>a{display:block;color:#007a52;font-size:1.25rem;font-weight:600;text-decoration:none}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap ul{margin:12px 0 0;padding:0 0 0 24px;list-style:none}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap li{margin:8px 0}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap li a{color:#007a52;text-decoration:none}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap li a:hover{text-decoration:underline}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap__group{margin-top:20px}
body:has(.page-content[data-slug="tests.mappa-sito"]) .dc-sitemap__group>a{font-size:1rem;color:#17324d}
</style>
<section class="dc-sitemap" aria-labelledby="dc-sitemap-title">
    <h1 id="dc-sitemap-title">{{ $data['title'] ?? 'Mappa del sito' }}</h1>
    @foreach(($data['sections'] ?? []) as $section)
        <div class="dc-sitemap__section">
            <a href="#">{{ $section['title'] ?? '' }}</a>
            @if(!empty($section['items']))
                <ul>@foreach($section['items'] as $item)<li><a href="#">{{ $item }}</a></li>@endforeach</ul>
            @endif
            @foreach(($section['groups'] ?? []) as $group)
                <div class="dc-sitemap__group"><a href="#">{{ $group['title'] ?? '' }}</a><ul>@foreach(($group['items'] ?? []) as $item)<li><a href="#">{{ $item }}</a></li>@endforeach</ul></div>
            @endforeach
        </div>
    @endforeach
</section>
