---
id: dcp-203
title: "DCP-203: front office: i difetti dell'audit DCP-186 che nessuna story ancora copre"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "front office audit restanti stelle valutazione accedi per seguire openstreetmap attribuzione soft 404 ultimo aggiornamento terms note legali readme link rotti font vite"
related: [dcp-186, dcp-195, dcp-196, dcp-197, dcp-198, dcp-200, dcp-212]
tags: [front-office, sixteen, audit, ux]
---

# DCP-203: front office: i difetti dell'audit DCP-186 che nessuna story ancora copre

## Fase BMAD
Plan. La scheda per pagina e' `Themes/Sixteen/docs/compliance/03-front-office-scheda-per-pagina.md` (DCP-186). Altre story gia' prendono: pulsante Cerca e reset dei bottoni (DCP-195), ricerca interna e modale (DCP-196), esposizione per ambiente e repliche `tests` (DCP-197), menu, footer, social e segnaposto (DCP-198), compilazione dei template (DCP-212). **Qui sta il resto.**

## Da fare
- [ ] **Widget a stelle (B3, C8).** In elenco e in conferma non salva nulla ma dice «il tuo parere ci aiutera'». Proposta DEC-20: toglierlo ora; implementarlo solo dopo l'approvazione di una nuova tabella (regola del progetto).
- [ ] **«Accedi per seguire» (B10) perde la destinazione.** Il login deve riportare alla pagina del ticket (`redirectIntended`, come DCP-124); test in 4 lingue.
- [ ] **Attribuzione OpenStreetMap (A13, B4) e host non dichiarati nel selettore di layer (B5).** Aggiungere l'attribuzione ODbL sulle mappe e togliere dal selettore i fornitori non dichiarati (DEC-14).
- [x] **Soft 404 (E3) a due segmenti.** Gia' chiuso da [DCP-126](./dcp-126-soft-404-percorsi-a-due-segmenti.story.md) (`abort_if` + `UnknownTwoSegmentPageTest`). Residuo multi-segmento: vedi DCP-197 E3.
- [ ] **Data di ultimo aggiornamento su ogni pagina (DCP-167).** Regola in DEC-21 (proposta: data di ultima modifica del contenuto nel JSON della pagina); poi blocco nel layout e test in 4 lingue.
- [ ] **`terms` e `note-legali` (D1, D2).** La registrazione impone di accettare una pagina che non esiste come tale: DEC-17 (proposta: fonderle in «Termini e note legali» e collegare la registrazione). Il testo resta dell'ente (DEC-02).
- [x] **Mappa del sito (A7).** Chiuso in [DCP-198](./dcp-198-menu-footer-social-e-segnaposto-del-front-office.story.md) + `SitemapPathsGuardTest`.
- [ ] **Cookiebar duplicata (DCP-161).** C'e' una story di un'altra sessione sul footer duplicato della cookiebar, in `Themes/Sixteen/docs/stories/`: collegarla, non rifarla.
- [ ] **Font in Vite (DCP-183).** Sorgente pronto, build vivo non eseguito; il CSS vivo e' indietro di 46 classi su 10 utility rispetto ai sorgenti. Eseguire `npm run build` solo a lavoro fermo, poi misurare con `--stub-images`.
- [ ] **6 link rotti nel README della UI** (elenco nella story DCP-154, voce docs).
- [ ] **Valutazione della pagina (DCP-169).** Serve storage: DEC-20.

## Criteri di accettazione
- [ ] Ogni voce: HTTP e/o browser misurati prima e dopo, in `it`, `en`, `de`, `es`; axe senza violazioni nuove; parity a 3 viewport con il gate (`parity-gate.sh`) senza peggioramenti.
- [ ] Nessun `href="#"` introdotto; nessuna classe Tailwind non presente nel CSS compilato (controllare con grep).
- [ ] La scheda per pagina di DCP-186 aggiornata con il verdetto di ogni difetto chiuso.

## Non verificato
Produzione; lettori di schermo; foto con EXIF; l'effetto dei cambi sul gate di parity a zero foto (DCP-33) e sul CLS.
