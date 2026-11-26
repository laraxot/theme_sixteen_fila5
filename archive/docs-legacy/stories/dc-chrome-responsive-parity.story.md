---
title: "Sixteen - Parita' responsive di testata, piede e titoli con Design Comuni"
type: story
bmad: true
status: done
created: 2026-11-12
updated: 2026-11-17
owner: Themes/Sixteen
related:
  - front-office-full-review.story.md
  - ../../../../Modules/Cms/app/View/Components/Head.php
---

# Parita' responsive con Design Comuni

Confronto misurato (Playwright) fra Fixcity e il riferimento `italia/design-comuni-pagine-statiche` (bootstrap-italia 2.9),
a 360, 390, 576, 768, 992, 1200 e 1440 px, da anonimo e da cittadino autenticato.

## Corretto

| Differenza | Prima | Riferimento e ora | Dove |
| --- | --- | --- | --- |
| Altezza testata centrale sotto 992 px | 120 px | 80 px | `resources/css/app/24-dc-chrome-parity.css` |
| Logo della testata | 82 px a ogni larghezza | 48 px sotto 992, 82 px sopra | idem (anche `flex`, che una regola legacy fissava a 82 px) |
| Titolo del brand | 16 px a ogni larghezza | 20 px, 28 px da 992 px | idem; `civic-design-global-fixes.css` forza i 16 px solo su `.it-brand-text` |
| Pulsante di ricerca su telefono | sfondo pieno, icona piccola | 48x48 trasparente, icona 24 px bianca | idem |
| Logo del piede su telefono | 82 px | 48 px (segue la testata: «logo piede = logo testata») | idem |
| Spazio sopra le briciole di pane | 0 | 24 px, 32 px da 768 px (padding: `22-header-shell.css` azzera il margine) | idem |
| Etichetta della regione nella fascia alta | grassetto | peso 400 | idem |
| Titolo e sommario di Categorie | Tailwind, h1 40/48 px, sommario 16/18 px | `cmp-hero` del riferimento, h1 32/42,7 px, sommario 20/24 px | `components/pages/categories.blade.php` |
| Titolo della scheda di Categorie | «Esplora le segnalazioni» (diverso dal titolo della pagina) | uguale all'h1 nelle quattro lingue | `config/local/fixcity/.../lista-categorie.index.json` |

## Controllato senza difetti

- Nessuno scorrimento orizzontale: 14 pagine pubbliche e 8 dell'area personale, a 7 larghezze.
- Menu mobile aperto: tutte le voci dentro lo schermo.
- Bersagli piccoli rimasti: le etichette di categoria delle schede («NOTIZIE», 21 px) e i link «Leggi tutto» hanno la stessa
  misura del riferimento; le stelle di valutazione hanno etichette da 32 px sopra i radio nascosti.

## Manutenzione

- `npm run build` ora termina con `prune:assets` (`resources/scripts/prune-stale-assets.mjs`): `emptyOutDir: false` lasciava in
  `public/assets` ogni bundle di ogni build (72 MB, quasi tutti versionati); restano solo i file citati da `manifest.json` (~8 MB).
- `Cms` `Head`: un file di 0 byte non viene piu' linkato come icona (era il `favicon.ico` vuoto dello scheletro Laravel).
- Tolti i due `ComuneController` del tema: nessuna rotta, viste `pages.comune.*` vietate dalla regola delle pagine e mai
  esistite, un modello inesistente; con loro i test che li provavano.
- Test riallineati al comportamento voluto: titolo «Pagina | Brand» (`ComposeDocumentTitleAction`), valori di `robots`
  (`ResolveRobotsPolicyAction`), icona linkata solo se il file esiste e non e' vuoto; `HeadSeoPolicyTest` lega il TestCase
  per file come vuole `laravel/tests/Pest.php`.

## Icone del sito (2026-11-17)

Confermato dal proprietario: lo scudo rosso del 2026-11-12 sostituito dal marchio (megafono bianco su verde #007a52).
`resources/static/`: `favicon.ico` (16/32/48 px; a 16 e 32 px tratti ingrossati, solo il megafono, perche' la cornice del
logo si impastava), `apple-touch-icon.png` (180), `icon-192.png`, `icon-512.png`, `maskable-512.png` e `site.webmanifest`
(il `Head` del Cms lo collega solo se il file esiste). Anche `public_html/favicon.ico`, chiesto dai browser in automatico.

## Accessibilita' (axe-core 4.10, WCAG 2.2 AA + best practice, 17 pagine a 1366 e 390 px)

Prima: 5 regole violate. Ora: **0**.

| Regola | Dove | Correzione |
| --- | --- | --- |
| heading-order | piede, tutte le pagine | titoli delle colonne `h3` (prima `h4` dopo l'`h2` dell'ente; il riferimento ha lo stesso salto), peso 600 invariato |
| landmark-unique | fascia alta | `aria-label` sulla zona lingua/area personale (`header.slim.tools_aria`, 4 lingue) |
| landmark-complementary-is-top-level | home | il riquadro «Impegno civico» non e' piu' un `<aside>` dentro `<main>`, ma un gruppo con nome |
| color-contrast | ricerca del blog | segnaposto #576a7c (4,8:1, prima 4,38:1) |
| scrollable-region-focusable | cookie policy su telefono | tabella che scorre raggiungibile da tastiera (`tabindex`, `role=region`) |

## Aperto

- Peso del CSS (#102): `app-*.css` servito su ogni pagina e' 3,3 MB (260 KB con gzip); circa 13.500 regole valgono solo fuori
  dalle pagine `data-dc`, cioe' quasi mai nel front office. Toglierle e' un refactoring a se' (misurare pagina per pagina).
- Test Gdpr: 70 test di pagina descrivono un flusso di registrazione che non esiste (POST su /register con 302, testi
  inventati); da riscrivere sul widget Livewire reale. Il bootstrap e' sistemato (uses() per file, helper inclusi dalla radice).
