---
id: dcp-10
title: "DCP-10: accesso-servizio (SPID/CIE login) a 90% HTML / 97% visual"
type: story
epic: dc-parity-v2
status: review
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-10: accesso-servizio 90% html 97% visual bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-10: Accesso Servizio (SPID/CIE + Altre utenze)

## Scelta pagina riferimento
`https://italia.github.io/design-comuni-pagine-statiche/servizi/accesso-servizio.html` (reference verificata a 375/768/1440 px). Il contenuto locale è `tests.accesso-servizio.json`, con slug CMS completo `tests.accesso-servizio`; il file è risolto dalla route Folio generica `tests/[slug].blade.php`.

## Struttura riferimento
- Breadcrumb (Accesso area riservata)
- Hero (# Accedi + descrizione accesso via SPID/CIE/Altro)
- SPID (titolo + descrizione + SVG + link attivazione)
- CIE (titolo + descrizione + SVG + link richiesta)
- Altre utenze (ID azienda / dipendente)
- Contatti (FAQ, assistenza, n. verde 050505, prenotazione)
- Cerca (form)
- Suggerimenti collegati

## Componenti necessari
- `components/blocks/access-method-card/default.blade.php` (SPID, CIE, Altre utenze)
- `components/blocks/search-form/default.blade.php`
- `components/blocks/contacts/default.blade.php`
- `components/blocks/suggestions/default.blade.php`
- `components/blocks/breadcrumb/default.blade.php` (riutilizzato)

## Correzioni applicate
- Corretto lo slug JSON da `accesso-servizio` a `tests.accesso-servizio`; prima la route rispondeva 200 ma il CMS non trovava la pagina e rendeva un body vuoto.
- Eliminato il view path inesistente `access-method-card.default` tramite creazione della directory canonica `default.blade.php` (stesso contratto `BlockData`).
- Resi JSON-driven access methods e contatti; la ricerca e i suggerimenti restano nella sezione globale `search-modal`, come nella reference, non nel `<main>` della pagina; aggiunti SVG locali SPID/CIE senza CDN.
- Aggiunta una regola CSS isolata alla pagina per la geometria Design Comuni, responsive e focus/hover leggibili.

## Verifica eseguita
- Playwright Chromium, viewport 375/768/1440: HTTP 200, H1 `Accedi`, sezioni SPID/CIE/Altre utenze/contatti presenti, immagini locali caricate, console senza errori locali, nessun overflow orizzontale.
- La parity percentuale non viene dichiarata senza un diff metrico DOM/pixel; il confronto screenshot è salvato in `/tmp/accesso-servizio-local-fixed-{375,768,1440}.png` e `/tmp/accesso-servizio-ref-{375,768,1440}.png`.

## Stack
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament (NO Bootstrap Italia). Token `#007A52`.
