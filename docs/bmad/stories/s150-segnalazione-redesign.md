---
id: s150-segnalazione-redesign
type: epic-story
title: "Segnalazione — Redesign Design Comuni (v2.4.0)"
status: active
created: 2026-10-11
updated: 2026-10-11
owner: "@team-fixcity"
priority: P0
links:
  github_issue: "#150"
  discussion: "https://github.com/org/repo/discussions/150"
  reference_segnalazione: "https://italia.github.io/design-comuni-pagine-statiche/index.html#segnalazione"
  architecture: "arc-sixteen-design-comuni-redesign"
  decision_log: "dl-sixteen-design-comuni-redesign"
tags: [docs, sixteen, bmad]
qmd: "story: segnalazione   redesign design comuni sixteen"
---

# Story: Segnalazione — Redesign Design Comuni

## Obiettivo
Riprogettare la pagina **Segnalazione** del tema Sixteen per rispettare la grafica Design Comuni v2.4.0 (sezione `segnalazione` nel riferimento statico), usando **TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite**, senza Bootstrap.

## Definizione (BMAD — 5 campi)
1. **Job utente**: Creare una segnalazione (buche, illuminazione, rifiuti, verde, altro) alla PA con posizione su mappa, foto, contatti e tracking.
2. **Inventario componenti**: Form wizard multi-step, mappa Leaflet, allegati foto, breadcrumb, skip-link, navbar Lit, footer Lit, chip categoria, bottone invio, conferma tracking.
3. **Token**: Palette Design Comuni (colori PA istituzionali, grigio neutro, accent unico), tipo Lora/Source Sans, spaziatura 8px, elevazione sm/md/lg/xl.
4. **Stati**: Default, hover, focus-visible, disabled, error (campo non valido), empty (form vuoto), loading (invio in corso), success (conferma invio).
5. **Riferimento**: `design-comuni-pagine-statiche/index.html#segnalazione`

## Requisiti (tracciabilità da Design Comuni)
- 5 step: Categoria → Posizione (mappa + indirizzo) → Dettagli (titolo, descrizione, foto) → Contatti (anonimo S/N) → Riepilogo + Invio
- Mappa interattiva con pin posizione
- Legenda categoria con icone (SVG, non Bootstrap sprite)
- Chiusura accessibile (tasto Esc su modal/finestra)
- Validazione client-side per step
- Codice riferimento tracking post-invio
- Area personale per seguire stato segnalazioni

## Stack Implementativo
- `Alpine.js` wizard (`x-data="reportWizard()"`) con `x-transition`
- `Leaflet` per mappa, `Alpine` per binding pin
- `Lit` component `<muni-report-form>` per incapsulamento
- `DaisyUI` `input`, `select`, `textarea`, `file-input`, `btn`, `badge`
- `Tailwind` utilities per layout, spacing, typography
- `MAUVE` validazione WCAG 2.1 AA post-implementazione

## Criteri di Accettazione
- [ ] Pagina visivamente fedele al reference Design Comuni (`index.html#segnalazione`)
- [ ] Nessun componente Bootstrap importato
- [ ] Tutti gli elementi interattivi hanno `:focus-visible`
- [ ] Mappa navigabile da tastiera (Leaflet a11y)
- [ ] Form valida con tutti i campi obbligatori
- [ ] Confirma invio con codice tracking
- [ ] MAUVE passa (contrast APCA ≥75 body, stati interattivi completi)
- [ ] Playwright E2E test passa (submit + confirm + tracking)

## File Coinvolti
- `laravel/Themes/Sixteen/resources/views/design-comuni/pages/segnalazione.blade.php` (nuovo / da ridefinire)
- `laravel/Themes/Sixteen/resources/js/components/muni-report-form.js` (Lit)
- `laravel/Themes/Sixteen/resources/js/stores/report-store.js` (Alpine)
- `laravel/Themes/Sixteen/docs/bmad/stories/s150-segnalazione-redesign.md`
- `bashscripts/design-comuni/audit-segnalazione.sh`

## Note
Il tema Sixteen è già Design Comuni (`resources/views/design-comuni/`). Non creare `design-comuni.blade.php` duplicato. Ragionare sulla struttura esistente (`homepage.blade.php`) e adattare la stessa logica alla pagina segnalazione.