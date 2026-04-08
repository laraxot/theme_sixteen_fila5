# HTML Body Structure Comparison: `segnalazioni-elenco`

**Date**: 2026-04-08 13:13:24
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html
**Local**: http://127.0.0.1:8000/it/tests/segnalazioni-elenco

## 📊 Parity Score

**Overall Match**: **77.8%** (603/775 elements identical)

## Summary

| Metric | Value |
|--------|-------|
| Total elements (reference) | 775 |
| Total elements (local) | 726 |
| ✅ Identical elements | 603 |
| ⚠️ Different elements | 68 |
| ❌ Missing in local | 104 |
| ➕ Extra in local | 55 |
| Unique IDs (reference) | 49 |
| Unique IDs (local) | 42 |
| Unique classes (reference) | 267 |
| Unique classes (local) | 230 |

## 🆔 ID Comparison

- **Common IDs**: 29
- **Missing in local**: 20
  - ❌ `fifth-star`
  - ❌ `first-star`
  - ❌ `formGroupExampleInputWithHelp`
  - ❌ `formGroupExampleInputWithHelpDescription`
  - ❌ `fourth-star`
  - ❌ `modal-disservizio`
  - ❌ `modal2Title`
  - ❌ `radio-1`
  - ❌ `radio-10`
  - ❌ `radio-2`
  - ❌ `radio-3`
  - ❌ `radio-4`
  - ❌ `radio-5`
  - ❌ `radio-6`
  - ❌ `radio-7`
  - ❌ `radio-8`
  - ❌ `radio-9`
  - ❌ `rating-feedback`
  - ❌ `second-star`
  - ❌ `third-star`
- **Extra in local**: 13
  - ➕ `mobile-enviroment`
  - ➕ `mobile-green`
  - ➕ `mobile-maintenance`
  - ➕ `mobile-public-order`
  - ➕ `mobile-road`
  - ➕ `mobile-rodent-control`
  - ➕ `mobile-security`
  - ➕ `mobile-service`
  - ➕ `mobile-street-furniture`
  - ➕ `mobile-waste`
  - ➕ `mobile-water`
  - ➕ `modal-categories`
  - ➕ `modal-categories-label`

## 🎨 CSS Class Comparison

- **Common classes**: 228
- **Missing in local**: 39
  - (39 classes — see JSON for full list)
- **Extra in local**: 2
  - ➕ `.h4`
  - ➕ `.modal-dialog-scrollable`

## ⚠️ Elements with Differences

1. `<div>` at depth 20
   - classes missing in local: ['border-0']
   - extra classes in local: ['single-line-info']
2. `<div>` at depth 21
   - classes missing in local: ['d-lg-flex', 'gap-2', 'mt-3']
   - extra classes in local: ['text-paragraph-small']
3. `<div>` at depth 22
   - extra classes in local: ['border-0', 'border-light']
   - attrs differ: ref=set(), loc={'class'}
4. `<div>` at depth 22
   - extra classes in local: ['d-lg-flex', 'gap-2', 'mt-3']
   - attrs differ: ref=set(), loc={'class'}
5. `<div>` at depth 20
   - classes missing in local: ['text-paragraph-small']
   - extra classes in local: ['border-light', 'single-line-info']
6. `<div>` at depth 20
   - classes missing in local: ['border-0', 'border-light']
   - extra classes in local: ['text-paragraph-small']
7. `<div>` at depth 21
   - classes missing in local: ['d-lg-flex', 'gap-2', 'mt-3']
   - extra classes in local: ['border-0', 'border-light']
8. `<div>` at depth 22
   - extra classes in local: ['d-lg-flex', 'gap-2', 'mt-3']
   - attrs differ: ref=set(), loc={'class'}
9. `<div>` at depth 8
   - classes missing in local: ['text-wrapper']
   - extra classes in local: ['card-footer', 'd-none', 'p-0']
10. `<div>` at depth 8
   - classes missing in local: ['button-wrapper']
   - extra classes in local: ['col-12', 'text-center']
11. `<button>` at depth 9
   - classes missing in local: ['btn-primary', 'mb-4', 'mb-lg-0', 'mt-2']
   - extra classes in local: ['btn-outline-primary', 'mt-10', 'mx-auto']
   - attrs differ: ref={'data-bs-toggle', 'type', 'class', 'data-bs-target'}, loc={'type', 'class'}
12. `<div>` at depth 2
   - classes missing in local: ['container']
   - extra classes in local: ['bg-primary']
13. `<div>` at depth 3
   - classes missing in local: ['bg-primary', 'd-flex', 'justify-content-center', 'row']
   - extra classes in local: ['container']
14. `<div>` at depth 4
   - classes missing in local: ['col-12', 'col-lg-6', 'p-lg-0', 'px-3']
   - extra classes in local: ['bg-primary', 'd-flex', 'justify-content-center', 'row']
15. `<div>` at depth 5
   - id: 'rating' vs 'None'
   - classes missing in local: ['cmp-rating', 'pb-lg-80', 'pt-lg-80']
   - extra classes in local: ['col-12', 'col-lg-6', 'p-lg-0', 'px-3']
   - attrs differ: ref={'class', 'id'}, loc={'class'}
16. `<div>` at depth 6
   - id: 'None' vs 'rating'
   - classes missing in local: ['card', 'card-wrapper', 'shadow']
   - extra classes in local: ['cmp-rating', 'pb-lg-80', 'pt-lg-80']
   - attrs differ: ref={'class', 'data-element'}, loc={'class', 'id'}
17. `<div>` at depth 7
   - classes missing in local: ['cmp-rating__card-first']
   - extra classes in local: ['card', 'card-wrapper', 'shadow']
18. `<label>` at depth 10
   - classes missing in local: ['active']
   - attrs differ: ref={'for', 'class', 'data-element'}, loc={'for', 'class'}
19. `<label>` at depth 10
   - classes missing in local: ['active']
   - attrs differ: ref={'for', 'class', 'data-element'}, loc={'for', 'class'}
20. `<label>` at depth 10
   - classes missing in local: ['active']
   - attrs differ: ref={'for', 'class', 'data-element'}, loc={'for', 'class'}
21. `<label>` at depth 10
   - classes missing in local: ['active']
   - attrs differ: ref={'for', 'class', 'data-element'}, loc={'for', 'class'}
22. `<label>` at depth 10
   - classes missing in local: ['active']
   - attrs differ: ref={'for', 'class', 'data-element'}, loc={'for', 'class'}
23. `<div>` at depth 7
   - classes missing in local: ['cmp-rating__card-second', 'd-none']
   - extra classes in local: ['bg-grey-card', 'shadow-contacts']
   - attrs differ: ref={'class', 'data-step'}, loc={'class'}
24. `<div>` at depth 8
   - classes missing in local: ['border-0', 'card-header', 'mb-0']
   - extra classes in local: ['container']
25. `<div>` at depth 7
   - classes missing in local: ['d-none', 'form-rating']
   - extra classes in local: ['d-flex', 'justify-content-center', 'p-contacts', 'row']
26. `<div>` at depth 8
   - classes missing in local: ['d-none']
   - extra classes in local: ['col-12', 'col-lg-5']
   - attrs differ: ref={'class', 'data-step'}, loc={'class'}
27. `<div>` at depth 9
   - classes missing in local: ['cmp-steps-rating']
   - extra classes in local: ['cmp-contacts']
28. `<span>` at depth 13
   - classes missing in local: ['d-block', 'text-wrap']
   - attrs differ: ref={'class', 'data-element'}, loc=set()
29. `<span>` at depth 13
   - classes missing in local: ['step']
   - attrs differ: ref={'class'}, loc=set()
30. `<div>` at depth 11
   - classes missing in local: ['cmp-steps-rating__body']
   - extra classes in local: ['it-example-modal']

... and 38 more (see JSON)

## ❌ Elements Missing in Local

1. `<div> class="border-light single-line-info"`
2. `<div> class="text-paragraph-small"`
3. `<img> class="img-fluid mb-3 mb-lg-0 w-100"`
4. `<img> class="img-fluid mb-3 mb-lg-0 w-100"`
5. `<div> class="border-light single-line-info"`
6. `<img> class="img-fluid mb-3 mb-lg-0 w-100"`
7. `<div> class="card-footer d-none p-0"`
8. `<div> class="col-12 text-center"`
9. `<button> class="btn btn btn-outline-primary mobile-full mt-10 mx-auto py-3"`
10. `<span>`
11. `<div> class="col-lg-6 mb-4 mb-lg-0 mt-50"`
12. `<div> class="cmp-text-button mt-0"`
13. `<h2> class="mb-0 title-xxlarge"`
14. `<p> class="mb-3 mt-3 subtitle-small"`
15. `<div> class="bg-primary"`
16. `<path>`
17. `<span> id="first-star" class="visually-hidden"`
18. `<path>`
19. `<span> id="second-star" class="visually-hidden"`
20. `<path>`
21. `<span> id="third-star" class="visually-hidden"`
22. `<path>`
23. `<span> id="fourth-star" class="visually-hidden"`
24. `<path>`
25. `<span> id="fifth-star" class="visually-hidden"`
26. `<h2> id="rating-feedback" class="mb-0 title-medium-2-bold"`
27. `<fieldset> class="d-none fieldset-rating-one"`
28. `<legend> class="iscrizioni-header w-100"`
29. `<h3> class="align-items-lg-center d-flex drop-shadow flex-column flex-lg-row justify-content-between step-title"`
30. `<input> id="radio-1"`

... and 74 more

## ➕ Extra Elements in Local

1. `<div> class="card w-100"`
2. `<div> class="card-body"`
3. `<h2> class="title-medium-2-semi-bold"`
4. `<ul> class="contact-list p-0"`
5. `<li>`
6. `<a> class="list-item"`
7. `<svg> class="icon icon-primary icon-sm"`
8. `<use>`
9. `<span>`
10. `<li>`
11. `<a> class="list-item"`
12. `<svg> class="icon icon-primary icon-sm"`
13. `<use>`
14. `<span>`
15. `<li>`
16. `<a> class="list-item"`
17. `<svg> class="icon icon-primary icon-sm"`
18. `<use>`
19. `<span>`
20. `<li>`
21. `<a> class="list-item"`
22. `<svg> class="icon icon-primary icon-sm"`
23. `<use>`
24. `<h2> class="mb-3 title-medium-2-semi-bold"`
25. `<ul> class="contact-list p-0"`
26. `<li>`
27. `<a> class="list-item"`
28. `<svg> class="icon icon-primary icon-sm"`
29. `<use>`
30. `<h2> id="modal-categories-label" class="h4 modal-title"`

... and 25 more

## 📋 Tag Distribution

| Tag | Reference | Local | Diff |
|-----|-----------|-------|------|
| `<a>` | 89 | 90 | +1 |
| `<br>` | 9 | 9 | 0 |
| `<button>` | 20 | 16 | -4 |
| `<div>` | 261 | 241 | -20 |
| `<fieldset>` | 5 | 3 | -2 |
| `<footer>` | 1 | 1 | 0 |
| `<form>` | 1 | 1 | 0 |
| `<h1>` | 1 | 1 | 0 |
| `<h2>` | 8 | 7 | -1 |
| `<h3>` | 11 | 3 | -8 |
| `<h4>` | 6 | 6 | 0 |
| `<header>` | 1 | 1 | 0 |
| `<hr>` | 1 | 1 | 0 |
| `<image>` | 1 | 1 | 0 |
| `<img>` | 13 | 9 | -4 |
| `<input>` | 28 | 28 | 0 |
| `<label>` | 28 | 28 | 0 |
| `<legend>` | 5 | 2 | -3 |
| `<li>` | 88 | 100 | +12 |
| `<main>` | 1 | 1 | 0 |
| `<nav>` | 3 | 3 | 0 |
| `<ol>` | 1 | 1 | 0 |
| `<p>` | 17 | 12 | -5 |
| `<path>` | 10 | 5 | -5 |
| `<small>` | 1 | 0 | -1 |
| `<span>` | 66 | 55 | -11 |
| `<svg>` | 44 | 44 | 0 |
| `<ul>` | 17 | 19 | +2 |
| `<use>` | 38 | 38 | 0 |

---
*Generated by bashscripts/html/compare-html-body.py*