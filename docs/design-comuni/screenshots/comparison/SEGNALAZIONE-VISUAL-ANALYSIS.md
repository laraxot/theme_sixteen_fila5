# Segnalazione Pages - Visual Comparison Analysis

**Generated**: 2026-04-07
**Reference Source**: https://italia.github.io/design-comuni-pagine-statiche/sito/
**Local Source**: http://127.0.0.1:8000/it/tests/

---

## Overview

This document provides a detailed visual comparison between the design.comuni.it reference pages and the local Tailwind/Blade implementation for all 8 segnalazione pages. The analysis identifies specific CSS, layout, and component differences that need to be addressed.

**Note**: Several reference screenshots from GitHub Pages return 404 errors. Analysis is based on reference screenshots that successfully loaded and the local screenshots available.

---

## 1. segnalazione-disservizio (Service Landing Page)

### Desktop Comparison

#### Reference (Expected)
- Full service detail page with header, breadcrumb, title "Segnalazione disservizio"
- Horizontal stepper with 3 steps: "Autorizzazioni e condizioni" (active), "Dati di segnalazione", "Riepilogo"
- Green active line under current step
- Privacy text paragraph with GDPR reference
- Green "informativa sulla privacy" link
- Checkbox: "Ho letto e compreso l'informativa sulla privacy"
- Large green "Avanti" button
- Contact card at bottom with shadow

#### Local (Actual)
- Same structure but showing service detail page with sidebar navigation
- "Servizio attivo" chip/pill under title
- Description text under chip
- Two CTA buttons: "Segnala disservizio" (primary) and "Tutte le segnalazioni" (outline)
- Right side: share dropdown with icons (Facebook, Twitter, LinkedIn, WhatsApp)
- Right side: "Vedi azioni" dropdown with "Stampa", "Ascolta", "Invia"
- Left sidebar: "INDICE DELLA PAGINA" navscroll accordion
- Right column sections: "A chi e rivolto", "Descrizione", "Come fare", etc.

#### Key Visual Differences

| Element | Reference | Local | CSS Fix Needed |
|---------|-----------|-------|----------------|
| Stepper | Horizontal Bootstrap steppers | Not present on this page | Page is wrong type - this should be the service landing, not the flow |
| Privacy form | Inline with stepper | Not present | Different page purpose |
| CTA buttons | Single "Avanti" | Two side-by-side | Reference is flow page, local is service detail page |
| Right sidebar | Share/action dropdowns | Not in reference | Extra functionality added |
| Left navscroll | Not on reference | Present | Extra navigation added |

**Root Cause**: The local page is implementing a *service detail* page while the reference is the *first step of the segnalazione flow*. These are two different page types. The local service detail page (`segnalazione-dettaglio.blade.php`) should be the landing page, and `segnalazione-01-privacy.blade.php` should be the first flow step.

#### Color Differences
- Green header bar: both use `#006654` (correct match)
- Primary buttons: local uses Tailwind `bg-green-700`, reference uses Bootstrap `.btn-primary` with `#006654`
- Chip border: reference uses `#006654` border with transparent background
- Share dropdown: local has white cards with blue icons, reference has same pattern

#### Spacing Differences
- Breadcrumb to title: reference has ~24px, local has ~32px
- Title to chip: reference has ~16px, local has ~12px
- Section spacing: reference uses consistent 32px between sections

#### Font Differences
- Title: reference uses `title-xxxlarge` Bootstrap class (~40px), local uses Tailwind `text-4xl` (~36px)
- Body text: reference uses `text-paragraph` (~18px), local uses Tailwind `text-base` (~16px)
- Link weight: reference uses medium (500), local uses normal (400)

### Mobile Comparison

#### Reference
- Hamburger menu (3 lines)
- Search icon (circle)
- Breadcrumb with "/" separators
- Title "Segnalazione disservizio" stacked
- "Servizio attivo" chip
- Description text
- Full-width "Segnala disservizio" button
- Full-width "Tutte le segnalazioni" outline button
- "Condividi" dropdown button
- Share links listed vertically

#### Local
- Similar mobile layout
- Share icons displayed as cards with rounded corners
- "Vedi azioni" dropdown present

#### Key Visual Differences
- Share dropdown on mobile: reference shows simple button, local shows card list
- Button sizing: reference uses consistent full-width on mobile
- Spacing below buttons: reference has 24px, local has 16px

---

## 2. segnalazione-01-privacy (Privacy Step)

### Desktop Comparison

#### Reference (Expected)
- Breadcrumb: Home / Servizi / Segnalazione disservizio
- Title: "Segnalazione disservizio"
- Horizontal stepper: "Autorizzazioni e condizioni" (active, green underline), "Dati di segnalazione" (inactive), "Riepilogo" (inactive)
- Stepper index: "1/3"
- Privacy text: GDPR article 13 reference, "Comune di Firenze" mention
- Green underlined link: "informativa sulla privacy"
- Checkbox: empty square, text "Ho letto e compreso l'informativa sulla privacy"
- Green button: "Avanti"
- Footer contact card: shadow, "Contatta il comune" heading, icons + links

#### Local (Actual)
- Shows placeholder content: "SEGNALAZIONE DISSERVIZIO" label
- Title: "Segnalazione - Step 1 privacy" (WRONG - should be "Segnalazione disservizio")
- No stepper visible
- Placeholder text: "La schermata con l'informativa privacy e il consenso."
- "Scenario di conversione" section
- Blue alert box: "sixteen::alerts.governance.title" (TRANSLATION MISSING)
- "sixteen::common.labels.source.label" with external link icon

#### Key Visual Differences

| Element | Reference | Local | Severity |
|---------|-----------|-------|----------|
| Title | "Segnalazione disservizio" | "Segnalazione - Step 1 privacy" | HIGH - Wrong title |
| Stepper | Visible, 3-step | Missing | HIGH - Core component missing |
| Privacy text | Full GDPR paragraph | Placeholder text | HIGH - Content missing |
| Checkbox | Styled checkbox | Missing | HIGH - Core functionality missing |
| "Avanti" button | Present | Missing | HIGH - CTA missing |
| Translation keys | Italian text | `sixteen::alerts.*` keys | HIGH - Translations not loaded |
| Contact card | Present | Missing | MEDIUM - Footer section missing |

#### CSS Fixes Needed
1. **Title**: Replace hardcoded "Step 1 privacy" with dynamic `{{ $title }}` matching service name
2. **Stepper**: Add Bootstrap Italia `.steppers` component with proper structure
3. **Checkbox**: Use Bootstrap `.form-check` with `.checkbox-body` wrapper
4. **Button**: Use Bootstrap `.btn-primary` instead of Tailwind classes
5. **Translation**: Fix missing translations in `lang/it/sixteen.php`

### Mobile Comparison

#### Reference
- Hamburger + search
- Breadcrumb
- Title
- Stepper: single card showing "Autorizzazioni e condizioni 1/3"
- Privacy text
- Checkbox (full width)
- "Avanti" button (full width, green)

#### Local
- Same header
- Title "Segnalazione - Step 1 privacy"
- Placeholder text
- Blue alert box
- Translation keys visible

#### Key Visual Differences
- Stepper on mobile: reference uses card-style stepper with shadow, local has none
- Button: reference full-width green button, local has no button

---

## 3. segnalazione-02-dati (Data Entry Step)

### Desktop Comparison

#### Reference (Expected)
- Breadcrumb: Home / Servizi / Segnalazione disservizio
- Title: "Segnalazione disservizio"
- Stepper: "Informativa sulla privacy" (confirmed with checkmark), "Dati di segnalazione" (active, green underline), "Riepilogo" (inactive)
- Stepper index: "2/3"
- Left sidebar: "INFORMAZIONI RICHIESTE" accordion with 3 items: "Luogo", "Disservizio", "Autore della segnalazione"
- Right content:
  - "Luogo" card: grey background, "Indica il luogo del disservizio" subtitle, search input, "Usa la tua posizione" link with map pin icon
  - "Disservizio" card: required asterisk, select dropdown, title input, details textarea, image upload button

#### Local (Actual)
- Breadcrumb: Home / Servizi / Segnalazione disservizio
- Title: "Segnalazione disservizio"
- Stepper: VERTICAL stepper on left side - "Informativa sulla privacy" (with check), "Dati di segnalazione", "Riepilogo"
- Progress bar: "2/3"
- Left navscroll accordion: same 3 items
- Right content: Same card structure but with Tailwind styling

#### Key Visual Differences

| Element | Reference | Local | Severity |
|---------|-----------|-------|----------|
| Stepper orientation | Horizontal | Vertical on left | HIGH - Layout difference |
| Stepper style | Bootstrap Italia steppers | Custom vertical list | HIGH - Wrong component |
| Card backgrounds | `has-bkg-grey shadow-sm` | Light grey, less shadow | MEDIUM |
| Input styling | Bootstrap form-control | Tailwind styled | MEDIUM |
| Sidebar accordion | Bootstrap Italia navscroll | Similar but Tailwind | LOW |
| Required asterisk | Red `*` icon | Not visible | LOW |

#### Color Differences
- Stepper active: reference uses `#006654` green underline, local uses green bar
- Card backgrounds: reference uses `#F2F4F6` (grey-card), local uses lighter grey
- Input borders: reference uses `#DEE2E6`, local uses Tailwind `border-gray-300`
- Link color: reference uses `#006654`, local uses similar green

#### Spacing Differences
- Card internal padding: reference uses 24px (p-lg-4), local uses 16px
- Between cards: reference uses 32px (mb-40), local uses 24px
- Input to label spacing: reference has 8px, local has 4px

#### Font Differences
- Card titles: reference uses `title-xxlarge` (~32px), local uses similar
- Subtitles: reference uses `subtitle-small` (~14px), local uses `text-sm` (~14px)
- Input placeholder: reference uses `#6C757D`, local uses similar grey

### Mobile Comparison

#### Reference
- Hamburger + search
- Breadcrumb
- Title
- Stepper card: "Dati di segnalazione 2/3"
- Note: "I campi contraddistinti dal simbolo asterisco sono obbligatori"
- Luogo card
- Form fields

#### Local
- Same header
- Title
- Vertical stepper
- Navscroll accordion
- Same form cards

#### Key Visual Differences
- Stepper: reference uses compact card, local uses vertical list + progress bar
- Navscroll: hidden on mobile in reference, visible in local
- Form spacing: tighter on reference mobile

---

## 4. segnalazione-03-riepilogo (Summary Step)

### Desktop Comparison

#### Reference (Expected)
- Breadcrumb: Home / Servizi / Segnalazione disservizio
- Title: "Segnalazione disservizio"
- Stepper: "Autorizzazioni e condizioni" (checkmark), "Dati di segnalazione" (checkmark), "Riepilogo" (active, green underline)
- Warning callout: orange/brown horn icon, "ATTENZIONE" label, text about declaration value
- "Segnalazione" heading
- Summary cards:
  - "Disservizio" section with white info card
  - "Modifica" link (green)
  - Fields: Indirizzo, Tipo di disservizio, Titolo, Dettagli, Immagini
- "Dati Generali" heading
- User info cards: name, codice fiscale, contatti
- Navigation buttons: "Indietro", "Salva Richiesta", "Invia"
- Terms modal (hidden)
- Contact card footer

#### Local (Actual)
- Shows placeholder content
- Title: "Segnalazione - Step 3 riepilogo" (WRONG)
- No stepper
- Placeholder text about summary
- Blue alert box with translation keys
- "Scenario di conversione" section

#### Key Visual Differences

| Element | Reference | Local | Severity |
|---------|-----------|-------|----------|
| Title | "Segnalazione disservizio" | "Segnalazione - Step 3 riepilogo" | HIGH |
| Stepper | Visible, step 3 active | Missing | HIGH |
| Warning callout | Orange horn icon | Missing | HIGH |
| Summary cards | White info cards with fields | Missing | HIGH |
| Navigation | 3 buttons | Missing | HIGH |
| Modal | Terms confirmation modal | Missing | MEDIUM |
| Translations | Italian text | Missing keys | HIGH |

#### CSS Fixes Needed
1. Warning callout: Bootstrap Italia `.callout.callout-highlight.warning` with `.icon-sm` horn icon
2. Summary cards: `.cmp-info-summary.bg-white` structure
3. Field display: `.single-line-info.border-light` with `.text-paragraph-small` labels
4. Navigation: `.cmp-nav-steps` with `.steppers-nav` structure
5. Modal: Bootstrap modal with `.modal-dialog-centered.small`

### Mobile Comparison

#### Reference
- Compact stepper card showing "Riepilogo 3/3"
- Warning callout (full width)
- Summary cards (stacked)
- Navigation buttons (stacked)

#### Local
- Placeholder content
- No stepper
- Translation keys visible

---

## 5. segnalazione-04-conferma (Confirmation Page)

### Desktop Comparison

#### Reference (Expected)
- Breadcrumb: Home / Servizi / Segnalazione disservizio
- Title with green check icon: "Segnalazione inviata"
- Confirmation text with bold report number "AN4059281"
- Link: "lista di tutte segnalazioni" (green)
- Email text: "giulia.bianchi@gmail.com" in bold
- Download button: outline green with download icon, "Scarica la ricevuta (PDF 100KB)"
- Link: "Consulta la richiesta" (green) "nella tua area riservata"
- Horizontal rule
- "Servizi correlati" section with icon list card
- Rating section: green background, star rating widget
- Contact card footer

#### Local (Actual)
- Shows flow confirmation with 4-step stepper dots
- "Segnalazione inviata" title with checkmark
- Different report ID format: "SEG-2025-005678"
- Download button with outline styling
- Rating section present
- Contact card present

#### Key Visual Differences

| Element | Reference | Local | Severity |
|---------|-----------|-------|----------|
| Check icon | `it-check-circle` (hollow) | Similar checkmark | LOW |
| Report ID format | "AN4059281" | "SEG-2025-005678" | LOW - Content difference |
| Download button | Outline with icon | Similar | LOW |
| "Consulta la richiesta" | Green link | Present | OK |
| Servizi correlati | Icon list card | Present | OK |
| Rating widget | Full star rating | Present | OK |
| Stepper dots | Not in reference | Present in local | MEDIUM - Extra element |

#### Color Differences
- Check icon: reference uses `#006654`, local uses similar
- Links: reference uses `#006654`, local uses similar
- Download button: reference uses green outline `#006654`, local uses similar
- Rating background: reference uses `#006654` green, local uses similar

#### Spacing Differences
- Title to confirmation text: reference has ~8px, local has ~16px
- Email to download button: reference has ~24px, local has ~16px
- Horizontal rule: reference has margin-top 32px, local has similar

#### Font Differences
- Title: both use similar large size
- Report ID: reference uses bold, local uses bold
- Email: reference uses bold, local uses bold

### Mobile Comparison

#### Reference
- Check icon + title
- Confirmation text
- Download button (full width)
- Servizi correlati card
- Rating widget (full width)

#### Local
- Similar structure
- Stepper dots visible at top
- Buttons stacked

#### Key Visual Differences
- Stepper dots: not in reference, present in local
- Button sizing: reference uses consistent sizing

---

## 6. segnalazione-area-personale (Personal Area Dashboard)

### Desktop Comparison

#### Reference (Expected)
- Breadcrumb: Home / Area personale
- User name: "Giulia Rossi" (large)
- CF: "GLARSS72H25H501Y"
- Tabs: Scrivania (active), Messaggi, Attività, Servizi
- Tab icons: building, envelope, document, gear
- Left sidebar: "INDICE DELLA PAGINA" accordion with "Ultimi messaggi", "Ultime attività"
- Right content: "Ultimi messaggi" heading
- Message cards: date, green link title, preview text

#### Local (Actual)
- Breadcrumb: Home / Area personale / Segnalazione
- Title: "Segnalazione - Area personale" (WRONG)
- "Le tue segnalazioni" heading
- Simple cards: "Segnalazione 1" with "Stato: In lavorazione"
- No tabs
- No sidebar
- No message list

#### Key Visual Differences

| Element | Reference | Local | Severity |
|---------|-----------|-------|----------|
| Page type | Dashboard with tabs | Simple list page | HIGH |
| User info | Name + CF | Not present | HIGH |
| Tabs | 4 tabs with icons | Missing | HIGH |
| Sidebar | Navscroll present | Missing | HIGH |
| Message cards | Date + title + preview | Simple status cards | HIGH |
| Breadcrumb | Home / Area personale | Extra "/Segnalazione" | MEDIUM |

#### CSS Fixes Needed
1. Dashboard needs tab component with icons
2. User profile header with name and CF
3. Navscroll sidebar
4. Message card component with proper structure
5. Fix breadcrumb to match reference

### Mobile Comparison

#### Reference
- Hamburger + user avatar
- Name + CF
- Tabs (horizontal scroll)
- Message cards

#### Local
- Simple cards
- No tabs
- No user info

---

## 7. segnalazioni-elenco (Reports List Page)

### Desktop Comparison

#### Reference (Expected)
- Breadcrumb: Home / Elenco segnalazioni
- Title: "Elenco segnalazioni"
- Subtitle: "Negli ultimi 12 mesi sono state risolte 73 segnalazioni."
- Left sidebar: "CATEGORIA" heading, 11 checkbox filters with counts
- Right content: "645 Risultati" + "Rimuovi tutti i filtri" link
- Tabs: "Mappa" (active, green underline), "Elenco"
- Map: placeholder with blue pin, "Fortezza da Basso" label visible
- CTA section: "Fai una segnalazione" with description and button

#### Local (Actual)
- Breadcrumb has extra "/" separators: "Home / / Elenco segnalazioni"
- Title and subtitle match
- Filters present but category sidebar has different styling
- "645 Risultati" with green "Rimuovi tutti i filtri" button
- Tabs present
- Map present
- CTA section present

#### Key Visual Differences

| Element | Reference | Local | Severity |
|---------|-----------|-------|----------|
| Breadcrumb | Clean separators | Extra "/" characters | MEDIUM |
| Filter button | "Rimuovi tutti i filtri" text link | Green button | LOW |
| Map styling | Pin centered, zoomed on Florence | Similar but different center | LOW |
| CTA section | Below map | Present | OK |
| Filter checkbox labels | Wrapped text | Similar | OK |

#### Color Differences
- Filter checkboxes: reference uses default browser checkboxes, local uses same
- Tab active: reference uses `#006654` underline, local uses similar
- Results count: reference uses default text color, local uses same
- Map pin: reference uses blue `#0D6EFD`, local uses similar

#### Spacing Differences
- Title to subtitle: reference has ~8px, local has similar
- Subtitle to filters: reference has ~40px, local has ~32px
- Tab to map: reference has ~24px, local has similar

#### Font Differences
- Filter heading: reference uses `h6` uppercase, local uses similar
- Results count: reference uses regular weight, local uses similar

### Mobile Comparison

#### Reference
- Hamburger + search
- Breadcrumb
- Title + subtitle
- Results count + "Filtra" button (funnel icon)
- Tabs
- Map (full width)

#### Local
- Similar structure
- Filter modal accessible via button

#### Key Visual Differences
- Filter button: reference shows "Filtra" with funnel icon, local shows similar
- Map: reference shows Florence center, local shows similar area

---

## 8. segnalazione-dettaglio (Service Detail Page)

### Desktop Comparison

#### Reference (Expected)
- Breadcrumb: Home / Servizi / Segnalazione disservizio
- Title: "Segnalazione disservizio"
- "Servizio attivo" chip
- Description text
- Two CTA buttons: "Segnala disservizio" (primary), "Tutte le segnalazioni" (outline)
- Share and actions dropdowns (icon + text)
- Left sidebar: "INDICE DELLA PAGINA" navscroll
- Right sections: "A chi e rivolto", "Descrizione", etc.

#### Local (Actual)
- Same structure
- Extra "/" in breadcrumb
- Share dropdown shows as card list
- Actions dropdown present
- Navscroll present
- Sections present

#### Key Visual Differences

| Element | Reference | Local | Severity |
|---------|-----------|-------|----------|
| Breadcrumb | Clean | Extra "/" characters | MEDIUM |
| Share dropdown | Icon + text inline | Card list | LOW |
| Actions dropdown | Icon + text inline | Card list | LOW |
| Spacing | Consistent | Similar | OK |

#### Color Differences
- Match well between reference and local
- Green primary color consistent

#### Spacing Differences
- CTA buttons gap: reference has 24px, local has similar
- Section to section: reference has 40px, local has similar

### Mobile Comparison

#### Reference
- Hamburger + search
- Breadcrumb
- Title + chip
- Description
- Full-width CTAs
- Share + actions as icon buttons

#### Local
- Similar structure
- Share dropdown cards visible

---

## Summary of Critical Issues

### HIGH Priority (Must Fix)

1. **Missing Stepper Component** (Pages 01, 02, 03)
   - Pages 01-03 are showing placeholder content instead of actual flow UI
   - Need Bootstrap Italia `.steppers` component with horizontal layout on desktop
   - Need mobile card-style stepper

2. **Wrong Page Titles** (Pages 01, 03, Area Personale)
   - Titles show "Step 1 privacy", "Step 3 riepilogo" instead of "Segnalazione disservizio"
   - Area personale shows "Segnalazione - Area personale" instead of user name

3. **Missing Translations** (Pages 01, 03)
   - Translation keys like `sixteen::alerts.governance.title` are showing raw
   - Need to populate Italian translations

4. **Missing Form Elements** (Pages 01, 02, 03)
   - Privacy checkbox missing on page 01
   - Form inputs on page 02 need Bootstrap Italia styling
   - Summary cards on page 03 are placeholder

5. **Area Personale Dashboard Missing** (Page 6)
   - Should show user profile, tabs, message list
   - Currently showing simple signal list

### MEDIUM Priority (Should Fix)

6. **Breadcrumb Separator Issues** (Pages 7, 8)
   - Extra "/" characters appearing in breadcrumb
   - Need to fix separator rendering logic

7. **Vertical vs Horizontal Stepper** (Page 02)
   - Reference uses horizontal stepper, local uses vertical
   - Need to align with reference design

8. **Dropdown Styling** (Pages 1, 8)
   - Share/actions dropdowns showing as card lists instead of inline dropdowns
   - Need Bootstrap dropdown styling

### LOW Priority (Nice to Fix)

9. **Font Size Consistency**
   - Minor differences in font sizes between Tailwind and Bootstrap Italia
   - Consider using Bootstrap Italia typography classes

10. **Spacing Consistency**
    - Minor spacing differences in padding and margins
    - Align with Bootstrap Italia spacing scale

11. **Color Fine-Tuning**
    - Ensure all colors match Bootstrap Italia design tokens
    - Check contrast ratios for accessibility

---

## CSS Framework Alignment

### Current State
The local implementation uses a mix of:
- Tailwind CSS utilities
- Bootstrap Italia classes (partially)
- Custom CSS

### Recommended Approach
For visual parity with design.comuni.it reference:
1. **Primary**: Use Bootstrap Italia classes as the foundation
2. **Secondary**: Add custom CSS only for unique requirements
3. **Avoid**: Tailwind utilities that conflict with Bootstrap Italia

### Bootstrap Italia Classes to Use

| Component | Bootstrap Italia Class |
|-----------|----------------------|
| Steppers | `.steppers`, `.steppers-header` |
| Breadcrumbs | `.cmp-breadcrumbs`, `.breadcrumb` |
| Cards | `.cmp-card`, `.has-bkg-grey`, `.shadow-sm` |
| Buttons | `.btn-primary`, `.btn-outline-primary` |
| Forms | `.form-control`, `.form-check`, `.checkbox-body` |
| Callouts | `.callout`, `.callout-highlight`, `.warning` |
| Navscroll | `.cmp-navscroll`, `.it-navscroll-wrapper` |
| Info Summary | `.cmp-info-summary`, `.single-line-info` |
| Rating | `.cmp-rating`, `.cmp-rating__card-first` |
| Modal | `.modal`, `.modal-dialog-centered` |

---

## Cross-References

- [Existing Comparison](../../visual-comparison/SEGNALAZIONI-ELENCO-COMPARISON.md) - Segnalazioni Elenco HTML comparison
- [Fix Plan](../../visual-comparison/fix-plan-segnalazione.md) - Visual Parity Fix Plan
- [Structure Analysis](../../visual-comparison/structure-analysis/segnalazione-disservizio-html-comparison.md) - HTML Structure Comparison
- [Block Components](../../../../resources/views/components/blocks/tests/) - Blade templates
- [Bootstrap Italia CSS](../../../../public/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/css/) - Reference CSS
- [Theme Index](../../00-index.md) - Main documentation index

---

## Appendix: Screenshot Locations

All screenshots are located at:
`/var/www/_bases/base_fixcity_fila5/laravel/Themes/Sixteen/docs/design-comuni/screenshots/[page-name]/`

Each page directory contains:
- `reference-desktop.png` - Design.comuni.it reference (desktop)
- `reference-mobile.png` - Design.comuni.it reference (mobile)
- `reference-tablet.png` - Design.comuni.it reference (tablet)
- `local-desktop.png` - Local implementation (desktop)
- `local-mobile.png` - Local implementation (mobile)
- `local-tablet.png` - Local implementation (tablet)
- `README.md` - Page notes
