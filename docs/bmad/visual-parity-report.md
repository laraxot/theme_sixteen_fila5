---
title: "Visual parity report — Design Comuni front-office (2026-10-11)"
type: report
status: in-progress
epic: "sixteen-redesign"
created: "2026-10-11"
updated: "2026-10-11T20:10:00Z"
links:
  github_issue: "https://github.com/fixcity/fila5/issues/60"
  github_discussion: "https://github.com/fixcity/fila5/discussions/60"
tags: [docs, sixteen, bmad]
qmd: "visual parity   design comuni vs sixteen fo sixteen"
---

# Visual parity — Design Comuni vs Sixteen FO

## Latest automated gate

The verifier discovered and checked 37 reference pages at 375, 768 and 1440
pixels. The latest `/tmp/fixcity-parity/automated/report.json` run reports
HTTP 200, zero browser errors, zero missing images and zero horizontal overflow
for all 37 local routes. At 1440 pixels, 20/37 pages currently reach the 95%
pixel-similarity target. The remaining pages are still in progress; the HTML
90% structural gate is not yet measured by the verifier.

## Method
- Playwright 1.63.0 (`npx playwright`) — headless Chromium — 1280×900 viewport
- Screenshots: 30 (v1 + v2 locali + riferimento) in `/tmp/playwright-screenshots/`
- Reference source: `https://italia.github.io/design-comuni-pagine-statiche/` (index + sito/)
- Local source: `http://192.168.1.40:8000/it/tests/*`
- Gate: `ux_audit` (APCA contrast Lc ≥75 body / ≥45 large-bold / ≥30 non-text) + `verify-llm-wiki.sh`

## Pages verified (all HTTP 200)
| Page | JSON | Layout | Block view | Status |
|---|---|---|---|---|
| `/it/tests/` | `tests.index.json` | `test` | `pub_theme::components.blocks.*` | OK |
| `/it/tests/homepage` | `tests.homepage.json` / `homepage.json` | `test` | `pub_theme::components.blocks.homepage` | OK |
| `/it/tests/segnalazione-dettaglio` | `tests.segnalazione-dettaglio.json` | `test` | `pub_theme::components.blocks.service.detail` | OK |
| `/it/tests/domande-frequenti` | `tests.domande-frequenti.json` | `test` | `pub_theme::components.blocks.faq.default` (created) | OK |
| `/it/tests/risultati-ricerca` | `tests.risultati-ricerca.json` | `test` | `pub_theme::components.blocks.search-results.default` (created) | OK |
| `/it/tests/servizi` | `tests.servizi.json` (if present) | `test` | existing `segnalazioni-elenco/default.blade.php` | OK |
| `/it/tests/argomenti` | `tests.argomenti.json` | `test` | existing block | OK |
| `/it/tests/segnalazioni-elenco` | `tests.segnalazioni-elenco.json` | `test` | `pub_theme::components.blocks.segnalazioni-elenco.default` | OK |
| `/it/tests/segnalazione-area-personale` | `tests.segnalazione-area-personale.json` | `test` | `pub_theme::components.blocks.segnalazione-area-personale.default` | OK |
| `/it/tests/amministrazione` | `tests.amministrazione.json` | `test` | existing | OK |

## Block inventory (what is inside, how data passes)
- **Header** (`header.json`): `pub_theme::components.sections.header.v1`. Data: `brand.name/tagline/logo`, `region.name/url`, `navigation[]`, `utility_links[]`, `account{label,url}`. Renders: top green bar (`bg-[#006b4f]`), logo+text row, primary nav (`nav-primary.blade.php` partials).
- **Footer** (`footer.json`): `pub_theme::components.sections.footer.v1`. Data: `brand{name,description,logo}`, `columns[]{title,links[]}`, `contact`, `legal_links[]`, `social[]`, `copyright`. Renders: dark slate (`bg-slate-950`) 4-col grid + contact + legal row.
- **Homepage** (`tests.homepage.json`): `pub_theme::components.blocks.homepage`. Sections: hero (image + heading + actions), government (cards), events (date list + cards), topics (icon cards), links (list), feedback, contacts.
- **Segnalazione-dettaglio** (`tests.segnalazione-dettaglio.json`): `pub_theme::components.blocks.service.detail`. Sections: breadcrumb, title/status, summary, sections (who-needs, description, how-to, needed, obtain, costs, service-access, conditions), contacts, topics, updated_at, rating, related.
- **FAQ / Domande frequenti** (`tests.domande-frequenti.json`): `pub_theme::components.blocks.faq.default` (created). Accordion (`x-data` Alpine) with questions/answers, `icon` support.
- **Search results / Risultati ricerca** (`tests.risultati-ricerca.json`): `pub_theme::components.blocks.search-results.default` (created). Title + count + result cards with category.
- **Segnalazioni elenco** (`tests.segnalazioni-elenco.json`): existing `default.blade.php`. Grid with sidebar categories (filter), results list (card with title, tipology, date, status), breadcrumb.
- **Area personale** (`tests.segnalazione-area-personale.json`): existing `default.blade.php`. Breadcrumb, user header (name + fiscal code), tab nav (desk/messages/activities/services), messages list, activities list, contact box.

## Design tokens verified (from `design-system/` + theme CSS)
- Primary: `#007A52` (Design Comuni green) — used for links, active nav, buttons.
- Secondary/text dark: `#17324d` (navy) — headings, primary text.
- Secondary/text mid: `#5d7083` — meta, subtitles, breadcrumbs.
- Background paper: near `#F3F1EA` / `#F6F4EE` (warm tint, per DESIGN.md).
- Accent on dark footer: white, slate-300.
- Typography: Atkinson Hyperlegible (display) + Source Sans / Inter (body) — verified in `design-system/MASTER.md`.
- Elevation: named only (`sm/md/lg/xl`), no ad-hoc shadows — verified in CSS (`shadow-sm`, `shadow-xl` mapped to elevation recipes).
- Radius: token-based (`rounded-lg`, `rounded-xl`, `rounded-2xl`) — no magic values.
- States: `:hover`, `:focus-visible` with ring (`focus-visible:ring-2 focus-visible:ring-[#007a52]/30`) — present.
- Motion: `prefers-reduced-motion` not explicitly declared in all animations but `x-collapse/x-show` Alpine handles gracefully.

## Contrast / accessibility (Mauve gate — sidecar)
- `#007a52` on white: APCA Lc ≈ 75+ (passes body ≥75).
- `#17324d` on white: Lc ≈ 85+.
- `#334e68` on `#F5F7F9`: Lc ≈ 55 (passes large >=45).
- `#5d7083` on white: Lc ≈ 45 (passes UI/non-text >=30).
- All text pairs expected to pass; no hardcoded off-system hex outside `:root`.

## Slop audit (automated gates)
- No glassmorphism, no gradient orbs, no neon glow.
- No `default-card` shadcn reflex (cards separated by whitespace / bg shift / elevation, not uniform `rounded-2xl shadow-lg p-6`).
- No 1px gray border on cards (used `border-slate-200` only where needed).
- No tracked-out ALL-CAPS eyebrow above every heading (only structural, real info).
- No `Inter` default when subject (municipal / design-comuni) demands voice (direction uses Atkinson + Source Sans).

## What is NOT yet fully verified (requires live Playwright inspection of screenshots)
- Exact pixel parity of hero image placement (local uses same image path `themes/Sixteen/design-comuni/assets/images/evidenza-header.png` as reference).
- Exact font-size match on display headings (local uses `text-3xl`/`text-4xl` vs reference visual scale — should be within 5%).
- Sidebar width / grid ratios (`max-w-6xl` local vs `1320px` reference — close).
- Mobile breakpoint behavior (`lg:` / `sm:` responsive rules match Design Comuni responsive spec).
- Interactive states (hover on nav links, accordion open/close animation timing).

## Action data flow (JSON → Blade → Component → HTML)
1. CMS / JSON (`tests.homepage.json`) defines `content_blocks` with `type` + `data.view` + props.
2. `PageSlugMiddleware` resolves slug → `Page` model → `HasBlocks` reads blocks.
3. `Page.php` component passes `data` to block view (`pub_theme::components.blocks.homepage`).
4. Block Blade renders HTML using Tailwind `@apply` and Alpine `x-data`.
5. `<x-layouts.test>` injects header (`<x-section slug="header"/>`) + main + footer (`<x-section slug="footer" tpl="full"/>`).
6. `header.json` / `footer.json` provide CMS-driven content; if missing, `tailwind.blade.php` / `v1.blade.php` fall back to config/default.

## Conclusion

The complete catalogue and one-story-per-page BMAD backlog are in place, but
implementation is not complete: 17 pages remain below the 95% visual gate.
Sixteen remains the single Design Comuni theme owner and no Bootstrap Italia
runtime or CDN is used.

## Verification update 2026-10-12

The focused Playwright desktop run at 1440px covered the nine core URLs and found HTTP 200 with zero local console errors, but the 98% gate is not yet met:

| Page | Similarity |
|---|---:|
| index | 94.68% |
| homepage | 73.67% |
| segnalazione-dettaglio | 92.82% |
| segnalazioni-elenco | 89.01% |
| segnalazione-area-personale | 95.19% |
| segnalazione-01-privacy | 92.35% |
| segnalazione-02-dati | 94.92% |
| segnalazione-03-riepilogo | 94.57% |
| segnalazione-04-conferma | 94.18% |

The run exposed a real fixture-routing defect: `tests.eventi.json` referenced missing block views. The preview route now uses the dynamic catalog composition for `eventi`, `novita` and `servizi`; catalog data includes reference images/cards, and article rendering consumes dynamic sections/topics/images. This is an incremental parity improvement, not a completion claim. The remaining work is to align the nine page-specific block compositions and responsive geometry until 98% is measured at all three viewports.
