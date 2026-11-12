---
title: "Sweep del front office anonimo e diff dell'head: metodo, soglie, trappole"
type: how-to
status: active
module: Sixteen
created: 2026-11-12
updated: 2026-11-12
tags: [how-to, sixteen, front-office, audit, playwright, sweep, head, parity, go-live-gate]
qmd: "sweep front office anonimo playwright 128 url 1440 375 canonical hreflang robots titolo alt chiavi grezze overflow lazy diff head go-live-gate"
related:
  - ../stories/front-office-production-readiness-audit.story.md
  - ../stories/icon-sprite-deployability.story.md
  - ../stories/home-news-grid-specificity.story.md
  - ../plans/front-office-hardening-plan.md
  - ../../../../Modules/Cms/docs/stories/head-sixteen-parity-closeout.story.md
issues: []
discussions: ["https://github.com/laraxot/theme_sixteen_fila5/discussions/95"]
---

# Sweep del front office anonimo e diff dell'head

**Discussione (decisioni e alternative scartate):** [#95](https://github.com/laraxot/theme_sixteen_fila5/discussions/95), complementare a [#93](https://github.com/laraxot/theme_sixteen_fila5/discussions/93) (head SEO) e [#94](https://github.com/laraxot/theme_sixteen_fila5/discussions/94) (audit, area loggata).

Procedura usata il 2026-11-11 per l'audit del front office da utente non loggato. Trovo' lo sprite in 404 su ogni pagina (F-01), la griglia
delle novita' a 2 card (F-06) e, dopo la migrazione a `<x-cms::head>`, canonical e hreflang spariti dalle pagine `noindex` (D-7).

## Cosa dimostra e cosa no

| Dimostra | Non dimostra |
|---|---|
| Stato HTTP, `<title>`, description, canonical, robots, `<h1>`, `alt`, chiavi grezze, overflow a 375 px, asset in 4xx, errori di console | Il design (serve guardare gli screenshot), i tempi (con carico 30-40 non valgono), l'accessibilita' completa (serve axe), l'utente loggato |

## Prerequisiti

- Dev su `http://127.0.0.1:8081` (APP_DEBUG attivo: la Debugbar e `POST /_boost/browser-logs` sono rumore atteso, non difetti; in produzione devono sparire e lo verifica il gate `ENV-*`).
- Playwright dal tema (`laravel/Themes/Sixteen/node_modules`) con **Chrome di sistema**: `executablePath: '/usr/bin/google-chrome-stable'`, `args: ['--no-sandbox']`.
- Carico basso, oppure un comando alla volta tramite `bashscripts/tools/heavy-slot.sh` (limitatore `flock`; con carico 35 e' obbligatorio, vedi [DCP-455](../../../../Modules/Fixcity/docs/stories/dcp-455-strumenti-del-gate-sopravvivono-alla-sync.story.md)).

## Procedura

1. **Elenco URL.** 32 percorsi x 4 lingue (`it/en/de/es`) = **128**: home, ticket (elenco, creazione, conferma, tracciamento, 3 schede a campione), accesso e registrazione,
   area personale (4 pagine: per l'anonimo reindirizzano al login), pagine legali e di servizio (privacy, cookie, accessibilita', note legali, media policy, FAQ, mappa del sito),
   blog (indice + 3 articoli), eventi (indice + 3 eventi) e i **404 voluti** (pagina e ticket inesistenti). Ogni URL va aperto a **1440x900 e 375x812**.
2. **Per pagina** (`waitUntil: 'load'`, poi 0,9 s) si registrano: `status`, `finalPath` (per vedere i redirect), `title`, `htmlLang`, conteggio di `<title>`,
   `meta[name=description]`, `link[rel=canonical]` (e il suo `href`), `robots`, `og:title`, `theme-color`, numero e testo di `<h1>`, `img` senza attributo `alt`,
   primo elemento che sborda oltre la larghezza del viewport, testo grezzo e italiano, errori di console, richieste fallite, risposte >= 400 non-documento.
3. **Definizioni operative.**
   - *Chiave grezza:* nodo di testo che combacia con `^[a-z][a-z0-9_]*(\.[a-z0-9_]+){1,5}$` e non finisce in un TLD/estensione noto (`com|it|eu|test|local|json|php|js|css|png|jpg|svg|pdf...`), oppure `modulo::chiave`.
   - *Italiano fuori da `/it`:* parole spia (`della|delle|degli|nella|sono|segnalazion*|cittadin*|accedi|registrati|quartiere|invia...`) nel testo visibile di una pagina `en/de/es`. Va letto a mano: in blog ed eventi e' contenuto, non difetto di interfaccia.
   - *Anomalia:* `status` diverso dall'atteso, `titleCount`, `descCount` o `h1` diversi da 1, `canonicalCount` diverso da 1 su una pagina 200, `imgNoAlt > 0`, chiavi grezze, overflow a 375 px, `htmlLang` diverso dalla lingua dell'URL.
4. **Lettura per ordine di esecuzione.** Un difetto globale (come lo sprite) compare sulle prime pagine e sparisce quando viene corretto durante lo sweep: contare le pagine **consecutive** con 0 asset in errore prima e dopo.
5. **Screenshot.** Solo del viewport, non `fullPage`; se serve una sezione sotto la piega, **scrollare e aspettare ~7 s** (le immagini sono `loading="lazy"`). Una cattura che sembra un bug **si riproduce prima di correggerla** (vedi F-06: «immagini mancanti» era un artefatto).
6. **Stile calcolato, non sorgente.** Per ogni difetto di layout misurare con `getComputedStyle` (display, gap, padding della colonna) e con `getBoundingClientRect`.

## Diff dell'head prima/dopo una migrazione

Serve una **linea di base presa prima** della modifica (con orario annotato): senza, il confronto non esiste.

1. Salvare lo sweep «prima» (`status`, `title`, `canonicalCount`, `robots`, `descCount`, `ogTitleCount`, `htmlLang`).
2. Dopo la modifica scaricare l'**HTML grezzo** degli stessi URL e confrontare gli stessi campi, piu' il conteggio di `hreflang`. Differenze attese vanno elencate con la decisione che le copre; le altre sono regressioni.
3. L'HTML grezzo e il DOM possono differire (script che iniettano tag): per la chiusura H-5 il diff va fatto **anche sul DOM**, e da utente loggato.

Esito del 2026-11-11 (128 URL): 0 differenze su description, `og:title`, `<html lang>`, status; 84 pagine con `robots` esplicito (D-4, approvato); 4 titoli di home con ordine invertito (D-2); **36 URL
senza canonical e hreflang** (le pagine `noindex`) non coperti da nessuna decisione: D-7, registrata in [head-sixteen-parity-closeout](../../../../Modules/Cms/docs/stories/head-sixteen-parity-closeout.story.md).

## Go-live gate

`python3 -I bashscripts/tools/release/go-live-gate.py --base http://127.0.0.1:8081 --skip-pest --json` (tramite `heavy-slot.sh` sotto carico). Confrontare **due giri** per id di controllo: un
rebuild o un ripristino che non cambia nessun esito e' una prova utile quanto un miglioramento. `--skip-pest` lascia `LEG-01` rosso per costruzione (una guardia saltata non e' verde).

## Trappole note

- zsh: `$p:t` e' un modificatore, non una concatenazione; quotare i glob; il `cwd` cambia fra le chiamate: usare percorsi assoluti.
- `git check-ignore -v` stampa anche le negazioni: usare `-q` e l'exit code.
- Un test che cerca una riga in un file di configurazione puo' essere verde mentre il comportamento e' rotto (falso verde): provarlo rosso su una copia.
- Dopo una sync fra le due macchine controllare che gli strumenti citati esistano ancora (il merge `1af871d0c` ne ha cancellati cinque).

## Limite attuale

Gli script usati (sweep Playwright, analisi, diff dell'head) erano locali alla sessione e **non sono versionati**: questo documento e' la specifica per riscriverli.
Promuoverli a strumento con test e' proposto nell'onda 3 del [piano di hardening](../plans/front-office-hardening-plan.md).
