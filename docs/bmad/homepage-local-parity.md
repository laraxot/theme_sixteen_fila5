---
title: "Homepage locale: contratto di esperienza"
type: note
status: draft
updated: 2026-10-23
tags: [docs, sixteen, bmad]
qmd: "homepage locale: contratto di esperienza sixteen"
---
# Homepage locale: contratto di esperienza

## Scopo

La homepage deve far capire in pochi secondi che FixCity è un servizio civico
concreto: si segnala un problema, si osservano le segnalazioni pubbliche e si
segue l'esito. La versione pubblica di FixCity è un riferimento visuale e di
conversione; non è una sorgente da ripristinare.

## Contratto CMS

`home.json` espone gli stessi quattro blocchi in ogni lingua:

1. `home.hero`: valore del servizio, due azioni e messaggio di impegno civico;
2. `ticket.map-preview`: evidenza pubblica e accesso alla lista/segnalazione;
3. `how-it-works`: tre passaggi data-driven;
4. `quick-actions`: tracciamento e nuova segnalazione.

Le view restano riutilizzabili: testi, etichette e URL arrivano dal CMS; i
fallback del componente usano traduzioni e route locali, mai `/it` hardcoded.

## Decisioni UX e accessibilità

- hero editoriale scuro per dare priorità al valore civico;
- mappa in una sezione autonoma, così non compete con la prima azione;
- CTA conclusiva verde scuro con azione primaria gialla e secondaria outline;
- bottoni con almeno 44px di altezza e layout verticale sui viewport stretti;
- verifica visuale prevista a 375, 768 e 1440px, con focus tastiera e senza overflow.

La gerarchia è intenzionale: prima comprensione, poi prova concreta, poi
istruzioni, infine conversione.

## Perché la versione pubblica risulta più efficace

Il vantaggio non è un singolo colore: è la sequenza narrativa. La versione
pubblica apre con un servizio civico ampio e rassicurante, mostra subito una
prova concreta con la mappa, usa tre passaggi molto leggibili e chiude con una
CTA forte. La variante “Hai visto un problema?” restringeva il messaggio al
solo caso urgente, riuniva troppo valore nella hero e, quando mancava il
blocco mappa dal JSON locale, lasciava un vuoto percettivo tra hero e istruzioni.

Per questo il contratto locale ora mantiene quattro blocchi, nello stesso
ordine e in tutte le lingue: hero, mappa, come funziona, tracciamento. La
correzione è contenutistica e strutturale nel CMS, non una nuova pagina Blade.

## Revisione misurata (Claude, 2026-10-23 06:18) — asse orizzontale

Segnalazione utente: «risulta attaccato al margine sx e contrasta con tutta la grafica … di designcomuni».
Il difetto **non si vede a 1440 px** (la verifica prevista sopra): compare tra 992 e 1399 px, cioè sui
portatili da 1280. Bordo sinistro del primo testo di ogni sezione, misurato con Playwright:

| sezione | 768 | 1280 | 1440 |
|---|---|---|---|
| header (brand) | 56 | **12** | 72 |
| hero (`fc-home-hero__inner.container`, padding 24) | 48 | **76** | 84 |
| mappa (`.container` Bootstrap Italia) | 36 | 64 | 72 |
| how / track (`--fc-home-container-max: 1320px`) | **56** | **12** | 72 |
| footer (`.container` Bootstrap Italia) | 36 | 64 | 72 |
| modello ufficiale Design Comuni (header) | — | 82 | — |

Causa: `16-homepage-civic-reframe.css` forza `max-width: 1320px` su how/track/hero «come l'header»;
sotto i 1400 px un contenitore da 1320 non si centra e il testo va a 12 px. Anche l'header a 1280 e' fuori
asse (x=12) rispetto a mappa, footer e modello ufficiale. Proposta: **un solo asse**, il `.container` di
Bootstrap Italia (540/720/960/1176/1320) gia' usato da mappa e footer, senza override di `max-width` ne'
padding diversi nelle sezioni della home; poi allineare l'header allo stesso contenitore (tocca tutte le
pagine: verificare a 375/768/1024/1280/1440). Verifica: `scratchpad/sect-edges.mjs` della sessione Claude.

## Performance e verifica

Il convertitore HEIC è caricato dinamicamente solo sulle pagine con upload e
non pesa sul primo caricamento della homepage. Il limite Vite dei chunk riflette
questa scelta: il codec isolato può superare la soglia standard, mentre mappe e
comportamenti secondari restano separati dal bundle iniziale.

## Audit eseguiti

Audit automatico `@axe-core/playwright` con WCAG 2A/2AA a 375, 768 e 1440px:

- 24 regole superate per viewport;
- zero violazioni della homepage dopo la rimozione dei pannelli di sviluppo;
- il controllo `color-contrast` resta non determinabile soltanto sul tile
  Leaflet, perché axe interrompe il calcolo sul `mix-blend-mode` interno alla
  libreria. Il cluster è stato verificato manualmente: testo bianco su fondo
  chiaro e bordo blu, senza informazione affidata al solo colore.

Confronto screenshot viewport locale vs `https://fixcity.eu/it`, con overlay
cookie/debug esclusi e confronto pixel `pixelmatch`:

| viewport | similarità | pixel confrontati |
|---:|---:|---:|
| 375px | 88,52% | 337.500 |
| 768px | 91,35% | 691.200 |
| 1440px | 95,76% | 1.296.000 |

La differenza residua è attesa: il sito locale usa dati, mappa, header e
contenuti CMS propri; la gerarchia visuale e il contratto delle azioni sono
allineati.

## Revisione misurata (Claude, 2026-10-23 06:33) — pagina intera, rete, contrasto

- **Pixel a pagina intera** (`bashscripts/tools/visual/compare-screenshots.mjs`, tessere mappa nascoste su
  entrambi): 1920 87,5% · 1440 87,0% · 1280 85,1% · **768 23,9%** (altezze prod/dev 3053/3780) ·
  **375 39,3%** (4580/3909). La tabella sopra misura solo il primo schermo: sotto la piega tablet e
  telefono divergono. A 768 ci sono **due mappe** (hero e sezione «Mappa della comunita'»), a 375 solo
  quella dell'hero: decidere una sola mappa, uguale a ogni larghezza.
- **Rete** (`/it`, primo caricamento, Playwright): 1357 kB di JS in 14 file. HEIC **non** scaricato (ok). Ma
  `theme-map` (309 kB), `vendor-ui`, `theme-behavior`, `vendor-alpine` sono **import statici** di `app.js`
  (manifest): si scaricano su ogni pagina, anche senza mappa. La frase «mappe … separati dal bundle
  iniziale» non e' vera finche' `theme-map` non diventa un `import()` condizionato alla presenza di una mappa.
  `livewire.js` 595 kB e' la versione non minificata di sviluppo.
- **Contrasto corretto (fonte):** `app/20-dc-components.css` usava `var(--color-primary-500, #007a52)`; nel CSS
  compilato quel token vale `var(--primary-500)`, la tonalita' 500 di Filament (oklch 0.683 0.170 161.8,
  ~#00b877). Ora `var(--bs-primary, #007a52)`: axe da 3 regole serious su `/tickets` e `/blog` a 0.
- **Strumento riparato:** `bashscripts/tools/visual/wcag-aa-check.mjs` importava `injectAxe`/`checkA11y`, che
  `@axe-core/playwright` non esporta: stampava PASS senza misurare. Ora usa `AxeBuilder`, tutte le pagine
  pubbliche, it a 390/768/1280 e en/de/es a 1280; un errore di misura fa fallire il controllo (exit 2).

## Revisione misurata (Claude, 2026-10-23 06:44) — perché fixcity.eu si legge meglio

L'utente preferisce `https://fixcity.eu/it`. Misure a 1280: passi «Come funziona» 32 px/700 con icone 56
(prod 20,8/600, icone 24); titolo della scheda hero 18 px (prod 30); fascia finale su 2 righe con pulsanti
sotto (prod 1 riga, pulsanti accanto). Obiettivi e motivazione: [why-fixcity-eu-homepage-reads-better.md](./knowledge/why-fixcity-eu-homepage-reads-better.md).
Corretto da Claude nello stesso giro: chiavi grezze `fixcity::homepage.map_preview.eyebrow|legend` (4 lingue,
chiavi in convenzione `.label`/`.text` + riserve di `map-preview.blade.php` allineate).
