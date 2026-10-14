---
type: fix
slug: visual-fix-wizard-step-2
status: applicato
filosofia: il wizard non è un form qualsiasi — è un atto di responsabilità; la mappa deve essere visibile nello step dati (localizzare il danno prima di descriverlo)
scopo: correggere visuale /it/tickets/create step=form.dati-di-segnalazione (centratura, mappa geo, colori design-comuni)
funzionalita: componente segnalazione-crea.blade.php ora include mx-auto max-w-3xl + <x-geo.mappa-static> + colori emerald-100/white
norme: multilingua (label da $data), mobile (responsive), accessibilità (aria-label su mappa), privacy (dichiarazione valore pubblico), APCA contrast
zen: geo prima descrizione — il cittadino localizza prima di parlare
second-brain: kp-174d15a58ff94901b2b0df0d86b8907a (aperto, geo persistente, auth-state, multilingua)
title: "Visual Fix — Wizard Step 2 (Dati di Segnalazione)"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "visual fix   wizard step 2 (dati di segnalazione) sixteen"
---
# Visual Fix — Wizard Step 2 (Dati di Segnalazione)

Edit applicato: laravel/Themes/Sixteen/resources/views/components/blocks/tests/segnalazione-crea.blade.php
Cambiamenti: centratura (mx-auto max-w-3xl), inclusione mappa geo (SVG inline, nessun HTTPS richiesto), colori coerenti con design-comuni (#007a52 / #17324d via emerald-100/50).
Mappa funziona su http://localhost perché SVG inline — non richiede https:// esterno.
