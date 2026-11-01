---
id: homepage-visual-parity-arch
title: Homepage Visual Parity Architecture
type: architecture
status: draft
links:
  github_issue: #999
  discussion: #999
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "homepage visual parity architecture sixteen"
---
# Homepage Visual Parity Architecture

## Context
The Sixteen theme implements the Design Comuni reference design. Current visual parity is ~40% (target 97%). This architecture document explains the root causes of the discrepancies and the architectural approach to fix them systematically.

## Root Cause Analysis

### Why the discrepancies exist
1. **Header components use wrong data structure**: The header Blade components read `header.json` but map fields incorrectly to the Design Comuni HTML structure (SVG icons not rendered, color tokens wrong).
2. **Search component incomplete**: The search block component lacks the "Cerca" label and the magnifying glass SVG is not properly attached to the input.
3. **No responsive navigation pattern**: The hamburger menu logic (Alpine.js) is missing or not triggered at the correct breakpoint.
4. **Global link styles too aggressive**: A global CSS rule applies `underline` to all `<a>` elements instead of only on hover/focus.
5. **Content blocks don't match reference JSON structure**: The content blocks in `homepage.json` are missing fields present in the reference (date badge, image, buttons, etc.).
6. **Component library gaps**: Several Design Comuni components (event calendar, rating widget, thematic sites cards) don't exist in the Sixteen component library.
7. **Token mapping incomplete**: Design Comuni color/typography tokens not fully mapped to Tailwind classes in components.

## Architecture Decisions

### 1. Data-driven components (no hardcoded content)
- All content comes from JSON (`header.json`, `footer.json`, page-specific JSONs)
- Components receive data via props, never query CMS directly
- JSON schema must match reference structure exactly

### 2. Component-per-block pattern
Each Design Comuni section = one Blade component:
- `header.blade.php` → `<x-section slug="header" />`
- `hero.blade.php` → hero section
- `news.blade.php` → news section
- `events.blade.php` → events section
- `government-organs.blade.php` → organi di governo
- `calendar.blade.php` → calendario eventi
- `featured-topics.blade.php` → argomenti in evidenza
- `thematic-sites.blade.php` → siti tematici
- `search.blade.php` → cerca
- `rating.blade.php` → rating
- `contacts.blade.php` → contatta il comune
- `footer.blade.php` → `<x-section slug="footer" />`

### 3. Token system (Tailwind config)
- Extend `tailwind.config.js` with Design Comuni tokens:
  - Colors: primary `#007a52`, primary-dark `#006b4f`, text `#17324d`, muted `#5d7083`, border `#d9e2e8`, section-bg `#f5f7f9`, focus `#80c8ad`
  - Fonts: Titillium Web (heading), Lora (body)
  - Spacing: 8px base grid
- Use `@apply` in component CSS or utility classes in Blade

### 4. State management (Alpine.js)
- Header: `x-data="{ open: false }"` for hamburger, language switcher
- Search: `x-data` for focus states, autocomplete
- Rating: `x-data` for star selection
- All interactive components use Alpine for state, no Vue/React

### 5. Responsive breakpoints
- Mobile first: `< 768px` = hamburger menu visible, stacked layout
- Tablet: `768px - 1024px` = adjusted grids
- Desktop: `> 1024px` = full layout, horizontal nav

## Component Architecture

### Header (`components/sections/header/tailwind.blade.php`)
```blade
<header class="bg-[#006b4f] text-white">
  <!-- Top bar: utility links, language, login -->
  <div class="flex items-center justify-between px-4 py-2">
    <nav class="flex gap-4 text-sm"><!-- utility links --></nav>
    <div class="flex items-center gap-4"><!-- lang switcher, login --></div>
  </div>
  <!-- Main nav: logo, brand, tagline, primary nav -->
  <div class="px-4 py-4 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <img src="{{ $logo }}" alt="" class="h-12"><!-- logo -->
      <div>
        <h1 class="text-xl font-bold">{{ $brand.name }}</h1>
        <p class="text-sm">{{ $brand.tagline }}</p>
      </div>
    </div>
    <nav class="hidden lg:flex gap-6"><!-- primary nav links --></nav>
    <button @click="open = !open" class="lg:hidden"><!-- hamburger --></button>
  </div>
  <!-- Mobile nav -->
  <div x-show="open" x-transition class="lg:hidden px-4 pb-4"><!-- nav links --></div>
</header>
```

### Search (`components/blocks/search/default.blade.php`)
```blade
<form class="relative w-full max-w-md" role="search">
  <label for="search" class="sr-only">Cerca</label>
  <input id="search" type="search" placeholder="Cerca" class="w-full pl-10 pr-4 py-2 border rounded">
  <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
    <svg class="w-5 h-5"><!-- magnifying glass --></svg>
  </button>
</form>
```

### Social Icons
```blade
@foreach($social as $item)
  <a href="{{ $item.url }}" aria-label="{{ $item.label }}" class="text-white hover:text-[#80c8ad]">
    <svg class="w-5 h-5"><!-- inline SVG per platform --></svg>
  </a>
@endforeach
```

## Verification Architecture

### Automated checks
1. **JSON Schema validation**: `jq` validation of all page/section JSONs
2. **Blade compilation**: `php artisan view:clear && php artisan view:cache`
3. **HTML structure diff**: Node script comparing DOM tree vs reference
4. **Visual regression**: Playwright screenshots at 375/768/1440px → pixelmatch
5. **WCAG audit**: axe-core or mauve for contrast, ARIA, keyboard
6. **Console errors**: Playwright page.on('console') capture

### Manual checks
- Keyboard navigation (Tab, Enter, Escape)
- Screen reader (NVDA/VoiceOver) spot check
- Color contrast with APCA calculator

## Error Prevention Rules

1. **Never hardcode content** in Blade — always from JSON
2. **Never use Bootstrap classes** — only Tailwind + DaisyUI + Flowbite utilities
3. **One component per Design Comuni block** — no mega-components
4. **Test at 3 breakpoints** before declaring done
6. **WCAG audit mandatory** for every new/modified component
7. **Update BMAD story + decision log** when fixing a discrepancy

## Second Brain Integration

- Initiative: `kp-e8aae9de701a4371a3c059431d83e54c` (Homepage visual parity 40% → 97%)
- Knowledge rules (knowledge.md):
  - R001: Header/footer from JSON only
  - R002: Component = single Design Comuni block
  - R003: Tokens in tailwind.config.js
  - R004: Alpine.js for all interactivity
  - R005: 3-breakpoint verification mandatory
  - R006: WCAG audit before merge
  - R007: No global link underline
  - R008: SVG icons inline, never as font/letter fallback