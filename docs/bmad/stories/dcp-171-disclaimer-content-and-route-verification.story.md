---
id: dcp-171
title: "DCP-171: verifica contenuto, route e stato incompleto del disclaimer"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P0
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "disclaimer terms verifica route contenuto titolare dpo multilingua safe incomplete legal"
related: [6.12, 6.13, 6.15, 6.16]
tags: [docs, sixteen, bmad]
---

# DCP-171: verifica contenuto, route e stato incompleto del disclaimer

## Lacuna e prova

`resources/views/disclaimer.blade.php` mostra fallback come «Ente di appartenenza»,
indirizzo/email/PEC/telefono placeholder e `now()` come data di aggiornamento. La view
stampa inoltre sezioni legali tradotte senza dimostrare che identità, titolare, DPO,
canali, responsabilità, diritti e versione siano stati forniti e approvati dall'ente.
Questo è un controllo di pubblicazione, non un invito a inventare clausole.

## Criteri di accettazione

- [ ] Per ogni locale it/en/de/es è verificata la route canonica localizzata, status,
  canonical URL, title, lingua e link da footer/registrazione/segnalazione.
- [ ] Un contratto dati elenca identità del titolare, DPO, contatti, versione,
  data effettiva, data revisione, proprietario e approvazione; i campi mancanti
  producono stato incompleto esplicito, non placeholder pubblicati.
- [ ] Terms, disclaimer, privacy, cookie policy, accessibilità e note legali sono
  distinti; nessuna accettazione termini viene confusa con consenso cookie/Gdpr.
- [ ] La pagina non usa data runtime come prova di aggiornamento: mostra solo una
  data approvata dal contenuto/ente e usa `<time datetime>` localizzato.
- [ ] Test feature verificano 200/404, locale, contenuto incompleto sicuro, link
  assoluti/localizzati e assenza di `#` nei link legali.

## Dipendenze e scope

Riferimenti: `bmad-output/research-report.md`, stories 6.12–6.16 e Designers Italia
content/localization guidance. Blocked by: 6.12, 6.13, 6.15. Blocks: DCP-173.
Owned evidence: `docs/bmad/audits/disclaimer-verification.md`.
Legal copy, identità e approvazioni restano input dell'ente/DPO/legal owner.

## Strategia di verifica

Usare fixture sintetiche complete e incomplete, una per locale, verificare route e
rendering tramite feature test, scrutinio accessibile della pagina e link crawl.
Segnalare ogni campo legale mancante come blocker senza riempirlo automaticamente.

## Dev Agent Record

_(empty — to be completed by the external dev tool)_
