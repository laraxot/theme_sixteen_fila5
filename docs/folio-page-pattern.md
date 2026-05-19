# Folio Page Pattern - Volt Component Thin + x-page

## Regola Fondamentale

**Le pagine Folio devono essere THIN**: il componente Volt gestisce solo slug/mount.
Il rendering dei blocchi CMS è delegato interamente a `<x-page>`.

## Esempio Corretto

```blade
<x-layouts.app>
    @volt('tests.view')
        <div>
            <x-page side="content" :slug="$pageSlug" :data="$data" />
        </div>
    @endvolt
</x-layouts.app>
```

## Esempio Sbagliato

```blade
<x-layouts.app>
    @volt('tests.view')
    <div>
        @php
            $blocks = \Modules\Cms\Models\Page::getBlocksBySlug($this->pageSlug, 'content');
            $skipTypes = ['header-slim', 'header-main', 'header-nav-wrapper', 'navigation', 'footer-main'];
        @endphp
        @foreach($blocks as $block)
            @if(!in_array($block->type, $skipTypes))
                @include($block->view, ['data' => $block->data])
            @endif
        @endforeach
    </div>
    @endvolt
</x-layouts.app>
```

## Perché è Sbagliato

1. **`@php` nel template** = logica di business nel layer di presentazione (viola SRP)
2. **Duplicazione**: `skipTypes` e il loop sono già gestiti internamente da `<x-page>`
3. **Accoppiamento diretto** con `\Modules\Cms\Models\Page` nel template
4. **Non riusabile**: ogni pagina Folio dovrebbe riscrivere la stessa logica

## Come Funziona `<x-page>`

`<x-page>` risolve a `Modules\Cms\View\Components\Page` che nel costruttore:

```php
$this->blocks = PageModel::getBlocksBySlug($this->slug, $this->side);
```

Il componente si occupa di:
- Fetch dei blocchi dal database per `slug` e `side`
- Passaggio a `cms::components.page` view per il rendering

## Responsabilità Separate

| Layer | Responsabilità |
|-------|----------------|
| Volt Component (Folio) | Riceve `$slug` dal route, costruisce `$pageSlug`, passa `$data` |
| `<x-page>` | Fetch blocchi CMS + rendering dei blocchi |
| `cms::components.page` | Loop sui blocchi e `@includeIf` per ogni block view |

## Nota: Quale `<x-page>` viene usato?

`<x-page>` risolve a `Modules\Cms\View\Components\Page` (classe PHP registrata),
**non** al file `Themes/Sixteen/resources/views/components/page.blade.php`
(che invece legge da JSON config e si usa con `@include('pub_theme::components.page')`).

Vedere `page-component-conflict.md` per dettagli sul conflict di namespace.
