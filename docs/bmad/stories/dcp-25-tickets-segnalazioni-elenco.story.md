---
id: dcp-25
slug: dcp-25-tickets-segnalazioni-elenco
epic: dc-parity-v2
status: review
priority: P0
qmd: "design comuni parity dcp-25 tickets segnalazioni"
document_type: epic-story
title: "DCP-25: tickets (segnalazioni-elenco) reale — alta visual parity"
links:
  github_issue: #25
owner: Themes/Sixteen + Modules/Fixcity
updated: 2026-10-13
related:
  - ../public-ticket-listing-visual-contract.md
  - ../../../../../Modules/Fixcity/docs/bmad/public-ticket-listing-experience.md
  - ../../../../../Modules/Fixcity/docs/wiki/concepts/segnalazioni-elenco-blocks.md
type: story
tags: [docs, sixteen, bmad]
---

## Scopo e modello di accesso

`/it/tickets` è la pagina reale CMS `tickets.index`, non una preview `/tests`.
Serve a consultare le segnalazioni pubbliche, includere quelle proprie per gli
utenti autenticati, filtrarle su mappa o lista e avviare una nuova segnalazione.
Guest e utenti autenticati usano la stessa pagina: la query applica la visibilità
pubblica e, per l'utente corrente, aggiunge solo i suoi ticket privati.

La composizione canonica è `ticket_list` →
`pub_theme::components.blocks.ticket-layout.layout`; la logica dati resta in
`Modules/Fixcity/app/ViewModels/TicketLayoutViewModel.php`.
Non creare una Blade dedicata a `/it/tickets`.

## Ownership e stack

- Fixcity: query, policy di visibilità, stati, filtri, paginazione, GeoJSON e URL.
- Sixteen: markup, responsive layout, CTA, contatti, rating e comportamento.
- JSON CMS: contenuti editoriali, breadcrumb, tab, CTA e contatti.
- UI: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite; Bootstrap Italia non è
  una dipendenza runtime.

## Contratti funzionali

- Mappa `map-lit` con `/api/tickets/geojson`, filtri `types[]`/`statuses[]` e
  fallback esplicito quando il dataset pubblico è vuoto.
- Tab Mappa/Elenco con `role="tab"`, pannelli distinti e stato Alpine coerente.
- Sidebar desktop; modale filtri mobile con Escape e focus visibile.
- Card elenco con categoria, posizione, descrizione, immagini eventuali e stato
  vuoto localizzato; paginazione preserva i filtri.
- CTA localizzata verso `/tickets/create`, contatti reali e rating accessibile.
- Nessuna email, password o identità privata deve essere scritta in HTML,
  documentazione o fixture; il nome dell'utente autenticato proviene dalla sessione.

## Responsive e multilingua

Verificare 320, 375, 390, 768, 1024 e 1440 px senza overflow orizzontale.
Su mobile i filtri sono nella modale; su desktop la colonna filtri è visibile.
Verificare italiano e inglese: copy, aria-label, tab, filtri, CTA, contatti,
stato vuoto e URL devono mantenere la lingua corrente. `de`/`es` sono dichiarate
nel titolo CMS ma richiedono cataloghi `content_blocks` prima di essere dichiarate
supportate.

## WCAG 2.2 AA / normativa

Verificare heading unico, landmark, label associate, nome accessibile della mappa,
tab con `aria-controls`/`aria-selected`, pannelli con `aria-labelledby`, focus,
contrasto, target touch, Escape e stato vuoto annunciato. Il riferimento normativo
è Legge 4/2004 e WCAG 2.2 AA; la parità visiva non deve sacrificare privacy,
accessibilità o correttezza dei dati.

## Acceptance criteria

1. `/it/tickets` risolve `tickets.index.json` e il blocco `ticket_list` senza
   query nella Blade root.
2. Guest vede solo ticket pubblici; autenticato vede ticket pubblici e propri,
   mai ticket privati di altri utenti.
3. Tab, filtri desktop/mobile, mappa, lista, CTA e contatti funzionano senza
   JavaScript Bootstrap e senza ID duplicati.
4. Non esiste overflow orizzontale alle viewport definite; la colonna desktop
   resta separata dal contenuto principale.
5. IT/EN non espongono chiavi di traduzione raw e gli URL interni sono localizzati.
6. Screenshot reference/local, DOM body, console e rete sono raccolti per ogni
   viewport; non dichiarare percentuali senza evidenza.
7. HTML body ≥90% e visual parity ≥97% sui blocchi confrontabili con
   `sito/segnalazioni-elenco.html`; differenze deliberate (dati reali, mappa
   interattiva e footer del Comune) sono registrate nel report.

## Verifica ripetibile

```bash
cd laravel/Themes/Sixteen && npm run build
curl -I http://192.168.1.40:8000/it/tickets
```

Con Playwright acquisire screenshot a 375×900, 768×1000 e 1440×1200, controllare
`.ticket-layout-grid`, `#block-map`, `[role="tab"]`, un solo pannello visibile,
assenza di errori console e `scrollWidth <= clientWidth`. Eseguire anche axe/WCAG
su guest e autenticato. I test PHPUnit esistenti richiedono il database di test
`fixcity_user_test`, quindi un loro fallimento per database mancante non è prova
di regressione della pagina.

## Stato della correzione

La view attiva e i partial ticket sono stati portati a composizione Tailwind +
Alpine; il filtro Lit mantiene un fallback catalogo a conteggio zero; il ViewModel
mantiene ownership dei dati. La build Vite è passata il 13/10/2026 e i controlli
browser guest a 375/768/1440 hanno restituito HTTP 200, zero errori JavaScript,
zero overflow e griglia desktop `320px 864px`. La verifica autenticata e il gate
percentuale finale restano da ripetere quando il dataset autorizzato è disponibile.
