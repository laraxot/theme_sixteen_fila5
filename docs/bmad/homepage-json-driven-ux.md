---
title: "Sixteen homepage JSON-driven UX spec"
type: ux-spec
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, ux, design-comuni]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "ux spec   homepage sixteen json-driven sixteen"
---

# UX spec — Homepage Sixteen JSON-driven

## Aggiornamento visuale 2026-10-09

La homepage ora segue una composizione civic-first: hero editoriale a sinistra,
pannello di segnale civico a destra, mappa contestuale separata, tre passaggi
senza card decorative e tracking in banda verde ad alto contrasto.

Il copy e gli URL restano nel JSON locale. Il blocco hero usa la view
components.blocks.home.hero; il blocco mappa usa ticket.map-preview. La CTA di
creazione passa dal mount CMS/Folio container0.view con container0=tickets e
slug0=create.

Contratto visivo: palette ink/verde/giallo, una sola scala di raggi, griglia
mobile esplicita, target touch minimo 44px e rispetto di prefers-reduced-motion.

## Esperienza attesa

La homepage deve comunicare subito tre azioni:

1. segnalare un problema;
2. consultare le segnalazioni su mappa/elenco;
3. tracciare una pratica.

Deve farlo con la stessa composizione di `index.blade.php.old`, ma alimentata da JSON CMS.

## Ordine sezioni

### 1. Hero con mappa

- sfondo primario;
- titolo e sottotitolo istituzionali;
- CTA primaria “Segnala un problema”;
- CTA area personale/login/registrazione;
- card mappa con `map-lit` e caption;
- link verso elenco segnalazioni.

### 2. Come funziona

Tre card numerate:

1. crea la segnalazione;
2. il comune prende in carico;
3. segui aggiornamenti e risoluzione.

Le card devono usare classi Bootstrap Italia/Design Comuni coerenti con il vecchio layout (`card card-bg`, `col-md-4`, numeri circolari).

### 3. Tracking pratica

Banda `bg-light` con titolo, testo e pulsante verso `/tickets/track`.

## Accessibilità

- un solo heading principale visibile ai lettori (`h1.visually-hidden` se necessario);
- `aria-labelledby` sulle sezioni;
- `aria-label` su `map-lit`;
- CTA con target reale, non `#`;
- focus browser visibile sui link;
- layout senza overflow a 320 px.

## Anti-pattern UX

- sezioni marketing non derivate dalla vecchia homepage;
- icone decorative che possono rompere BladeUI Icons;
- card statistiche/testimonianze/categorie se non presenti nel contratto originario;
- doppia mappa o mappa separata senza caption;
- CTA duplicate con testi discordanti.
