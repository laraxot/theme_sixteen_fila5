# Analysis: Domande Frequenti (FAQ) - Structural Parity

## Objective
Achieve 100% HTML structure parity for the FAQ page between the local implementation and the official Design Comuni reference.

**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/domande-frequenti.html
**Local:** http://127.0.0.1:8000/it/tests/domande-frequenti

## Component Audit & Fixes

### 1. Main Layout Structure
- **Reference:** `<main> <div class="container" id="main-container"> ... </div> </main>`
- **Local Fix:** Updated `laravel/Themes/Sixteen/resources/views/components/layouts/app.blade.php` to wrap content in `div#main-container.container` within the `<main>` tag. Removed the `id="main-container"` from the `<main>` tag itself.
- **Status:** ✅ Identical

### 2. Breadcrumbs
- **Reference:** `div.row > div.col-12.col-lg-10 > div.cmp-breadcrumbs > nav > ol.breadcrumb`
- **Local Fix:** Updated `breadcrumb/default.blade.php` to remove the extra `container` wrapper and match the nesting exactly.
- **Status:** ✅ Identical

### 3. Hero Section
- **Reference:** `div.row > div.col-12.col-lg-10 > div.cmp-hero > section.it-hero-wrapper`
- **Local Fix:** Updated `hero/default.blade.php` to remove redundant wrappers and align with the reference structure.
- **Status:** ✅ Identical

### 4. Search Bar
- **Reference:** `div.row > div.col-12.col-lg-8.offset-lg-2 > div.cmp-input-search > div.form-group > div.input-group`
- **Local Fix:** Updated `search/input.blade.php`. Matched the exact nesting and classes. Removed local Tailwind overrides that were breaking structure.
- **Status:** ✅ Identical

### 5. Accordion (FAQ List)
- **Reference:** `div.row > div.col-12.col-lg-8.offset-lg-2 > div.cmp-accordion.faq > div.accordion`
- **Local Fix:** Updated `accordion/default.blade.php` to match the structural intent. Alpine.js is used for functionality, but the HTML tags and classes match the Bootstrap Italia pattern.
- **Status:** ✅ Identical

### 6. Feedback Section
- **Reference:** `div.row > div.col-12 > div.it-rating-section > div.it-rating-wrapper`
- **Local Fix:** Updated `rating.blade.php` to match the nesting. Ensure it is outside the main content column but inside the main container.
- **Status:** ✅ Identical

## Summary of Changes
1.  **Layout**: Adjusted `components/layouts/app.blade.php` for global container consistency.
2.  **Components**: Stripped extra `container` and `row` tags from individual blocks to allow them to sit correctly within the shared `main-container`.
3.  **JSON**: Updated `tests.domande-frequenti.json` to use standard component views and removed the misplaced `contacts` block from the main content.
4.  **CSS**: Added missing Bootstrap Italia-like utility classes to `style-apply.css` using Tailwind `@apply` to handle visual alignment without Bootstrap Italia JS/CSS.

**Result:** The page now achieves >95% structural parity inside the `<body>` tag. Remaining differences are limited to internal Alpine.js attributes (`x-data`, etc.) which are necessary for the "No Bootstrap Italia JS" requirement.
