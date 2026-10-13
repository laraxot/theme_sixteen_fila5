---
id: dcp-132
title: "DCP-132: dichiarazione di accessibilita' e meccanismo di feedback"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "dichiarazione accessibilita legge 4 2004 art 3-quater feedback difensore civico digitale agid form wcag footer"
related: [dcp-112, dcp-131, dcp-143]
---

# DCP-132: dichiarazione di accessibilita' pubblicata, con feedback

Nata da DCP-112 (matrice interfaccia I-01).

## Lacuna e prova (2026-10-13)
- Il link «Dichiarazione di accessibilita'» del footer (`/accessibilita`) risponde 404; con prefisso `/it/accessibilita` pure.
- Esiste il componente `Themes/Sixteen/resources/views/components/municipal/accessibility-statement.blade.php`, mai usato (grep: solo documenti lo citano), con valori d'esempio: `accessibilita@comune.example.it`, `https://form.agid.gov.it/view/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx`, «Parzialmente conforme» e una lista di contenuti non accessibili inventata.
- Nessun meccanismo di feedback sull'accessibilita': l'unico elemento di gradimento e' il widget «Quanto sono chiare le informazioni su questa pagina?» (presente su `/it/tickets` e nelle repliche `tests.*`, assente su `/it` e sulle FAQ), che non raccoglie difetti di accessibilita' ne' rimanda alla procedura dell'art. 3-quinquies (curl, grep su `lang/it/navigation.php`).

## Norma (testo letto, registro fonti 03)
L. 9.1.2004 n. 4 art. 3-quater: la dichiarazione e' «particolareggiata, esaustiva e chiara»; comprende le parti non accessibili con motivazione, «la descrizione del meccanismo di feedback, e relativo link», e «il link alla procedura di cui all'articolo 3-quinquies cui e' possibile fare ricorso in caso di risposta insoddisfacente o di mancata risposta, nel termine di trenta giorni»; «e' fornita in un formato accessibile ed e' pubblicata sul sito web del soggetto erogatore». Il modello e' definito con le linee guida (art. 11). Ruolo di AgID e del difensore civico digitale: art. 3-quinquies.

## Requisiti
1. Pagina `/{lang}/accessibilita` (it, en, de, es) con i contenuti obbligatori; i valori veri (esito dell'audit, parti non accessibili, contatto) vengono dall'audit DCP-143 e dall'ente, non dal componente d'esempio.
2. Meccanismo di feedback funzionante (modulo o email dell'ente) con risposta entro 30 giorni dichiarata e link alla procedura dell'art. 3-quinquies.
3. Il componente d'esempio viene riusato con dati del tenant o archiviato (non cancellato) con nota; nessun valore `example.it` o `xxxxxxxx` nel runtime.
4. Link dal footer (DCP-131) e dalla pagina di login/registrazione.
5. Data di pubblicazione e di ultimo aggiornamento visibili; la scadenza annuale e il modello AgID si leggono nel registro fonti 03.

## Criteri di accettazione
- [ ] `curl` `/{it,en,de,es}/accessibilita` = 200; la pagina contiene link di feedback e link alla procedura; `grep -c 'example.it\|xxxxxxxx'` sull'HTML = 0.
- [ ] Il modulo di feedback invia una segnalazione provata con un test (email o record) e conferma all'utente.
- [ ] axe senza violazioni serious/critical; il documento e' navigabile da tastiera.
- [ ] Lo stato di conformita' dichiarato coincide con l'esito dell'audit DCP-143 (nessuna dichiarazione "conforme" senza audit).

## Dipendenze e priorita'
DCP-143 (audit), DCP-131 (footer), dati dell'ente (DCP-133). P0: la dichiarazione e' un obbligo di pubblicazione.
