@props(['data' => []])

<style>
body:has(.page-content[data-slug="tests.accesso-servizio"]) .page-content > .cmp-heading{max-width:1116px;margin:0 auto;border-bottom:1px solid #c7c7c7;padding:32px 0 28px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .page-content > .cmp-heading h1{margin:0;color:#191919;font-size:2.5rem;font-weight:600;line-height:1.2}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .page-content > .cmp-heading p{margin:12px 0 0;color:#191919;font-size:1.125rem;line-height:1.5}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-methods{max-width:784px;margin:0 auto;padding:40px 0 24px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-methods > h2{position:absolute;width:1px;height:1px;margin:-1px;padding:0;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap;border:0}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method{margin:0 0 36px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method h2{margin:0 0 8px;color:#191919;font-size:2rem;font-weight:600;line-height:1.2}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method p{margin:0 0 16px;color:#191919;font-size:1.125rem;line-height:1.5}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__primary,body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__outline{display:inline-flex;min-height:48px;align-items:center;justify-content:center;gap:10px;border-radius:4px;padding:11px 20px;font-size:1rem;font-weight:600;line-height:1.2;text-decoration:none}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__primary{background:#006bd6;color:#fff}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__primary,body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__outline{width:260px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__primary:hover{background:#0054a6;color:#fff}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__primary img{width:24px;height:24px;flex:0 0 auto}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__link{display:block;width:max-content;margin-top:10px;color:#007a52;font-size:1rem;text-decoration:underline;text-underline-offset:3px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__alternatives{display:flex;flex-wrap:wrap;gap:8px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__outline{border:2px solid #007a52;margin:0 12px 0 0;background:#fff;color:#007a52}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts{background:#f2f7f5;padding:48px 16px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts__card{max-width:784px;margin:0 auto;padding:32px;background:#fff;box-shadow:0 2px 12px rgb(23 50 77 / 12%)}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts h2{margin:0 0 20px;color:#191919;font-size:1.5rem;font-weight:600}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts ul{margin:0;padding:0;list-style:none}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts li+li{margin-top:14px}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts a{display:flex;align-items:center;gap:12px;color:#007a52;font-size:1rem;text-decoration:none}
body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts svg{width:22px;height:22px;flex:none}
@media(max-width:767px){body:has(.page-content[data-slug="tests.accesso-servizio"]) .page-content > .cmp-heading{padding:24px 16px}body:has(.page-content[data-slug="tests.accesso-servizio"]) .page-content > .cmp-heading h1{font-size:2rem}body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-methods{padding:32px 16px 16px}body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__primary,body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__outline{width:100%;margin:0}body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-access-method__alternatives{display:grid}body:has(.page-content[data-slug="tests.accesso-servizio"]) .dc-contacts__card{padding:24px}}
</style>

<section class="dc-access-methods" aria-labelledby="dc-access-methods-title">
    <h2 id="dc-access-methods-title" class="sr-only">Modalità di accesso</h2>
    @foreach(($data['items'] ?? []) as $item)
        <article class="dc-access-method">
            <h2>{{ $item['label'] ?? '' }}</h2>
            <p>{{ $item['description'] ?? '' }}</p>
            @if(!empty($item['items_sub']))
                <div class="dc-access-method__alternatives">
                    @foreach($item['items_sub'] as $sub)
                        <a class="dc-access-method__outline" href="{{ $sub['url'] ?? '#' }}">{{ $sub['label'] ?? '' }}</a>
                    @endforeach
                </div>
            @else
                <a class="dc-access-method__primary" href="{{ $item['url'] ?? '#' }}">
                    @if(!empty($item['icon']))<img src="{{ asset('themes/Sixteen/design-comuni/assets/images/'.$item['icon']) }}" alt="" width="24" height="24" loading="lazy">@endif
                    <span>{{ $item['action_label'] ?? ($item['button_label'] ?? ('Entra con '.($item['label'] ?? ''))) }}</span>
                </a>
                @if(!empty($item['link_text']))<a class="dc-access-method__link" href="{{ $item['link_url'] ?? '#' }}">{{ $item['link_text'] }}<span class="sr-only"> ({{ $item['label'] ?? '' }})</span></a>@endif
            @endif
        </article>
    @endforeach
</section>
