---
id: dcp-174
title: "DCP-174: pagamenti tramite PagoPA e piattaforme abilitanti (Linee guida design 4.6.3)"
type: story
epic: dc-parity-v2
status: needs-decision
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "pagamenti pagopa linee guida design 4.6.3 piattaforme abilitanti cad art 5 art 62 servizi pagamento"
related: [dcp-21, dcp-163, dcp-173]
tags: [docs, sixteen, bmad]
---

# DCP-174: pagamenti tramite PagoPA e piattaforme abilitanti (Linee guida design 4.6.3)

## Lacuna e prova
Le pagine di pagamento esistono (DCP-21, `servizi-pagamento-*`, stato done) e riproducono il riferimento
visivo. Non esiste una story che verifichi il requisito normativo delle Linee guida 4.6.3: i pagamenti
dei servizi della PA devono passare dalle piattaforme abilitanti (PagoPA) e non da canali propri.
Nel repository i riferimenti a PagoPA compaiono solo come pagine statiche (DCP-21, DCP-28, DCP-29, DCP-120),
non come integrazione verificata. Nessun intermediario o avviso PagoPA risulta configurato.

## Norma
Linee guida di design per i servizi web della PA, cap. 4.6 «Piattaforme abilitanti» (versione corrente,
`docs.italia.it/italia/design/lg-design-servizi-web/it/versione-corrente/`);
CAD art. 5 (pagamenti con modalità elettroniche) e art. 62 (ANPR e PagoPA: piattaforma nazionale dei pagamenti).

## Requisiti
1. Mappa di ogni servizio della vetrina che richiede un pagamento: importo, causale, canale di incasso.
2. Per ciascun servizio: conferma che il pagamento passa da PagoPA (avviso o checkout) oppure elenco
   motivato dell'eccezione, da sottoporre al legale dell'ente.
3. Nessun dato di pagamento (IBAN, carte) raccolto dal sito; il sito riceve solo l'esito.
4. Testo di pagina coerente con l'esito (pagato, annullato, in attesa) in it/en/de/es.

## Criteri di accettazione
- [ ] Tabella servizio → canale di pagamento compilata e firmata dall'ente (non dal codice).
- [ ] Nessun campo di pagamento nel repository che raccolga dati di carta o IBAN.
- [ ] Gli stati di esito sono verificati in test (pagato, annullato, in attesa) e localizzati.
- [ ] La story DCP-173 riceve la prova per il requisito 4.6.3.

## Dipendenze e priorità
Decisione: intermediario PagoPA e canale per ogni servizio (needs-decision, owner: ente).
Dipende da DCP-21 (flusso servizi) e alimenta DCP-173. P1.

## Dev Agent Record
_(vuoto — da completare dallo sviluppatore)_
