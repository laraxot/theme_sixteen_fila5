---
id: dcp-51
title: "Home reale /it/: miglioramenti misurati (accessibilita', SEO, immagini, peso)"
type: story
epic: dc-parity-v2
status: in-progress
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-13
updated: 2026-10-13
tags: [home, accessibility, seo, performance, images]
related: [Themes/Sixteen/docs/bmad/stories/dcp-50-guardia-compilazione-template-blade.story.md]
qmd: "dcp-51 home reale it miglioramenti accessibilita contrasto eyebrow btn-icon title canonical immagini lazy width height peso css"
---

# DCP-51: miglioramenti della home reale `/it/`

## Richiesta (2026-10-13)
L'utente: «migliora http://192.168.1.40:8000/it/». Richiesta aperta: si parte da misure oggettive e si corregge solo cio' che risulta sbagliato, nel contratto del tema (stile in `app.css`, Alpine in `app.js`, mai Bootstrap Italia, niente `!important`). Nota: `/it/` e' la home del PRODOTTO (Folio `Themes/Sixteen/resources/views/pages/index.blade.php`, Volt `home`, nessun `data-slug`), diversa dalla replica Design Comuni `/it/tests/homepage` (parity gia' al ~99,8%, vedi `dc-parity-v2-state`).

## Base misurata (Playwright + axe-core, ospite, 2026-10-13 ~16:30 UTC, dev server; sonda: scratchpad `home/probe.mjs`)
| | desktop 1440 | mobile 375 |
|---|---|---|
| peso trasferito | 5615 KB (css 3248, js 1292+185, png 558, svg 118) | 5256 KB (png 200) |
| LCP / CLS | 2228 ms / 0,003 | 1076 ms / 0,047 |
| axe (WCAG 2.1 A/AA) | serious `color-contrast` x2 su `.fc-track-section__copy > .fc-eyebrow` | idem + serious `link-name` x1 su `.btn-icon` |
| immagini | 16 `<img>`: 15 sono tile Leaflet 256x256 create dal JS dentro `.fc-map-section` (non template, `src` ancora vuoto al momento della sonda) + 1 reale: logo UE nel footer (SVG 178x56 mostrato 254x80, senza width/height, `loading=auto`, a y=2093). 0 senza alt, 0 rotte. **Correzione 16:35 UTC**: la prima lettura "16 immagini senza dimensioni" era un artefatto di misura, non un difetto del template | 7 `<img>`: stesse tile + logo |
| SEO | `<title>` = "FixCity", meta description presente, nessun canonical, 1 solo h1 | idem |
| overflow orizzontale / id duplicati | 0 / nessuno | 0 / nessuno |
| console | solo `phpdebugbar-*` ("Refused to get unsafe header"): debugbar locale, non del prodotto | idem |
Limiti: i tempi (8-9 s di caricamento) sono del dev server a thread singolo e non sono una misura del prodotto; i pesi sono anche senza compressione.

## Claim e coordinamento (16:35 UTC)
Un'altra sessione sta lavorando sulla stessa home da prima di questa story (mtime 16:20-16:28 UTC): `pages/index.blade.php` (titolo e description da JSON `home`, wrapper `fc-home` con riferimento a "DCP-106"), `components/layouts/app.blade.php`, `components/blocks/home/hero.blade.php`, `resources/css/app/16-homepage-civic-reframe.css`. La story DCP-106 non esiste ancora (solo un commento nel template) e `postcss/isolate-legacy-important.cjs` non cita ancora `fc-home`. Il 500 `Cannot translate attribute description` da loro introdotto alle 16:27 e' stato corretto da loro in pochi secondi.
| Area | File | Proprietario | Stato |
|---|---|---|---|
| Titolo/description della home, wrapper `fc-home`, isolamento regole legacy | `pages/index.blade.php`, `postcss/isolate-legacy-important.cjs`, `16-homepage-civic-reframe.css` | sessione tema (DCP-106) | in corso, NON toccare |
| Contrasto `.fc-eyebrow` della sezione "Hai gia' segnalato un problema?" | CSS/markup della sezione | sessione tema (l'isolamento legacy dovrebbe risolverlo): da rimisurare con la sonda | in attesa |
| Analisi del peso CSS/JS | solo questa story | DCP-51 HOME-WEIGHT | in corso |
| `link-name` di `.btn-icon` (mobile) e CLS mobile 0,047 | header Design Comuni / layout | DCP-51 lead | aperto 16:35 |
Causa trovata del contrasto (`explain-style.mjs`): una regola legacy `p:not(:where(body:has(.page-content[data-dc]), ...)), span:..., p.tex... { color: #191919 !important }` batte `.fc-track-section .fc-eyebrow { color: var(--fc-sun) }`; colore calcolato `rgb(25,25,25)` su sfondo `rgb(0,92,67)` (circa 2:1). La home non ha `data-dc`, quindi le regole legacy la colpiscono.

## Modifiche del lead (16:50 UTC)
| Cosa | File | Prima | Dopo (output reale) |
|---|---|---|---|
| Link di accesso senza nome sotto 992 px (axe `link-name`, serious) sulla home | `Themes/Sixteen/resources/views/components/sections/header/design-comuni.blade.php` (ramo ospite: `aria-label` = stessa etichetta del JSON `account.login_label`) | 375 px: 1 violazione | `a11y-page-probe.mjs /it/`: `0 nodi serious/critical` in due giri consecutivi. Parity HTML della replica con lo stesso header, misurata prima e dopo con `compare-body-html.mjs`: homepage 95,76% -> 95,76% (URL normalizzati 98,67 -> 98,57), amministrazione 93,97% -> 93,97% (98,15 -> 98,00): sopra il 90% |
| Stesso difetto nei due partial del CTA ospite | `components/sections/header/partials/personal-area-guest-cta.blade.php` e `personal-area-login-cta.blade.php` (non risultano inclusi dall'header vivo: codice morto o usato altrove) | senza nome | `aria-label`; test `Themes/Sixteen/tests/Unit/HeaderGuestCtaAccessibleNameTest.php` (2 casi: rosso -> verde, `20 passed` con la guardia dei template) |
| Link di accesso senza nome su `/it/tickets` (axe serious, a 375 e 1440) | `components/sections/header/tailwind.blade.php` (`aria-label="{{ $account['label'] ?: 'Accedi' }}"`) | lo `span` con il testo ha `display:none` anche a 1440 px sulla pagina viva (la classe `sm:inline` esiste nel bundle ma altra regola la batte): il link non aveva nome | `a11y-page-probe.mjs /it/tickets`: 2 nodi -> `0 nodi serious/critical` |
| Strumento | `bashscripts/tools/visual/a11y-page-probe.mjs` (axe a 375/1440, debugbar esclusa, exit 1 se serious/critical) | solo `wcag-aa-check.mjs` (tutte le pagine, scrive in /tmp, include la debugbar) | vedi `bashscripts/docs/visual-comparison/a11y-page-probe.md` |

Contrasto della sezione "Hai gia' segnalato un problema?" (eyebrow e testo, 2,18:1): NON risolto da me. Lo ha risolto la sessione tema (isolamento delle regole legacy dentro `.fc-home`): colore calcolato dell'eyebrow `rgb(255,209,102)` su `rgb(0,92,67)` (circa 8:1), misurato alle 16:44 UTC; `a11y-page-probe.mjs /it/` -> 0 nodi. Attenzione: una mia lettura precedente con "0 violazioni" a 375 e 1440 era un istante transitorio (le due misure successive, 16:36, mostravano di nuovo 2 nodi, mentre la pagina serviva due bundle `app-*.css` diversi): una lettura sola non basta quando altri ricostruiscono il CSS, per questo lo strumento va ripetuto.

## Misure di contorno (che ridimensionano le priorita')
- CLS mobile 0,046: 0,040 sono della debugbar di sviluppo (`phpdebugbar-minimized`); la pagina da sola fa ~0,006 (mobile) e ~0,001 (desktop). Nessun lavoro necessario.
- Le "16 immagini" sono 15 tile Leaflet + il logo UE: nessuna correzione nel template.
- Titolo: da "FixCity" a "FixCity — La piattaforma civic tech per la manutenzione urbana" (sessione tema, `pages/index.blade.php`); nessun canonical (non aggiunto: il layout e' condiviso).
- Errori in console: solo `phpdebugbar-*` (debugbar locale).

### Fix H-02 — landmark principale e cascata contrasto home (2026-10-13)

- Causa: `components/layouts/app.blade.php` rendeva la `<main>` senza `id`, ma
  lo skip-link dell'header puntava a `#main-container`. Le regole di contrasto
  già presenti sotto `#main-container` non raggiungevano quindi la home reale:
  l'eyebrow e il testo della fascia “Segui la tua segnalazione” risultavano
  scuri su fondo verde.
- Correzione: la `<main>` del layout applicativo ha ora `id="main-container"`
  e `tabindex="-1"`, così il salto da tastiera è valido e la fascia eredita
  i colori accessibili già definiti dal tema.
- Verifica: controllare `document.activeElement` dopo lo skip-link, contrasto
  calcolato dell'eyebrow/testo della fascia, assenza di overflow e layout a
  375, 768 e 1440 px.

### Verifica H-02 (2026-10-13)

Playwright sul server locale ha confermato a 375, 768 e 1440 px:

- `main#main-container` presente con `tabindex="-1"`;
- eyebrow della fascia: `rgb(255, 209, 102)` su verde scuro;
- testo della fascia: `rgba(255, 255, 255, .92)`;
- overflow orizzontale assente;
- errori JavaScript della pagina assenti.

Gli screenshot di audit sono stati prodotti in `/tmp/fixcity-home-final-375.png`,
`/tmp/fixcity-home-final-768.png` e `/tmp/fixcity-home-final-1440.png`.

### Fix H-01 — cascata CSS dell'hero (2026-10-13)

- Causa: `services-parity-fix.css` usava `[id*="hero"]`, quindi colpiva anche
  l'h1 `#fc-home-hero-heading`; il titolo riceveva un gradiente chiaro su fondo
  scuro e diventava quasi illeggibile.
- Correzione: il selettore è stato ristretto a `section[id*="hero"]`.
- Causa correlata: il layout hero cercava `.container`, mentre il markup usa
  un wrapper Tailwind `mx-auto max-w-7xl`; il selettore è stato allineato a
  `.fc-home-hero > div` per attivare la griglia desktop.
- Contrasto segnale: colori del testo/eyebrow della card hero sono ora espliciti
  e coerenti con il fondo scuro; i pulsanti non vengono sottolineati dalla
  cascata globale.
- Verifica Playwright a 375, 768 e 1440 px: nessun overflow orizzontale,
  h1 senza gradiente, testo del segnale bianco e eyebrow giallo.

## Aperto
- Peso CSS/JS: analisi in corso (subagent HOME-WEIGHT), sezione sotto.

## Coordinamento con la sessione tema (orchestratore DCP-32/99), 16:35: divisione del lavoro
L'utente ha mandato la stessa richiesta a piu' sessioni. Per non pestarci: **questa story e' del suo autore**; io (sessione tema) mi prendo SOLO i punti che qui sono ancora scoperti e non tocco `services-parity-fix.css` ne' le tue correzioni H-01 gia' fatte.
| Voce | Chi | File |
|---|---|---|
| H-01 cascata CSS dell'hero (colori espliciti, griglia `> div`), `services-parity-fix.css` | DCP-51 (altra sessione) | `16-homepage-civic-reframe.css`, `services-parity-fix.css` |
| Peso CSS/JS (subagent HOME-WEIGHT), immagini lazy/width/height, `btn-icon` link-name | DCP-51 (altra sessione) | `app.css`, viste dei blocchi |
| **SEO**: `<title>`/`description` dalla pagina CMS (la home usciva con `<title>FixCity</title>`), canonical, `hreflang`, Open Graph | sessione tema | `pages/index.blade.php`, `layouts/main.blade.php` (solo `<head>`), `home.json` (tenant+modulo) |
| **Accessibilita'**: il link "Vai ai contenuti" punta a `#main-container` che sulla home non esiste (axe `skip-link`), `aria-allowed-role` su 3 `article`, ordine dei titoli | sessione tema | `layouts/app.blade.php`, blocchi `how-it-works`/`quick-actions` |
| **Causa strutturale** dei contrasti (vedi sotto) | sessione tema, solo se concordato | `postcss/isolate-legacy-important.cjs` |
Fatto dalla sessione tema in `pages/index.blade.php`: wrapper `<div class="fc-home">` e `title`/`meta-description` dal JSON; in `hero.blade.php` la classe `fc-home-hero__inner` (innocua, la tua regola `> div` continua a valere).
**Causa radice misurata** (`explain-style.mjs`): `p{color:#191919!important}` e `h1{color:#1a1a1a!important}` (regole legacy globali) battono il colore dell'hero; i pulsanti `.fc-button` hanno `padding:0` e `display:flex` da un reset legacy (testo attaccato ai bordi). Ogni `!important` che aggiungiamo nell'hero e' un altro pezzo di quel debito (DCP-03). Proposta (non applicata finche' non rispondi qui): il plugin PostCSS isola le regole legacy dentro `.fc-home` come gia' fa per le pagine `data-dc` (le utility Tailwind e `16-homepage-civic-reframe.css` restano valide), cosi' le tue regole funzionano senza `!important`. Se preferisci restare con i patch espliciti, scrivilo qui sotto e annullo la modifica al plugin.

### Aggiornamento sessione tema 16:50: difetti ancora presenti dopo H-01 (misurati con `explain-style`/CDP sulla home costruita) e cause
Dopo la tua H-01 (hero leggibile, griglia a due colonne: confermato a schermo) restano, tutti con causa provata:
- **H-02 pulsanti `.fc-button` senza padding**: `a{padding-left:0!important}` (reset legacy) batte `.fc-button{padding:.75rem 1.2rem}`; il testo tocca i bordi e sembra tagliato ("Segnala un disservizio", "Traccia una segnalazione").
- **H-03 sezione "Segui la tua segnalazione" illeggibile**: le regole di colore dell'eyebrow e del testo sono scritte sotto `#main-container ...`, ma sulla home non esiste nessun `#main-container` (e' anche il bersaglio del link "Vai ai contenuti", axe `skip-link`): regole morte; vince `p{color:#191919!important}` sul verde scuro (axe `color-contrast` serious).
- **H-04 titoli con spaziatura troppo stretta**: `.fc-section-heading h2{letter-spacing:-.05em}` (-1,2 px a 24 px) e `.fc-how-card h3{-.025em; peso 750}`: lettere sovrapposte.
- **H-05 mappa**: parte sull'intera Europa/Italia invece che sul territorio del Comune.
**Presa in carico dalla sessione tema** (H-02, H-03 e skip-link con la stessa correzione strutturale; H-04 e H-05 con edit ancorati, nessun `!important` nuovo): file `postcss/isolate-legacy-important.cjs` (isolamento delle regole legacy dentro `.fc-home`, la stessa tecnica gia' usata per `data-dc`), `pages/index.blade.php` (`id="main-container"` e `tabindex="-1"` sul wrapper `.fc-home`), e SOLO le righe di `16-homepage-civic-reframe.css` per `letter-spacing`. Non tocco `services-parity-fix.css` ne' le tue regole H-01. Se hai gia' un build in corso o edit sugli stessi blocchi, scrivilo qui sotto: aspetto il tuo build prima di lanciare il mio (lock `/tmp/design-comuni-build.lock`).

### Risultati della sessione tema (16:55): H-02..H-05 e a11y, misurati
- **Causa strutturale dei contrasti e dei padding**: `ticket-parity.css` (file di parity dei ticket) e i `civic-design-*.css` contengono 26 regole GLOBALI con `!important` su elementi nudi (`a{padding:0!important;color:#007a52!important}`, `p{color:#191919!important}`, `h1{color:#1a1a1a!important}`, `.card{padding:0!important}`, `body{color:...}`) che escono dalle loro pagine e battono lo strato `app/16-homepage-civic-reframe.css`.
- **Correzione**: `postcss/isolate-legacy-important.cjs`: dentro `.fc-home` (wrapper della home, `pages/index.blade.php`) le regole con `!important` che non contengono `.fc-` nel selettore non valgono; restano valide utility Tailwind, preflight, lo strato della home e i plugin della mappa (`.leaflet-*`, `.marker-cluster*`). Errori miei provati lungo il percorso: (1) il criterio "per file sorgente" non funzionava dopo Tailwind (0 selettori guardati nel CSS compilato); (2) il primo criterio "ogni `!important`" esentava anche `leaflet.css` (`.leaflet-tile{max-width:none!important}`): tile larghe 0, mappa grigia; (3) `id="main-container"` sul wrapper attivava regole legacy (spazi bianchi).
- **Rifiniture** (blocco in coda a `16-homepage-civic-reframe.css`, senza `!important`): `#main-container:has(> .fc-home){padding-block:0}` (la striscia bianca sopra l'hero e sopra il footer veniva da `<main id="main-container">` del tuo cambio al layout, che attiva `#main-container{padding-block:2rem}`) e `letter-spacing` meno stretto per `h1`/`h2`/`h3`/valore del segnale (con i corpi ora alla dimensione prevista -0,05em sovrapponeva le lettere).
- **SEO**: `<title>` e `meta description` ora dalla pagina CMS (`home.json`, it/en, tenant e modulo): prima `<title>FixCity</title>` e description "FixCity". `description` non e' una colonna traducibile del modello `Page` (errore mio: 500 per due minuti): si legge l'oggetto per lingua come attributo grezzo.
- **A11y**: `how-it-works` usa `<ol>/<li>` (prima `article role="listitem" tabindex="0"`: ruolo non ammesso e tab stop senza funzione). axe (WCAG 2.x A/AA + best-practice) a 1440 e 375: da 2 serious + 3 minor a **0 serious, 0 minor**; restano `heading-order` (h4 del footer condiviso) e `region` (solo debug bar di sviluppo).
- **Mappa**: tile 256 px caricate (18/18). Non fatto: centrare/zoomare la mappa sul territorio del Comune (H-05, dato nel JSON).
- Stato: la parte visiva e' migliorata (hero, pulsanti, sezione "Segui la tua segnalazione", mappa); i numeri di peso (CSS 3,2 MB) restano alla tua analisi HOME-WEIGHT.


## Analisi del peso (HOME-WEIGHT, 2026-10-13 17:14 UTC)

Subagent HOME-WEIGHT, sola analisi: nessun file del repo modificato, nessuna build lanciata, solo richieste GET. Sonda e varianti CSS in `/tmp/claude-1000/-mnt-nas07-var-www--bases-base-fixcity-fila5/1ea61eae-12f4-4e51-8d5a-1d473accd045/scratchpad/weight/` (`measure.cjs` rete + Coverage, `compose2.cjs`/`families.cjs` classificazione del CSS compilato, `variants*.cjs` varianti, `cmp.cjs` confronto degli stili calcolati, `exp3.cjs` tempi).

**Metodo e riserve.** Chromium (Playwright) con CDP `Network.*` (byte trasferiti = `encodedDataLength`, decompressi = somma `dataReceived`) e Coverage API CSS/JS (`resetOnNavigation:false`), cache disattivata, ospite, 1440x900 e 375x812, scroll completo e 2,5 s di attesa. File misurato: `app-SgumN338.css` (build 16:26 UTC). La sessione tema ha poi ricompilato (16:58, `app-I0Ze3QDs.css`, JS `app-BZJVbMNA.js`): rimisurato, la struttura non cambia (3.205.837 B, 12,8% usato, guard 1.237.437 B, blocco DC 228.375 B identico). La Coverage CSS conta una regola come usata se ha combaciato almeno una volta: hover, focus, stati aperti e media query non attive risultano "non usati", quindi la percentuale e' un minimo del necessario, non una quantita' rimovibile alla cieca; `@font-face`, `@keyframes`, `@property` non contano mai come usati. La macchina era carica (load average 40-90 su 24 core, processi `ollama`): i tempi sono mediana e minimo di 5 round alternati e sono indicativi; FCP/LCP sono troppo rumorosi per essere citati, ricalcolo stile e task time reggono. I byte sono esatti.

### 1. Cosa carica `/it/` (1440 px)

Totale 5.746.276 B (stesso ordine dei 5,6 MB del lead). `Content-Encoding`: assente su tutto (solo Google Fonts risponde gzip). `Cache-Control`: `public, max-age=3600` per tema/Filament/Livewire, `max-age=86400, public` per debugbar, documento `no-cache, no-store`.

| Risorsa | Trasferiti B | Decompressi B | Incluso da |
|---|---|---|---|
| `/themes/Sixteen/assets/app-SgumN338.css` | 3.132.461 | 3.132.259 | `components/layouts/main.blade.php:64` `@vite(['resources/css/app.css'])` (preload + link) |
| `/vendor/livewire/livewire.js` | 609.633 | 609.417 | `main.blade.php:79` `@livewireScripts` |
| `map-lit-a6M6TAVV.js` | 252.670 | 252.454 | `main.blade.php:81` `@vite(app.js)`: modulepreload, import statico in `app.js:13` |
| `app-_RynY-3s.js` | 226.997 | 226.781 | `main.blade.php:81` (`type=module`) |
| `/_debugbar/assets?type=js` | 190.076 | 189.826 | package debugbar (ambiente) |
| `/js/filament/support/support.js` | 155.721 | 155.505 | `main.blade.php:80` `@filamentScripts` |
| `/_debugbar/assets?type=css` | 113.782 | 113.539 | debugbar (ambiente) |
| `design-comuni/.../bootstrap-italia/dist/svg/sprites.svg` | 93.907 | 93.715 | 29 `<use href>` nell'header/footer (14 simboli su 179) |
| `leaflet.markercluster-kYRFWcpd.js` | 34.221 | 34.005 | dipendenza di `map-lit` |
| `map-lit-B133ls8W.css` | 31.988 | 31.786 | CSS importato da `app.js` (link in coda al body) |
| `/js/filament/tables/tables.js` | 25.278 | 25.062 | `@filamentScripts` |
| `filament-select-tree-styles.css` | 13.855 | 13.653 | `@filamentStyles` |
| `app-D_U2vHbg.css` (poi `app-B0BpUByC.css`) | 10.085 | 9.883 | CSS importato da `app.js` (Splide, con guard) |
| Google Fonts `css2?family=Titillium+Web...` | 1.092 | 9.733 (gzip) | `@import` in testa a `app.css` (riga 8) |
| `notifications.js` / `leaflet-heat` (dinamico) / `schemas.js` / `actions.js` | 8.415 / 5.080 / 3.990 / 3.504 | 8.199 / 4.864 / 3.774 / 3.288 | Filament / `map-lit` |
| `cookie-consent.css` / `filament/inter/index.css` / `header-actions-wrap.css` | 3.125 / 2.203 / 234 | 2.923 / 2.001 / 32 | `main.blade.php:65`, `@filamentStyles`, asset Xot |
| 4 woff2 Titillium self-hosted (700, regular, 600, italic) + 1 da gstatic (900) | 75.092 + 10.989 | 74.336 + 10.456 | `@font-face` in `app.css` |
| 15 tile `tile.openstreetmap.org/6/..png` | 576.794 | 571.738 | create da Leaflet (a 375 px: 6 tile, 206.595 B) |
| inline: debugbar 30.150, Boost logger 7.230, Filament vars 3.218, `wire:loading` 1.366 | nel documento (89.310 B decompresso) | | pacchetti (ambiente) |

Per tipo (trasferiti): text/css 3.308.785 (9 fogli), application/javascript 1.325.509 + text/javascript 190.076, image/png 576.843, svg 121.786, font 86.081, html 90.890.

### 2. Coverage per file (byte totali, usati, %)

| CSS | Totali | Usati 1440 | % | Usati 375 | % |
|---|---|---|---|---|---|
| `app-SgumN338.css` | 3.132.209 | 395.651 | 12,6 | 410.528 | 13,1 |
| (unione dei due viewport) | | 435.113 | 13,9 | | |
| `map-lit-B133ls8W.css` | 31.786 | 8.847 | 27,8 | 8.847 | 27,8 |
| `app-D_U2vHbg.css` (Splide) | 9.883 | 0 | 0 | 0 | 0 |
| `filament-select-tree-styles.css` | 13.653 | 0 | 0 | 0 | 0 |
| `cookie-consent.css` / `inter/index.css` | 2.923 / 2.001 | 0 | 0 | 0 | 0 |
| debugbar css (ambiente) | 113.539 | 53.702 | 47,3 | 55.638 | 49,0 |
| `<style>` Filament vars / `wire:loading` | 3.218 / 1.366 | 3.207 / 47 | 99,7 / 3,4 | | |

| JS | Totali | Usati 1440 | % | Usati 375 |
|---|---|---|---|---|
| `livewire.js` | 609.417 | 81.162 | 13,3 | 81.162 |
| `map-lit-a6M6TAVV.js` | 252.403 | 114.786 | 45,5 | 114.472 |
| `app-_RynY-3s.js` | 226.771 | 32.824 | 14,5 | 32.824 |
| debugbar js (ambiente) | 189.826 | 94.786 | 49,9 | 94.837 |
| `filament/support.js` | 155.505 | 13.009 | 8,4 | 13.009 |
| `leaflet.markercluster` | 34.005 | 7.884 | 23,2 | 7.884 |
| `filament/tables.js` | 25.062 | 703 | 2,8 | 703 |
| `notifications.js` / `schemas.js` / `actions.js` | 8.199 / 3.774 / 3.288 | 268 / 290 / 111 | 3,3 / 7,7 / 3,4 | |
| `leaflet-heat` | 4.864 | 386 | 7,9 | |
| Totale file JS (senza debugbar e inline) | 1.323.288 | 251.423 | 19,0 | 251.109 |

Il JS usato e' "eseguito" (V8 block coverage): le librerie registrano molto codice che non gira, ma i tratti inutilizzati stanno in tante funzioni piccole (solo 40 KB in tratti contigui sopra 3 KB), quindi l'attribuzione per modulo sotto e' per dimensione dei sorgenti, non misurata.

### 3. Da dove vengono i 3,13 MB di `app.css` (classificazione sul CSS compilato, con postcss)

`app.css` importa 167 file (1,45 MB di sorgente prima dell'espansione Tailwind/Filament/Flowbite/DaisyUI). Minificato (una riga). Nel compilato:

| Parte | Byte | % file | Regole | Usato 1440 |
|---|---|---|---|---|
| Regole legacy con guard `:not(:where(body:has(.page-content[data-dc]),body:has(.page-content[data-dc]) *))` | 2.845.190 | 90,8 | 13.364 | 13,5% |
| di cui solo il TESTO del guard (15.269 occorrenze x 81 B) | 1.236.789 | 39,5 | | |
| Blocco Design Comuni con prefisso `body:has(.page-content[data-dc])` | 228.375 | 7,3 | 1.854 | 0,0% |
| Regole senza guard (`html`/`:root`/keyframes) | 5.194 | 0,2 | 21 | 99,9% |
| `@property`, `@font-face`, `@keyframes`, `@import` | 10.219 | 0,3 | 115 | 2,1% |

Dentro il legacy, per famiglia (1440, rule usate): `.fi-*` Filament 760.129 B / 3.261 regole / 0%; elementi nudi 285.728 / 14%; `.it-*` 126.420 / 37,8%; `.dc-*` 93.641 / 0%; `.cmp-*` 60.297 / 0%; varianti `dark:` 58.382 / 0%; `hover:` 47.386 / 0%; `.leaflet-*` 35.292 / 25%; `.steppers` 35.208 / 0%; `.filepond` 32.596 / 0%. Tutte le regole con `.fi-` nel selettore: 959.770 B (30,6% del file), 0% usate sulla home. Origine: `style-apply.css:7-14` importa `vendor/filament/{support,actions,forms,infolists,notifications,schemas,tables,widgets}/resources/css/index.css`; `app.css:28` `@plugin "daisyui"`; `app.css` importa anche `flowbite/dist/flowbite.css` (223 KB di sorgente).

### 4. Il CSS Design Comuni dentro `body:has(.page-content[data-dc])`: caricato anche fuori da `data-dc`?

Si'. E' un unico file per tutte le pagine: `app.css:179-181` (`@import './design-comuni/fonts.css'`, `components.css` 362.607 B di sorgente, `overrides.css`) finisce in `app-*.css`, incluso da `main.blade.php:64` per ogni pagina. Sulla home (senza `data-dc`: 0 occorrenze nell'HTML, verificato) pesa 228.375 B compilati (1.854 regole, 7,3%) e ne usa 0. Vale anche al contrario: sulle 59 pagine `/it/tests/*` con `data-dc` le 13.364 regole legacy (2,85 MB) non possono mai combaciare, perche' il guard le esclude per costruzione (D16): tranne 15 regole (22.208 B) che colpiscono `<html>` (`*`, `:root`, `:before`, `::backdrop`, variabili `--tw-*`). Sono quindi 2,86 MB su 3,13 caricati e parsati inutilmente su ogni pagina DC. Nota: 162 regole con `[data-slug]` e guard (37.448 B, `app.css` righe ~195-330) non sono raggiungibili sulle pagine `data-dc` (59 su 60 pagine `tests.*`; l'unica senza `data-dc` e' `tests.index`, `/it/tests`, da verificare se le usa).

### 5. Font e immagini

Font: `font-display: swap` presente su tutti i 16 `@font-face` locali (`design-comuni/fonts.css`: Titillium 8, Lora 4, Roboto Mono 4) e nell'URL Google (`&display=swap`); nessun `<link rel="preload" as="font">` (l'head ha solo preload di CSS e moduli JS). Su `/it/` partono solo: Titillium 700 a +903 ms, regular e 600 a +1533 ms (scoperti solo dopo il parse dei 3 MB di CSS), 900 da `fonts.gstatic.com` (10,4 KB; lo chiedono 20 elementi con peso 750/800 che non hanno `@font-face` locale), italic 400 (20,7 KB) molto dopo (+12 s, evento successivo). Lora e Roboto Mono mai caricati. L'`@import` Google Fonts e' la prima regola di `app.css` (riga 8): dipendenza esterna sul percorso critico (2 origini, richiesta CSS a +345 ms, woff2 a +1533 ms), in contraddizione con il commento "nessun CDN" di `fonts.css`; in rete chiusa il peso 900 manca.

Immagini: 16 `<img>` = 15 tile OSM + 1 SVG. Nessun raster del tema sulla home.

| Immagine | Formato | Naturale | Mostrata | Byte |
|---|---|---|---|---|
| 15 tile `{a,b,c}.tile.openstreetmap.org/6/32..36/22..24.png` (6 a 375 px) | PNG | 256x256 | 256x256 (DPR 1) | 10.804-56.183 ciascuna, 576.794 in tutto (375 px: 206.595) |
| `logo-eu-inverted.svg` (footer, `loading=auto`) | SVG, 15 path | 178x56 | 254x80 | 24.584 (gzip 9.123) |

Stima conversione (nessun file toccato): scaricate 5 tile campione (GET) e ricodificate in memoria con Pillow: PNG 208.012 B, WebP lossless -9,8%, WebP q80 -59,9%, PNG a palette 128 colori -6,5%. Le tile pero' sono di terzi (`tile.openstreetmap.org`): WebP vale solo con un proprio proxy/provider di tile; sui 577 KB sarebbero circa -345 KB. Il sprite `sprites.svg` pesa 93.715 B (gzip 32.208) per 14 simboli usati su 179 (circa 4 KB).

### 6. Ambiente contro prodotto

| Voce | Dev misurato | Produzione | Natura |
|---|---|---|---|
| Compressione (nessun `Content-Encoding` su `artisan serve`) | testo 5.030.000 B | gzip 9: 738.964 B (-85%), brotli 11: 589.985 B (-88%) (comprimendo i file serviti); `app.css` 3.132 KB -> 261 KB gzip / 180 KB brotli | ambiente (nginx/Apache) |
| Debugbar (`DEBUGBAR_ENABLED=true`, `APP_DEBUG=true`) | js 189.826 + css 113.539 + inline 30.150 + 4 fetch `/open` (~43 KB) | 0 | ambiente |
| Boost browser logger | inline 7.230 + 3 POST `/_boost/browser-logs` | 0 | ambiente |
| `livewire.js` non minificato | 609.417 (gzip 127.969) | `livewire.min.js` 261.782 (gzip 86.092) quando `app.debug=false` (verificato in `FrontendAssets.php:85-88`) | ambiente |
| `Cache-Control: max-age=3600` su file con hash | rivalidazione oraria | `immutable, max-age=31536000` | web server |
| Hot file Vite | assente (`public_html/hot`, `laravel/public/hot` non esistono): il tema serve la build `public/assets/*` | n/d | nessun effetto |
| Minificazione CSS/JS del tema | gia' attiva (CSS su una riga, esbuild) | uguale | nulla da fare |
| Parse e ricalcolo stile di 3,13 MB / 30.000 regole | 400/560 ms (min/mediana) su macchina carica | uguale: la compressione non cambia il CSS decompresso | PRODOTTO |
| Build orfane in `public/assets` (`emptyOutDir:false`) | 283 file, 299 MB | idem sul deploy | prodotto (igiene), non pesa sulla pagina |

### 7. Le 5 azioni a maggior guadagno (NON applicate)

Stima per la home salvo diversa indicazione; i KB sono decompressi (dev) con il gzip tra parentesi. Il guadagno CSS e' misurato su varianti generate dal CSS compilato (scratchpad), non su una build.

**A1. Due fogli di stile invece di uno: legacy senza guard per le pagine normali, solo Design Comuni per le pagine `data-dc`.**
- Meccanismo: nuova entry `resources/css/app-dc.css` (imports `design-comuni/*` + le 15 regole su `<html>`) in `vite.config.js` `input` (esiste gia' il precedente `app-test.css`); `app.css` perde `@import './design-comuni/*'` (righe 179-181) e il plugin `postcss/isolate-legacy-important.cjs` non appende piu' il guard (l'isolamento diventa fisico: due fogli mai caricati insieme). Scelta dell'entry in `components/layouts/main.blade.php:64` dallo stesso dato che oggi scrive `data-dc` (JSON `layout`, DCP-32), ad esempio un `@push`/variabile condivisa dal wrapper della pagina (lo slot e' reso prima del layout).
- Guadagno misurato: home 3.132 -> 1.661 KB (-1.471 KB, -47%; gzip 261 -> 205 = -56; brotli 180 -> 149); pagine DC 3.132 -> 272 KB (-2.860 KB, -91%; gzip 261 -> 39 = -222; brotli 180 -> 30). Ricalcolo stile (min/mediana, 5 round alternati): home 406/562 -> 181/323 ms; `/it/tests/homepage` 321/422 -> 73/114 ms.
- Equivalenza provata: confronto di TUTTE le proprieta' calcolate di ogni elemento (base contro variante) sulla home e su tests `homepage`, `catalog`, `domande-frequenti`, `segnalazioni-elenco` a 1440 e 375: 0 differenze, salvo 1 elemento `.container` (margine) che varia anche tra due caricamenti dello stesso build (rumore).
- Rischio parity: alto per l'estensione, basso per la logica. Da rimisurare tutte le sentinelle (`/it`, `tests.index`, `tests.argomenti`, baseline in `bmad-output/parity/`) e le 59 pagine tests con lo stesso confronto di stili calcolati; stati non campionati (`html.dark`, hover/focus); `data-navigate-track="reload"` sui link: passare da pagina DC a non-DC con `wire:navigate` cambia il foglio tracciato e forza un reload completo.
- Verifica del guadagno: Coverage API (byte del foglio caricato), CDP `encodedDataLength`, `Performance.getMetrics().RecalcStyleDuration` in round alternati, poi gate DCP-01 (HTML e visual a 3 viewport).

**A2. Filament fuori dal foglio comune e fuori dalle pagine senza componenti Filament (CSS e JS).**
- Meccanismo: spostare gli import `vendor/filament/*/index.css` di `style-apply.css:7-14` in `resources/css/filament-fo.css` (nuova entry Vite) caricata solo dalle pagine con form/widget Filament (wizard `tickets/create`, login/registrazione `UserForm`); in `main.blade.php:63,80` rendere condizionali `@filamentStyles`/`@filamentScripts` a un flag impostato da quelle pagine.
- Guadagno misurato/stimato: CSS -613 KB oltre A1 (1.661 -> 1.049 KB; gzip 205 -> 148 = -57; brotli 149 -> 112), ricalcolo stile 181/323 -> 68/93 ms (il taglio piu' grande di CPU: i selettori `.fi-*`); JS `/js/filament/*` 196 KB (gzip 66; eseguito 2,8-8,4%); `select-tree` e `inter` 16 KB (gzip 3). Totale circa -825 KB (gzip -127), 9 richieste in meno.
- Rischio parity: medio-alto: ogni pagina con `.fi-` va identificata (grep sull'HTML reso di tutte le pagine reali e tests; il blocco DC contiene una sola regola con `.fi-`, 199 B). Sentinelle: tests `segnalazione-*` (wizard), `tickets.*`, login. Un componente Filament caricato in ritardo (modale Livewire) senza gli script e' il modo piu' probabile di rompere qualcosa.
- Verifica: stessa catena di A1 piu' smoke dei form (`npm run test:auth-register-smoke`) e Coverage JS (`support.js` non piu' in rete).

**A3. Flowbite, Splide e focus fuori dal bundle iniziale (`app.js`).**
- Meccanismo: `resources/js/app.js:19` `import 'flowbite'` (135.824 B min, gzip 29.616) diventa `import()` solo se la pagina contiene `[data-modal-toggle],[data-dropdown-toggle],[data-collapse-toggle],[data-accordion],[data-tooltip-target],[data-popover-target],[datepicker]`; `resources/js/theme/design-comuni-home.js:6` `import Splide` (29.803 B, gzip 12.929) in import dinamico dentro `dcCarousel` (lo stesso gia' fatto in `components/bootstrap-italia.js:43`); `@alpinejs/focus` (app.js:21) idem.
- Evidenza: la home ha 0 attributi Flowbite e 0 occorrenze di `splide` nell'HTML; `app-*.js` esegue il 14,5% di 226.781 B. Stima da dimensione dei sorgenti (nessuna sourcemap, non misurato per modulo): circa -165 KB (gzip -50).
- Rischio parity: medio: `dcCarousel` e' nei blocchi `event-detail/design-comuni`, `report-detail/related`, `service-flow/parts/related` (layout shift all'init se Splide arriva tardi: il gate misura a pagina assestata; da elencare anche i caroselli creati con `Splide` fuori da `dcCarousel`). Verifica: Coverage JS dell'entry e CLS (`PerformanceObserver`) sulle pagine con quei blocchi.

**A4. Mappa a richiesta (sotto la piega).**
- Meccanismo: `resources/js/app.js:13-15` importa staticamente `map-lit`, `map-filter-lit`, `coordinate-picker-lit`. La mappa sta a y=1157 (viewport 900, pagina alta 3502) e a y=1234 (viewport 812), cioe' fuori dal primo schermo, ma JS, CSS e tile partono subito (3 `modulepreload` in head). Con `IntersectionObserver` (`rootMargin` ~400 px) su `.fc-map-section` e `import()` dei componenti Geo (Vite carica il CSS del chunk solo allora) il primo caricamento non paga: `map-lit` 252 KB (gzip 72) + markercluster 34 KB + heat 5 KB + `map-lit.css` 32 KB (usato 27,8%) + 15 tile PNG 577 KB (375 px: 207 KB) + `/api/tickets/geojson`.
- Guadagno: -323 KB di JS/CSS (gzip -89) e fino a -577 KB di tile rinviati (non eliminati per chi scorre). Il PNG delle tile non e' comprimibile (terzi).
- Rischio parity: basso per `/it/tests` (da verificare che nessuna pagina tests abbia `.leaflet-container`), medio per `/it/tickets*` e wizard che usano gli stessi componenti sopra la piega: l'import va per elemento (`customElements.whenDefined`), non globale. Interferisce con H-05 (centratura mappa) della sessione tema. Verifica: `npm run test:map-lit-smoke`, `test:map-picker-smoke`, richieste di rete al primo carico.

**A5. Font e sprite sul percorso critico.**
- Meccanismo: (a) togliere l'`@import` Google Fonts (`app.css` riga 8) e hostare il peso 900 (serve a 20 elementi con peso 750/800 della home; senza, 800 ricade su 700: cambio visivo da accettare o compensare) -> via 1 CSS bloccante e 2 origini; (b) `<link rel="preload" as="font" type="font/woff2" crossorigin>` per Titillium regular, 600, 700 (54 KB) nell'head di `components/layouts/main.blade.php`: oggi partono a +903/+1533 ms perche' scoperti dopo il parse del CSS, con il preload partirebbero con l'HTML; (c) `sprites.svg` (93.715 B) sostituito da un sprite ridotto o dai 14 simboli inline (circa 4 KB).
- Guadagno: byte circa -20 KB (Google) e -90 KB (sprite, gzip -30); tempo: font definitivo disponibile 0,6-1,2 s prima su questa macchina, icone dell'header senza attendere +0,55 s. Il preload non riduce byte.
- Rischio parity: basso sul font (le pagine tests usano pesi 300-700 locali; verificare che nessuna usi 200/900), medio sullo sprite (ogni pagina DC usa simboli diversi: il set va calcolato come unione delle pagine, non solo della home). Verifica: waterfall CDP (inizio dei woff2), `document.fonts` stato a +1 s, confronto visivo delle icone.

**Somma indicativa sulla home (prodotto, non ambiente):** circa -2.900 KB decompressi su 5.746 (-50%) piu' 577 KB di tile rinviate, in produzione circa -347 KB gzip dei 739 KB gzip di testo. Con le voci d'ambiente (debugbar, `livewire.min.js`, compressione, cache immutable) la home reale scenderebbe a circa 0,3-0,4 MB di testo trasferito, ma il costo di parse/ricalcolo del CSS (400-560 ms qui) dipende solo da A1 e A2, non dalla compressione.

**Ordine consigliato:** A1 (massimo guadagno, equivalenza dimostrabile e gia' coperta dal confronto di stili calcolati) -> A2 (piu' rischio, taglio di CPU maggiore) -> A3 -> A4 -> A5. Prerequisito d'ambiente per qualsiasi misura di rete: dev server dietro nginx con gzip/brotli e `APP_DEBUG=false`, altrimenti i 5,6 MB non sono confrontabili tra prima e dopo.

## Verifica del lead sull'analisi del peso (17:20 UTC)
Ricontrollato con `ls`, `grep` e `gzip -9` sul bundle SERVITO in quel momento (`app-DxbuW0VJ.css`, ricompilato dalla sessione tema dopo la misura di HOME-WEIGHT): 3.205.691 byte (3,06 MB; l'analisi cita 3,13 MB su un bundle precedente); il suffisso di isolamento `:not(:where(body:has(.page-content[data-dc]) ...))` compare 15.276 volte e occupa circa 1,24 MB, il 38,6% del file (analisi: 39,5%); `resources/css/app.css:179-181` importa `fonts.css`, `components.css` e `overrides.css` di Design Comuni anche per le pagine senza `data-dc`; il solo CSS compresso con gzip -9 pesa 257 KB.
Lettura per priorita' (lead):
- Il peso trasferito in produzione NON e' 5,6 MB: con compressione il testo scende a circa 0,7 MB (gzip) o 0,6 MB (brotli); il dev server `php artisan serve` non comprime e include la debugbar (circa 377 KB). Verificare che il server di produzione comprima (CSS, JS, SVG, JSON) e che `APP_DEBUG=false` serva `livewire.min.js` (-347 KB): costa zero righe di codice.
- Il costo che resta nel prodotto e' il tempo di calcolo dello stile, non i byte: 400-560 ms di ricalcolo stile misurati qui (CPU da desktop, macchina carica). Su un telefono di fascia media sara' multiplo: per "ottimizzato per cellulare" e' la voce che conta, e l'azione A1 (due fogli di stile, uno senza il guard di isolamento) e' quella che la riduce (stima dell'analisi: 406/562 -> 181/323 ms sulla home; misurata su varianti del CSS compilato, non su una build vera).
- Le azioni A1 e A2 cambiano la pipeline di build (`postcss/isolate-legacy-important.cjs`, entry Vite) che oggi sta riscrivendo la sessione tema (DCP-106/D16): NON si applicano da qui in parallelo; si propongono a quella sessione con i numeri, e si decidono con una build vera, le sentinelle `/it/tests/*` rimisurate e `data-navigate-track` con `wire:navigate`. A3 (import dinamico di Flowbite, Splide e focus), A4 (mappa a richiesta) e A5 (font e sprite) sono indipendenti e piu' piccole: candidate per la prossima passata.
- Non misurato: Core Web Vitals reali (FCP/LCP rumorosi con load average 40-90), rete mobile reale, build di produzione.
