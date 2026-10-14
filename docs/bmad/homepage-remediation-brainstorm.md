---
id: sixteen-bmad-homepage-remediation-brainstorm
slug: homepage-remediation-brainstorm
title: Brainstorm remediation homepage Sixteen
qmd: "BMAD brainstorming homepage 5 whys failure modes visual parity Design Comuni"
document_type: brainstorming
category: architecture
status: stable
source_of_truth: true
scope: [laravel/Themes/Sixteen, laravel/config/local/fixcity/database/content/pages]
type: note
updated: 2026-10-13
tags: [docs, sixteen, bmad]
---

# Brainstorm BMAD: perché la homepage diverge

## 5 Whys

1. Perché la pagina sembrava diversa? I blocchi erano stati semplificati senza
   confrontare ogni nodo della reference.
2. Perché i blocchi erano semplificati? Si è ottimizzato per “una pagina che
   funziona” invece che per il contratto visuale e semantico.
3. Perché il contratto non era applicato? Mancava una matrice obbligatoria
   reference → JSON → Blade → evidenza.
4. Perché mancava la matrice? HTML parity e pixel parity erano mescolate in
   report storici con metriche non ripetibili.
5. Perché le metriche non erano ripetibili? Non esisteva un comparatore body
   agnostico né un gate per viewport e stati interattivi.

## Reverse brainstorming: come falliremmo di nuovo

- usare la prima lettera del social come icona;
- mettere tutto in fallback Blade e lasciare JSON incompleto;
- usare `hover:underline` come stato principale;
- mostrare hamburger sempre, anche quando la navigazione desktop è visibile;
- trattare il calendario come quattro colonne senza mese e gerarchia;
- usare card bianche identiche per i siti tematici;
- misurare solo desktop e ignorare rating/menu/ricerca;
- dichiarare 97% da una screenshot senza DOM/body report.

## Contromisure selezionate

1. schema JSON esplicito per ogni elemento visuale;
2. component map con blocchi documentati e owned scope;
3. comparatore body agnostico, screenshot per tre viewport e audit WCAG;
4. test manuale da tastiera per menu, ricerca e rating;
5. review BMAD che rifiuta una story senza evidenze.

## Insight operativo

La parità non è copiare classi CSS: è preservare la relazione fra contenuto,
gerarchia, spazio, colore e azione. Ogni differenza segnalata dall'utente deve
diventare un acceptance criterion osservabile.
