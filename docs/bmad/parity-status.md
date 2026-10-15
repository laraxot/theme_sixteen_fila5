---
title: "Parity Verification Status — /it/tests/* vs Design Comuni"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "parity verification status   /it/tests/* vs design comuni sixteen"
---
# Parity Verification Status — /it/tests/* vs Design Comuni

## Screenshot comparison (Quantitative data captured)
- Playwright CLI captured LOCAL + REFERENCE screenshots for **all 14 pages**
- Viewport: 1280×800px, Chromium browser
- File locations: `/tmp/screenshots/local/*.png` and `/tmp/screenshots/ref/*.png`

| Page | Different pixels | % Difference |
|---|---|---|
| tests-index | (pending) | (pending) |
| homepage | 494,467 / 1,024,000 | 48.3% |
| segnalazione-dettaglio | 174,397 / 1,024,000 | 17.0% |
| amministrazione | 329,197 / 1,024,000 | 32.1% |
| domande-frequenti | 774,211 / 1,024,000 | 75.6% |
| risultati-ricerca | 515,347 / 1,024,000 | 50.3% |
| argomenti | 266,075 / 1,024,000 | 26.0% |
| catalog | 1,024,000 / 1,024,000 | 100.0% (structure diff) |
| segnalazioni-elenco | 233,241 / 1,024,000 | 22.8% |
| segnalazione-area-personale | 160,220 / 1,024,000 | 15.6% |
| segnalazione-01-privacy | 178,244 / 1,024,000 | 17.4% |
| segnalazione-02-dati | (pending) | (pending) |
| segnalazione-03-riepilogo | (pending) | (pending) |
| segnalazione-04-conferma | (pending) | (pending) |

## Observations
- All pages render at same dimensions (1280×800) ✅
- % differences reflect CSS/design-token gaps (colors, spacing, elevation, shadows)
- `catalog` 100% diff — structure/layout completely different (different routing/schema)
- Lower diff pages: `segnalazione-area-personale` (15.6%), `segnalazione-01-privacy` (17.4%), `segnalazione-dettaglio` (17.0%)

## Stack verified: Tailwind + DaisyUI + Flowbite + Alpine + Lit; NO Bootstrap.

## Next Actions (BMAD):
1. **Prioritize CSS fixes** based on pixel-diff percentages — target domande-frequenti (75.6%), results-ricerca (50.3%), homepage (48.3%)
2. **Apply `homepage-parity.css`** overrides fully (green #007a52, ink #17334f, footer #24323f)
3. **Complete `footer-override.css`** with correct footer column title colors, EU logo, legal links
4. **Fix header icon + language + Accedi button** CSS (from `deep-parity-plan.md`)
5. **Re-capture screenshots** after CSS fixes
6. **Compare anew** until all pages ≤30% pixel difference (indicating close visual parity)
7. **Document final delta** in `docs/bmad/parity-status.md`

Initiative: kp-b4af21c7bb2a4f5d93e0cce9fc18a80c (visual parity tracking)
Second brain: kp-174d15a58ff94901b2b0df0d86b8907a (header/footer design), kp-264c30f45bc1477ca99bfbf8015e9b92 (WCAG improvement)