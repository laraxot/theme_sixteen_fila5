---
id: dcp-126
title: "DCP-126: percorsi a due segmenti senza pagina: 404 vero al posto di 200 con main vuoto"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "soft-404 catch-all container0 slug0 folio volt ResolvePageAction 404 main vuoto"
related: [dcp-104, dcp-106, dcp-125]
tags: [docs, sixteen, bmad]
---

# DCP-126: soft-404 sui percorsi a due segmenti

## Fase BMAD
Correzione (dev) con verifica; chiude una voce rimasta aperta in DCP-104 e DCP-106 ("404 al posto del 200 vuoto").

## Difetto misurato (2026-10-13 18:30, curl)
| Percorso | Prima | Atteso |
|---|---|---|
| `/it/zzz/yyy` | 200, `<main>` vuoto | 404 |
| `/it/tickets/zzz-inesistente` | 200, `<main>` vuoto | 404 |
| `/it/tickets/DCPDEMO-01` (codice non numerico) | 200, `<main>` vuoto | 404 |
| `/it/zzz-pagina` (un segmento) | 404 | 404 (gia' corretto: `abort_if` in `pages/[container0]/index.blade.php:43`) |
| `/it/tickets/99999` (id numerico inesistente) | 404 | 404 (modulo Fixcity, `tickets/[id]`) |

Perche' conta: un 200 vuoto e' un "soft 404". I motori di ricerca lo indicizzano, il cittadino che sbaglia indirizzo non capisce l'errore e le
tecnologie assistive annunciano una pagina senza contenuto. La pagina catch-all `[container0]/[slug0]` e' montata prima delle pagine dei moduli
(vedi `FolioVoltServiceProvider`) e `ResolvePageAction` restituisce comunque uno `pageSlug` (`container.slug`) anche quando non esiste nulla.

## Correzione
`laravel/Themes/Sixteen/resources/views/pages/[container0]/[slug0]/index.blade.php`, nel `mount()` del componente Volt (si esegue solo nel ramo
non speciale: login, registrazione, traccia e dettaglio ticket hanno il loro ramo): se `ResolvePageAction` non trova un modello (`item === null`)
e non esiste una pagina CMS con quello `pageSlug`, `abort_if(..., 404)`. La pagina CMS letta una volta sola serve anche per il `layout`.
Scelta del punto: dentro `mount()` e non nel middleware `PageSlugMiddleware`, perche' li' c'e' gia' il modello dinamico (`item`) che il middleware
non conosce (rischio di 404 su pagine alimentate da un modello senza pagina CMS).

## Prove
- Test Pest `Modules/Fixcity/tests/Feature/Pages/UnknownTwoSegmentPageTest.php`: 11 verdi (404 in it/en/de/es per due percorsi; 200 per
  `tickets/track`, `tickets/confirmation`, `auth/login`). **Fallisce senza la correzione** (ripristinata la versione precedente: rosso; poi rimessa la correzione).
- PHPStan (config unica) sul test: 0 errori.
- curl dopo `view:clear`: `/it`, `/it/tickets`, `/it/tests/homepage`, `/it/tickets/confirmation`, `/it/tests/permessi-area-personale`, `/it/tickets/track`,
  `/it/tickets/29`, `/it/auth/login` = 200; `/it/area-personale/pratiche` = 302 (ospite, `auth`); i tre percorsi sbagliati = 404; nessun marcatore `|---LINE`.
- Le 7 pagine CMS a due segmenti dei JSON del tenant (`tickets.confirmation`, `tickets.create`, `area-personale.*`...) rispondono 200 o 302, nessuna 404.
- Backup della versione precedente: `scratchpad/dcp126-backup/slug0-index.before`.

## Non coperto
- Il testo della pagina 404 (stile Design Comuni, link utili, ricerca) non e' stato toccato: e' la pagina di errore standard di Laravel nel tema.
  Una pagina 404 coerente col chrome e multilingua e' un miglioramento a parte (da aprire se si vuole).
- Le pagine `/it/tests/<slug>` hanno la loro pagina Folio (`tests/[slug].blade.php`) e non passano da qui.
