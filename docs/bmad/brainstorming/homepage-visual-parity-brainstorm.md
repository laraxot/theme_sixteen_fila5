---
id: homepage-visual-parity-brainstorm
title: Homepage Visual Parity Brainstorming Log
type: brainstorming
status: draft
links:
  github_issue: #999
  discussion: #999
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "homepage visual parity   brainstorming log sixteen"
---
# Homepage Visual Parity — Brainstorming Log

## Overview
Brainstorming document capturing the analysis, hypotheses, and decision rationale for bringing the Sixteen homepage visual parity from ~40% to 97%.

## Discovery Findings (from m00484)

### Current State: ~40% visual parity
The homepage is returning HTTP 200 but visually diverges significantly from the Design Comuni reference. The main pain points are in the header and hero sections.

### Detailed discrepancy list

#### 1. Header "Seguici su" social icons — SVG missing, letters, wrong color
- **Symptom**: The social links show raw text/letters (e.g., "f", "in", "x") instead of rendered SVG icons, and the color is not white.
- **Root cause hypothesis**: The icon SVG markup was replaced with a text label, or an icon font is being used without the font loaded. Alternatively the `<svg>` element is broken/conditional and fails to render.
- **Fix direction**: Inline the Design Comuni SVG icons directly in the Blade template, styled `text-white` with `hover:text-[#80c8ad]`. No icon font dependency.
- **Why it matters**: Icons as text are a severe accessibility failure (no `aria-label` on icon-only links) and a visual parity break.

#### 2. Search box: magnifying glass not attached, "Cerca" text missing
- **Symptom**: Search input renders without the search icon attached to the right side and without the "Cerca" label.
- **Root cause hypothesis**: The search block component is missing its label and the icon button wrapper. The reference uses a floating label + icon inside the input container.
- **Fix direction**: Wrap input in relative container; add `<svg>` icon positioned absolute right-center (`-translate-y-1/2`); add a `Cerca` text or floating label.
- **Why it matters**: Without icon/label, semantic purpose is lost; visually the reference always has the icon inline.

#### 3. Hamburger menu doesn't appear
- **Symptom**: On mobile, no hamburger button appears to open the navigation.
- **Root cause hypothesis**: Alpine.js data binding for the mobile menu is missing, or the `hidden` utility logic isn't correct for the breakpoint, or the Alpine component wasn't initialized.
- **Fix direction**: Add `x-data="{ open: false }"` to the header and a button on mobile with `@click="open = !open"` and `x-show="open"` with `x-transition` on the mobile nav.
- **Why it matters**: The menu is the primary navigation mechanism on mobile; missing it breaks both UX and parity.

#### 4. All links underlined ("fa abbastanza schifo")
- **Symptom**: Every link (not only on hover) shows an underline, making the page look bad.
- **Root cause hypothesis**: A global Tailwind plugin or custom CSS adds `underline` to all `a` elements (e.g., a plugin that overrides `text-decoration`). Or a CSS file with `a { text-decoration: underline; }`.
- **Fix direction**: Remove the global underline; add `group-hover:underline` only on links where underlining is desired, plus `focus-visible:underline` for accessibility. Default `no-underline` on all `<a>`.
- **Why it matters**: Underlines everywhere create visual noise; the reference style has no underlines except interactive affordances.

#### 5. Missing "Notizie 18 mag 2022" in news section
- **Symptom**: A news item dated "18 mag 2022" doesn't render.
- **Root cause hypothesis**: The JSON for this news item is missing, or the field name doesn't match the Blade template (e.g., `date` vs `data` vs `data_pubblicazione`), or the date formatter fails on this entry.
- **Fix direction**: Inspect `tests.homepage.json`; ensure the news block contains a date field; if missing from JSON, add it to the JSON (never hardcode).
- **Why it matters**: Missing content = visual parity break; also indicates JSON schema drift.

#### 6. Event title wrong font and color
- **Symptom**: The title "Parte l'estate con oltre 300 eventi..." uses the wrong typeface and wrong color (e.g., gray instead of the dark blue).
- **Root cause hypothesis**: The component uses default Tailwind typography (`text-gray-700`) instead of the Design Comuni heading style (`text-[#17324d]`, possibly bold/large). Or a class is missing (`font-bold`, `text-xl`).
- **Fix direction**: Add correct classes: `text-[#17324d] font-bold text-xl` (or the exact reference size), and ensure the font family is Titillium Web for headings.
- **Why it matters**: Heading appearance is central to the reference look; wrong color/font drops parity.

#### 7. Missing "Estate in città" badge
- **Symptom**: The events section has no badge/tag marking the event series "Estate in città".
- **Root cause hypothesis**: The JSON lacks a `badge` or `tag` field, or the Blade component doesn't render the badge even when the field exists.
- **Fix direction**: Add the badge field to the JSON (or mark the correct event) and render a badge component styled like the reference (e.g., `bg-[#007a52] text-white text-xs px-2 py-1 rounded`).
- **Why it matters**: Badge is a recognizable Design Comuni pattern; missing it looks incomplete.

#### 8. Government organs boxes: missing image + "vai alla pagina" button
- **Symptom**: The "Organi di governo" section boxes have no image and no "Vai alla pagina" link.
- **Root cause hypothesis**: The organs block JSON lacks image URLs and CTA text, or the component expects a different field key, or the image is in the public path but the `<img>` alt/src is wrong.
- **Fix direction**: Add `image` (url) and `cta` fields to the organs JSON; render `<img src="...">` with proper sizing and a `Link`/`<a>` styled "Vai alla pagina".
- **Why it matters**: The organs section is a key reference block; cards without image+button don't match.

#### 9. Event calendar wrong
- **Symptom**: The calendar/events grid shows incorrect structure/layout.
- **Root cause hypothesis**: The calendar component either doesn't exist (generic grid used) or uses the wrong grid template (columns/rows) and wrong date formatting.
- **Fix direction**: Verify `calendar.blade.php` exists and renders the Design Comuni calendar layout: date cells in a grid, header with month, "Aggiungi" CTA; check reference HTML class names.
- **Why it matters**: Calendar is a complex layout block; grid mismatch is an obvious parity gap.

#### 10. "Argomenti in evidenza": wrong geometric background + wrong margins/padding
- **Symptom**: The background pattern of this section is wrong (or missing the reference geometric pattern), and the cards have incorrect internal spacing.
- **Root cause hypothesis**: The section has a plain `bg-[#f5f7f9]` instead of the reference geometric background; or the card padding is `p-4` instead of the reference `p-6`, and margin between cards is wrong.
- **Fix direction**: If the reference uses a background SVG/pattern, render it via CSS `background-image` in the theme's custom CSS; set card padding to the reference value (inspect with browser DevTools).
- **Why it matters**: The geometric background is the signature element of this section; wrong spacing ruins the grid.

#### 11. "Siti tematici": missing background colors + images
- **Symptom**: The thematic sites block has plain white boxes without the reference background colors and without the card images.
- **Root cause hypothesis**: The block JSON lacks the colored background field and image paths; or the component renders cards without `bg-[...color]` per item.
- **Fix direction**: Add per-item `background_color` and `image` to the JSON; render cards with those values. Each site may have a distinct background (e.g., `bg-[#e6f3ee]` variant).
- **Why it matters**: Colored cards + images are the visual identity of this block.

#### 12. Search: missing magnifying glass + submit button in keyword search
- **Symptom**: In the site-wide "Cerca una parola chiave" the search button and icon are absent.
- **Root cause hypothesis**: A different search input (plain text) is used for keyword search, lacking the submit button/icon wrapper.
- **Fix direction**: Add the icon + submit button to the keyword search input (same pattern as the search box fix #2).
- **Why it matters**: Consistency with the reference search UI.

#### 13. Rating: wrong behavior
- **Symptom**: The rating widget behaves incorrectly (e.g., always selected, wrong hover feedback, wrong value submission).
- **Root cause hypothesis**: The rating component exists but the Alpine state logic is wrong (e.g., `selected = null` instead of `selected = star`, or `@click` missing).
- **Fix direction**: Review the rating component; implement star selection with `x-data="{ rating: 0 }"` and star hover with `@mouseenter`/`@mouseleave`.
- **Why it matters**: Interactive behavior must match reference (clickable, h-over feedback).

#### 14. "Contatta il comune": wrong spacing
- **Symptom**: The contact section has incorrect margins/padding (elements too close/too far, misaligned).
- **Root cause hypothesis**: The contact component uses wrong spacing classes (`gap-2` instead of `gap-6`, missing `py-4` section wrapper).
- **Fix direction**: Inspect reference CSS for the contact block spacing and replicate exactly (e.g., `space-y-4` + `px-4`).
- **Why it matters**: Spacing determines the page's visual rhythm; the reference is tight and consistent.

## Hypothesis Consolidation
The discrepancies fall into four categories:
1. **Data (JSON) gaps**: missing fields (date, image, badge, color, CTA) — 6 cases (#5, #7, #8, #10, #11, #12)
2. **Component gaps**: missing/wrong components (hamburger, search icon, calendar, rating) — 4 cases (#3, #4, #9, #13)
3. **Style/token gaps**: wrong colors/typography/spacing (fonts, colors, padding) — 4 cases (#1, #6, #10, #14)
4. **Interaction gaps**: hover/focus/keyboard states missing — 1 case (#13, #4)

## Next Steps (per BMAD flow)
1. Confirm each root cause by inspecting reference HTML (DevTools computed styles).
2. Update JSON data files with missing fields (never hardcode in Blade).
3. Fix components one by one; write a BMAD story per group of fixes.
4. Automate verification: Playwright screenshots + DOM diff + contrast audit.
5. Log every fix in the decision log + second brain (knowledge.md).
6. Re-measure parity after each batch; iterate until ≥97%.

## Key Learnings (do not repeat)
- **Don't assume** JSON structure matches component expectations — verify field names.
- **Don't use global CSS** for link decoration — use per-link hover/focus states.
- **Don't rely on** icon fonts — inline SVG everywhere.
- **Don't skip** the hamburger menu in the initial component build — it's required for parity.
- **Don't use** default Tailwind colors — extend the config with Design Comuni tokens first.
- **Always** verify at 3 breakpoints before declaring a story done.