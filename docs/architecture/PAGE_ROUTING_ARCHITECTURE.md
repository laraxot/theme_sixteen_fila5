# Page Routing Architecture - Folio + Volt

**Data**: 2026-04-01  
**Status**: ✅ IMPLEMENTED  
**Methodology**: DRY + KISS + Forward-Only

---

## 🎯 Architectural Principle

### ONE `[slug].blade.php` for ALL Pages

**Philosophy**: Single dynamic route handles ALL CMS pages via slug parameter.

**Why**:
- ✅ **DRY**: One blade file manages 38+ pages (NOT 38 separate files)
- ✅ **KISS**: Simple logic with dynamic slug resolution
- ✅ **Maintainability**: Change 1 file, updates all pages
- ✅ **Scalability**: Add new pages without creating blade files
- ✅ **Consistency**: All pages use same structure and lifecycle

---

## 📁 Directory Structure

```
laravel/Themes/Sixteen/resources/views/pages/
├── [container0]/           # CMS container pages (dynamic)
├── [slug].blade.php        # ⭐ SINGLE dynamic route for ALL pages
├── auth/                   # Authentication pages (login, register)
├── tests/                  # Design Comuni test pages
│   ├── [slug].blade.php    # Dynamic route for /it/tests/*
│   └── index.blade.php     # Tests listing page
├── index.blade.php         # Homepage (/)
└── .gitkeep
```

### ❌ REMOVED (Violates Architecture)
```
❌ administration/          # Should use [slug].blade.php
❌ news/                   # Should use [slug].blade.php
❌ services/               # Should use [slug].blade.php
❌ home.blade.php          # Duplicate - use index.blade.php
❌ homepage.blade.php      # Duplicate - use index.blade.php
❌ prova01.blade.php       # Test file - should be in tests/
❌ segnalazioni.blade.php  # Should use [slug].blade.php
```

---

## 🔧 Implementation

### 1. Dynamic Route File

**File**: `laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`

```php
<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $slug = '';
    public string $pageSlug = '';
    public array $data = [];

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->pageSlug = 'tests.'.$slug;
        $this->data = ['slug' => $slug];
    }
};
?>

<x-layouts.app>
    @volt('tests.view')
    <div class="tests-view-wrapper">
        @php
            $blocks = \Modules\Cms\Models\Page::getBlocksBySlug($this->pageSlug, 'content');
        @endphp

        <div class="page-content content" data-slug="{{ $this->pageSlug }}" data-side="content">
            @foreach($blocks as $block)
                @include($block->view, array_merge(['data' => []], $block->data))
            @endforeach
        </div>
    </div>
    @endvolt
</x-layouts.app>
```

### 2. URL to Route Mapping

| URL | File | Slug | JSON Content |
|-----|------|------|--------------|
| `/it/tests/homepage` | `[slug].blade.php` | `homepage` | `tests.homepage.json` |
| `/it/tests/argomenti` | `[slug].blade.php` | `argomenti` | `tests.argomenti.json` |
| `/it/tests/amministrazione` | `[slug].blade.php` | `amministrazione` | `tests.amministrazione.json` |
| `/it/tests/appuntamento-06-conferma` | `[slug].blade.php` | `appuntamento-06-conferma` | `tests.appuntamento-06-conferma.json` |

### 3. Content Flow

```
1. User requests: /it/tests/homepage
2. Folio routes to: pages/tests/[slug].blade.php
3. Volt Component mounts with: $slug = 'homepage'
4. Component sets: pageSlug = 'tests.homepage'
5. Loads JSON from: config/local/fixcity/database/content/pages/tests.homepage.json
6. Renders blocks via: @include($block->view, $block->data)
7. Output: Full HTML page with header, content, footer
```

---

## 🧩 Block System

### JSON Content Structure

**File**: `laravel/config/local/fixcity/database/content/pages/tests.homepage.json`

```json
{
  "id": "tests.homepage",
  "slug": "tests.homepage",
  "title": {"it": "Homepage", "en": "Homepage"},
  "content_blocks": {
    "it": [
      {
        "id": "block-001",
        "type": "header-slim",
        "view": "pub_theme::components.blocks.header.slim",
        "data": {
          "region": "Nome della Regione",
          "language": "ITA"
        }
      },
      {
        "id": "block-002",
        "type": "hero",
        "view": "pub_theme::components.blocks.hero.homepage",
        "data": {
          "title": "NOME DEL COMUNE",
          "subtitle": "CONTENUTI IN EVIDENZA"
        }
      }
    ]
  }
}
```

### Block View Pattern

**Pattern**: `pub_theme::components.blocks.<type>.<blade>`

**Example**:
- `pub_theme::components.blocks.header.slim`
- `pub_theme::components.blocks.hero.homepage`
- `pub_theme::components.blocks.footer.main`

**NEVER** page-specific:
- ❌ `pub_theme::components.blocks.tests.homepage` (WRONG)
- ✅ `pub_theme::components.blocks.hero.homepage` (CORRECT)

---

## 📋 Rules

### ✅ DO
1. Use `[slug].blade.php` for ALL dynamic CMS pages
2. Store content in JSON files
3. Use universal blocks (NOT page-specific)
4. Keep blade files minimal (logic in PHP/JSON)
5. Use `tests/` folder for Design Comuni pages

### ❌ DON'T
1. Create folder-per-page structure
2. Create individual blade files (homepage.blade.php, etc.)
3. Hardcode HTML in blade files
4. Create page-specific blocks
5. Duplicate functionality across files

---

## 🔄 Migration Guide

### From Old Structure to New

**Before** (❌ WRONG):
```
pages/
├── homepage.blade.php
├── argomenti.blade.php
└── amministrazione.blade.php
```

**After** (✅ CORRECT):
```
pages/
└── [slug].blade.php
    ├── mount($slug)
    └── loads JSON content
```

**Migration Steps**:
1. Create `[slug].blade.php` with Volt component
2. Move content to JSON files
3. Delete old blade files
4. Update documentation

---

## 📊 Benefits

| Metric | Before (Multiple Files) | After ([slug].blade.php) |
|--------|------------------------|--------------------------|
| Blade Files | 38+ | 1 |
| Content Changes | Edit blade + Git | Edit JSON (no code) |
| New Pages | Create blade file | Add JSON only |
| Bug Fixes | Fix 38 files | Fix 1 file |
| Consistency | Varies per file | Guaranteed |
| DRY Violation | HIGH | ZERO |

---

## 🔗 Related Documentation

- **ARCHITECTURAL_DECISIONS.md**: Design Comuni philosophy
- **MASTER_IMPLEMENTATION_PLAN.md**: 38 pages plan
- **LAYOUT_ARCHITECTURE_MAP.md**: Layout hierarchy
- **QWEN.md**: Project rules and memories

---

## 🎯 Status

| Component | Status | Notes |
|-----------|--------|-------|
| `[slug].blade.php` | ✅ Implemented | tests/ folder |
| `[container0]/` | ✅ Exists | CMS dynamic pages |
| `auth/` | ✅ Exists | Authentication |
| Old blade files | ✅ Removed | home, homepage, prova01, etc. |
| Documentation | ✅ Created | This file |

---

**Last Updated**: 2026-04-01  
**Maintained By**: Architecture Team  
**Compliance**: DRY ✅ KISS ✅ Forward-Only ✅
