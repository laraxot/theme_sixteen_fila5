# HTML Parity Analysis: `segnalazione-dettaglio`

**Date:** 2026-04-08
**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-dettaglio.html
**Local:** http://127.0.0.1:8000/it/tests/segnalazione-dettaglio
**Status:** 🔄 In Progress
**Target:** 90% HTML structure parity

---

## Tooling

- **Script:** `bashscripts/html/compare-html-body.py`
- **Wrapper:** `bashscripts/html/html-structure-compare.sh`
- **Output:** `laravel/Themes/Sixteen/docs/body-structure-comparison/segnalazione-dettaglio/`

---

## Current State

### Files Fixed
- ✅ `laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php` — Now uses `<x-layouts.app>` and Volt pattern
- ✅ `laravel/Themes/Sixteen/resources/views/components/blocks/tests/segnalazione-dettaglio.blade.php` — Replaced `data-bs-toggle="dropdown"` with Alpine.js

### Remaining Issues (95 `data-bs-toggle` instances across theme)

| File | Issue | Priority |
|------|-------|----------|
| `segnalazione-02-dati.blade.php` | `data-bs-toggle="collapse"`, `data-bs-toggle="modal"` | HIGH |
| `segnalazione-03-riepilogo.blade.php` | `data-bs-toggle="modal"` | HIGH |
| `segnalazioni-elenco.blade.php` | `data-bs-toggle="modal"`, `data-bs-toggle="tab"`, `data-bs-toggle="collapse"` | HIGH |
| `tabs/map-list.blade.php` | `data-bs-toggle="modal"`, `data-bs-toggle="tab"`, `data-bs-toggle="collapse"` | HIGH |
| `segnalazioni/layout.blade.php` | Multiple `data-bs-toggle` | HIGH |
| `flow/segnalazioni/elenco.blade.php` | Multiple `data-bs-toggle` | MEDIUM |
| `flow/area-personale/dashboard.blade.php` | Multiple `data-bs-toggle` | MEDIUM |
| Header components (6 files) | `data-bs-toggle="dropdown"`, `data-bs-toggle="collapse"`, `data-bs-toggle="modal"` | MEDIUM |
| UI components (accordion, tabs, tooltip) | Various `data-bs-toggle` | LOW |

---

## Alpine.js Replacement Patterns

### Dropdown
```blade
<!-- BEFORE (Bootstrap JS) -->
<button data-bs-toggle="dropdown" aria-expanded="false">Toggle</button>
<div class="dropdown-menu">...</div>

<!-- AFTER (Alpine.js) -->
<div x-data="{ open: false }">
    <button @click="open = !open" :aria-expanded="open.toString()">Toggle</button>
    <div class="dropdown-menu" x-show="open" @click.away="open = false" x-cloak>...</div>
</div>
```

### Collapse/Accordion
```blade
<!-- BEFORE (Bootstrap JS) -->
<button data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true">Toggle</button>
<div id="collapse-one" class="collapse show">...</div>

<!-- AFTER (Alpine.js) -->
<div x-data="{ open: true }">
    <button @click="open = !open" :aria-expanded="open.toString()">Toggle</button>
    <div x-show="open" x-collapse>...</div>
</div>
```

### Modal
```blade
<!-- BEFORE (Bootstrap JS) -->
<button data-bs-toggle="modal" data-bs-target="#modal-id">Open</button>
<div id="modal-id" class="modal fade">...</div>

<!-- AFTER (Alpine.js) -->
<div x-data="{ show: false }">
    <button @click="show = true">Open</button>
    <div x-show="show" class="modal" @keydown.escape.window="show = false">...</div>
</div>
```

### Tabs
```blade
<!-- BEFORE (Bootstrap JS) -->
<button data-bs-toggle="tab" data-bs-target="#tab1">Tab 1</button>
<div id="tab1" class="tab-pane active">...</div>

<!-- AFTER (Alpine.js) -->
<div x-data="{ active: 'tab1' }">
    <button @click="active = 'tab1'" :class="{ 'active': active === 'tab1' }">Tab 1</button>
    <div x-show="active === 'tab1'">...</div>
</div>
```

---

## Architecture Decisions

### Why `design-comuni.blade.php` Should Not Exist
1. Creates parallel layout to `app.blade.php`
2. Breaks single-layout architecture
3. Test pages MUST use `<x-layouts.app>` which includes header/footer via `<x-section>`
4. Maintaining two layouts violates DRY principle

### Correct Pattern: `tests/[slug].blade.php`
```blade
<?php
new class extends Component {
    public string $slug = '';
    public string $pageSlug = '';
    public array $data = [];

    public function mount(string $slug = ''): void {
        $this->slug = $slug;
        $this->pageSlug = 'tests.'.$slug;
        $this->data = ['slug' => $slug];
    }
};
?>

<x-layouts.app>
    @volt('tests.view')
    <div class="cms-view-wrapper">
        @php
            $blocks = \Modules\Cms\Models\Page::getBlocksBySlug($this->pageSlug, 'content');
        @endphp
        <x-page side="content" :slug="$this->pageSlug" :data="$this->data" :blocks="$blocks" />
    </div>
    @endvolt
</x-layouts.app>
```

---

## Next Steps

1. Run comparison script: `bashscripts/html/html-structure-compare.sh segnalazione-dettaglio`
2. Review report for remaining gaps
3. Fix identified issues
4. Re-run comparison until 90%+ parity

---

## Cross-References

- → [Block Development Rules](../../design-comuni/BLOCK-DEVELOPMENT-RULES.md)
- → [Tailwind+Alpine Rules](../../design-comuni/TAILWIND-ALPINE-RULES.md)
- → [Body Structure Comparison](../../body-structure-comparison/INDEX.md)
- → [HTML Structure Comparison Bridge](../../../../docs/html-structure-comparison.md)
- → [Bashscripts HTML Docs](../../../../bashscripts/docs/html/README.md)

---

**Last Updated:** 2026-04-08  
**Next Review:** After server becomes accessible
