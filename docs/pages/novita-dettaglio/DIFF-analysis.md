# DIFF Analysis: novita-dettaglio

**Reference URL**: https://italia.github.io/design-comuni-pagine-statiche/sito/novita-dettaglio.html
**Local URL**: http://127.0.0.1:8000/it/tests/novita-dettaglio
**Analysis date**: 2026-04-06
**Agent**: GROUP-B
**Visual parity**: ~20%

## Screenshots
- REF-desktop.png | LOCAL-desktop.png
- REF-mobile.png | LOCAL-mobile.png

---

## Critical Differences (Priority 1)

### 1.1 Missing two-column layout with navscroll sidebar
- **REF**: `<aside class="col-lg-3">` contains `cmp-navscroll sticky-top` / `it-navscroll-wrapper navbar-expand-lg` with a progress bar and page index links ("Descrizione", "A cura di")
- **LOCAL**: No sidebar, no navscroll component
- **Missing classes**: `cmp-navscroll`, `it-navscroll-wrapper`, `it-navscroll-progressbar`, `anchor-offset`

### 1.2 Missing `it-page-sections-container` with article sections
- **REF**: `<section class="col-lg-9 it-page-sections-container border-light">` contains multiple `<article id="..." class="it-page-section anchor-offset">` elements
- **LOCAL**: Only a generic `details` block with subtitle text ("Contenuto dettagliato della pagina...")
- **Missing classes**: `it-page-sections-container`, `it-page-section`, `anchor-offset`

### 1.3 No article metadata (date, category, reading time, image)
- **REF**: Shows category tag, publication date (31 gennaio 2023), reading time ("1 min"), social share buttons, full featured image with caption
- **LOCAL**: None of these elements present; hero block shows only the page title

### 1.4 Missing attribution card ("A cura di")
- **REF**: Card `card-wrapper rounded shadow-sm h-auto` with office name, address, contact links, responsible person name + photo
- **LOCAL**: Absent

### 1.5 Missing feedback/rating section
- **REF**: `cmp-rating pt-lg-80 pb-lg-80` with 5-star rating + `cmp-rating__card-first` / `cmp-rating__card-second` / `cmp-steps-rating` / `cmp-radio-list`
- **LOCAL**: Absent (no rating component at all)

### 1.6 Missing contacts/support section
- **REF**: `cmp-contacts` with FAQ links, assistance request, phone number, appointment booking, report problems
- **LOCAL**: Absent

---

## Structural Differences (Priority 2)

### 2.1 Hero misuse on detail page
- **REF**: No `it-hero-wrapper`; article starts with breadcrumb + category tag + `h1` directly in content
- **LOCAL**: Uses `section.hero-block` from generic content block system

### 2.2 Breadcrumb path incorrect
- **REF**: Home > Novità > Notizie > [article title]
- **LOCAL**: Home / Home / Test / Novita Dettaglio

### 2.3 Last update section missing
- **REF**: `<article id="ultimo-aggiornamento" class="anchor-offset mt-5">` with formatted date
- **LOCAL**: No update date

---

## Minor Differences (Priority 3)

### 3.1 Body text not rendered
- **REF**: Full article body with paragraphs, links
- **LOCAL**: Placeholder text only

### 3.2 Social sharing buttons missing
- **REF**: Share on Twitter/Facebook/WhatsApp buttons in article header
- **LOCAL**: Not present

---

## CSS Classes to Add/Fix

```
cmp-navscroll, it-navscroll-wrapper, it-navscroll-progressbar
it-page-sections-container, it-page-section, anchor-offset
cmp-rating, cmp-rating__card-first, cmp-rating__card-second
cmp-steps-rating, cmp-steps-rating__body, cmp-radio-list
cmp-contacts, card-wrapper (shadow variant)
```

---

## Recommended Actions for Dev Agent

1. Create a `novita-dettaglio` layout template with two-column structure
2. Implement `cmp-navscroll` component with scroll-spy behavior
3. Implement `it-page-section` / `it-page-sections-container` article body
4. Add article metadata block (date, category, reading time, social share)
5. Add attribution card component ("A cura di")
6. Add `cmp-rating` feedback component
7. Add `cmp-contacts` support section
8. Update JSON data to include real article content

## Link
- [Group B index](../GROUP-B-index.md)
- [Design Comuni docs](../../design-comuni/00-index.md)
