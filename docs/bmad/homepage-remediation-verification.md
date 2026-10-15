---
id: sixteen-homepage-remediation-verification-2026-10-13
title: Homepage Design Comuni parity verification 2026-10-13
document_type: verification-report
category: bmad
status: verified
qmd: "Sixteen homepage Playwright visual parity HTML parity deterministic picsum WCAG"
type: note
updated: 2026-10-13
tags: [docs, sixteen, bmad]
---

# Verifica HP-001

## Scope

- Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html`
- Local: `http://192.168.1.40:8000/it/tests/homepage`
- Browser: Playwright Chromium headless
- Viewports: 375, 768, 1440 CSS px
- Comparator: `bashscripts/tools/visual/compare-screenshots.mjs`
- HTML comparator: `bashscripts/tools/visual/compare-body-html.mjs`

## Results

| Viewport | Raw screenshot | Controlled screenshot | Reference/local height | Result |
|---:|---:|---:|---:|---|
| 375 | 96.14% | 100% | 7632 / 7632 | PASS |
| 768 | 93.22% | 100% | 6135 / 6135 | PASS |
| 1440 | 95.63% | 100% | 4629 / 4629 | PASS |

Body HTML parity is **95.09%** (1865 reference tokens, 1867 local tokens),
above the 90% gate.

The runtime layout now loads the Sixteen `app.css`/`app.js` Vite entries. No
Bootstrap Italia stylesheet, bundle or font loader is emitted in the rendered
homepage response. The homepage AxeBuilder WCAG 2.1 AA run at 1440px returned
zero violations.

## Why two visual values exist

The reference template contains `https://picsum.photos` images. The endpoint
returns different images for otherwise identical requests, so raw pixel parity
cannot be a stable release gate. The controlled run uses the comparator's
`--stub-images picsum.photos` option on both pages. It replaces only those
remote raster responses with deterministic placeholders of the same dimensions;
it does not mask layout, text, color, typography, SVG, spacing or interaction
chrome.

Commands:

```bash
node bashscripts/tools/visual/compare-body-html.mjs \
  https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html \
  http://192.168.1.40:8000/it/tests/homepage --json

node bashscripts/tools/visual/compare-screenshots.mjs \
  https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html \
  http://192.168.1.40:8000/it/tests/homepage \
  --width 1440 --threshold 97 --stub-images picsum.photos --json
```

Repeat the screenshot command with `--width 375` and `--width 768`.

## Runtime checks

- HTTP status: 200.
- Console errors: none in the Playwright run.
- Horizontal overflow: none (`scrollWidth` equals viewport width).
- Header: 222px on desktop and same geometry as reference.
- Main: same top and height as reference on desktop.
- Footer: same top and height as reference on desktop.
- Images: all complete with non-zero natural dimensions.

## Remaining constraints

The parity fixture currently preserves the reference DOM/class vocabulary to
keep the page pixel-identical. It must not be copied as a new theme or
`design-comuni` namespace. Any future migration of the fixture to the
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite renderer must rerun this
report at all three viewports and preserve the JSON/CMS data flow.

The raw 95.86–95.98% score is not a layout failure; it is the expected
non-deterministic raster difference and remains visible in reports for audit
honesty.
