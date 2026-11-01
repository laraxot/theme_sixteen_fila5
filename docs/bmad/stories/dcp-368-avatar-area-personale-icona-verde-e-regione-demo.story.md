---
id: dcp-368
title: "DCP-368: header, avatar di «Accedi all'area personale» visibile e regione «Demo»"
type: story
status: done
owner: theme:Sixteen
module: Sixteen
created: 2026-10-26
updated: 2026-10-26
tags: [bmad, story, header, design-comuni, avatar, css, json]
qmd: "header slim avatar rounded-icon icona bianca su bianco fill 22-header-shell regione Demo header.json vestito"
related:
  - ./dcp-106-header-area-personale-reale-e-pagine-collegate.story.md
  - ../header-color-contract.md
  - ../header-json-content-contract.md
issues: []
discussions: []
---

# DCP-368: avatar dell'area personale e regione «Demo»

Status: **done** (misurato su `/it`, `/it/blog`, `/it/auth/login` a 1366 e 375 px).

## Richiesta (2026-10-26)

Confrontare l'header con `italia.github.io/design-comuni-pagine-statiche/sito/homepage.html`: al posto di «Nome della Regione» scrivere
«Demo», rendere l'avatar di «Accedi all'area personale» evidente come nel riferimento, con il contenuto in `header.json` e la blade come
«vestito».

## Studio del riferimento

- Il repo `italia/design-comuni-pagine-statiche` e' un insieme di pagine **statiche d'esempio**: template Handlebars, SCSS e JS compilati da
  Webpack. L'header e' il componente `src/components/cmp-header/cmp-header.hbs` con **testo segnaposto nel template** («Nome della Regione»,
  `{Nome della Regione}`): il Comune lo sostituisce. I JSON del repo (`src/handlebars-json/`) servono a liste e card, non all'header.
- Il nostro modello e' piu' avanti: `sections/header.json` e' la fonte di ogni contenuto percepibile e `sections/header/v1.blade.php` e' il
  vestito (contratto `header-json-content-contract.md`). Un segnaposto nel JSON o nel template e' un difetto, non un default.

## Stato prima e causa

- **Regione.** La blade legge gia' `region.name` dal JSON (il nome dell'ente copre solo un nome mancante). Il JSON aveva `region.title` con
  `{Nome della Regione}` e nessun `name`, quindi il blocco non veniva stampato. Un'altra sessione ha aggiunto `"name": "Demo"` nelle 4 lingue
  (alle 20:55 UTC, risolvendo un conflitto di merge scritto nel file dallo script di sync alle 20:51: 4 blocchi `<<<<<<< .merge_file_*`, JSON non
  valido). A schermo: `<span class="d-lg-block navbar-brand">Demo</span>`, senza link perche' `config('ente.region_url')` e' vuoto
  (mai `href="#"`).
- **Avatar.** Markup identico al riferimento (`btn-icon btn-full` > `rounded-icon` > `svg.icon-primary`), CSS no. Misurato: cerchio bianco 28 px
  con icona **bianca** 18 px, cioe' bianco su bianco: un cerchio vuoto. Nel riferimento l'icona e' `rgb(0,122,82)` in un cerchio da 24 px.
  Causa: in `resources/css/app/22-header-shell.css` la regola `.btn-icon.btn-full .icon { fill:#fff !important }` (pensata per icone senza
  cerchio) colpiva anche l'icona dentro il cerchio bianco. La regola verde di `segnalazione-parity.css` perdeva per specificita'.

## Fatto

1. `22-header-shell.css`: nel blocco `.rounded-icon .icon` (stesso elemento della regola bianca ma piu' specifico) aggiunti `color` e `fill` =
   `var(--dc-header-primary)` (`#007a52`). Nessun nuovo foglio e nessuna regola `!important` a se' stante.
2. Build del tema in cartella scratch, copia additiva in `public/assets` e `manifest.json`. Senza `npm run copy`.
3. `header.json` e blade non toccati da me: «Demo» e l'etichetta «Accedi all'area personale» (da `account.label` nel JSON, `v1.blade.php:140`)
   c'erano gia'.

## Verifica

| Pagina e larghezza | cerchio | icona prima | icona dopo |
|---|---|---|---|
| `/it`, `/it/blog`, `/it/auth/login` a 1366 | bianco 28 px | `rgb(255,255,255)` | `rgb(0,122,82)` |
| stesse a 375 | bianco 28 px | `rgb(255,255,255)` | `rgb(0,122,82)` |

- Ritaglio della slim bar di `/it` accanto al riferimento: cerchio bianco con icona utente verde, etichetta «Accedi all'area personale».
- Nessun test PHP lanciato: la modifica e' solo CSS.

## Non fatto, e perche'

- Dimensioni: alle 21:05 UTC un'altra sessione ha portato cerchio e etichetta a 24 px e 16 px sulle pagine `data-dc`, come il riferimento
  (misurato: `/it` e `/it/auth/login`, icona `rgb(0,122,82)` 18 px). Non e' una mia modifica.
- Pagine **senza** `data-dc`: alle 21:05 `/it/blog` non aveva `.page-content[data-dc]` e mostrava l'icona `rgb(0,64,43)` da 16 px e l'etichetta da
  15 px. E' visibile ma non identica alle altre pagine; `components/header-footer-colors.css:157-162` ha ancora la regola bianca. Non allineato.
- L'avatar dell'utente **loggato** (immagine o iniziale) non e' stato controllato.

## Aperto

- Alle 21:03 UTC `22-header-shell.css` aveva altre modifiche non mie (+22/-5 righe rispetto a HEAD, nello stesso foglio): un'altra sessione
  lavora sull'header. La mia misura precede quel cambio.
- Lo script `merge_remote_repo_2.sh` rimette i marker di merge nei JSON dei contenuti a ogni sincronizzazione: causa non risolta.
- `compare-computed.mjs` mi ha dato una volta valori contraddittori (cerchio «trasparente», testo 14 px) per la stessa URL: per le misure
  usare piu' run e `explain-style.mjs`, non un solo confronto.