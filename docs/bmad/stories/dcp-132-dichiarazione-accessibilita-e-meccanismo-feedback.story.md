---
id: dcp-132
title: "DCP-132: dichiarazione di accessibilita' e meccanismo di feedback"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "dichiarazione accessibilita legge 4 2004 art 3-quater feedback difensore civico digitale agid form wcag footer"
related: [dcp-112, dcp-131, dcp-143]
tags: [docs, sixteen, bmad]
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

## Criteri di accettazione (stato al 2026-10-13, sera)
- [x] `curl` `/{it,en,de,es}/accessibilita` = 200; la pagina contiene link di feedback e link alla procedura; `grep -c 'example.it\|xxxxxxxx'` sull'HTML = 0. Prova: 200 x4, un `<h1>` per lingua, `href="#feedback"` (anchor della sezione «Feedback e contatti» con il modulo), link `https://www.agid.gov.it/it/design-servizi/accessibilita/procedura-attuazione` (verificato 200 il 2026-10-13: la pagina descrive la procedura che si attiva dopo una risposta insoddisfacente o mancata), `grep -c` = 0 in tutte e 4 le lingue. Il `mailto:` della casella dell'ente compare solo quando l'ente la indica: oggi non c'e' (vedi sotto).
- [x] Il modulo di feedback invia una segnalazione provata con un test (email) e conferma all'utente: `AccessibilityFeedbackFormTest` (6 test) con `Mail::fake()`: email alla casella dichiarata con reply-to del cittadino e conferma `role="status"`; validazione prima dell'invio; senza casella nessun invio e messaggio; il client non puo' scegliere il destinatario; 5 invii/ora per IP. NON provato con SMTP vero: senza la casella dell'ente non c'e' un destinatario reale.
- [ ] axe senza violazioni serious/critical; il documento e' navigabile da tastiera. axe: `/it|en|de|es/accessibilita` a 375 e 1440 px, 0 violazioni; modulo attivo (casella di prova su un tenant `eu` temporaneo, poi ripristinato) a riposo e dopo l'invio vuoto (errore), 0 violazioni; dopo l'errore il focus va al primo campo non valido. Navigazione da tastiera: solo la struttura (campi con `label`, `aria-describedby`, un'unica intestazione `<h1>`, ordine di lettura); un audit manuale con tastiera e lettore di schermo resta a DCP-143.
- [ ] Lo stato di conformita' dichiarato coincide con l'esito dell'audit DCP-143 (nessuna dichiarazione «conforme» senza audit): NON verificabile, l'audit DCP-143 non c'e' ancora. La pagina dichiara «Non ancora determinato», la verifica rifiuta `compliant` senza metodo e data della valutazione e `partially_compliant`/`non_compliant` senza l'elenco delle parti non accessibili con motivazione.

## Implementazione (2026-10-13)
- Pagina: JSON CMS `accessibilita.index.json` (4 lingue, 3 copie identiche) + blocco `components/blocks/accessibility-statement/design-comuni.blade.php`, a sezioni del modello AgID: stato di conformita', contenuti non accessibili (non conformi, onere sproporzionato, fuori ambito), redazione (metodo, data della valutazione, pubblicazione, ultimo aggiornamento, link alla dichiarazione sulla piattaforma AgID se c'e'), feedback e contatti, procedura dell'art. 3-quinquies.
- Dati dell'ente: chiave `declaration` del blocco di ogni lingua nel JSON (`status`, `evaluation.method/date`, `published_at`, `updated_at`, `feedback_email`, `agid_declaration_url`, `procedure_url`, tre liste di parti `{content, reason}`). Tutti `null` o vuoti, tranne `procedure_url` (pagina nazionale AgID, non un dato del Comune). Il test `keeps the same non-text facts in the four language blocks` impedisce che i fatti neutri divergano tra le lingue.
- Verifica: `AssessAccessibilityStatementAction` (stato valido, valutazione datata, date reali, email valida, `procedure_url` https, parti non accessibili se non conforme, nessun valore d'esempio). Senza i dati o con dati incoerenti la pagina risponde 200 e un `callout` elenca che cosa deve fornire l'ente. Guardia: `AccessibilityDeclarationPublicationGateTest` (gruppo `publication-gate`), rossa per costruzione (4 test).
- Feedback: componente Livewire `Modules\Fixcity\Livewire\AccessibilityFeedbackForm` (vista `blocks/accessibility-statement/feedback-form.blade.php`): email (`AccessibilityFeedbackMail`, testo semplice, reply-to del cittadino) alla casella `declaration.feedback_email` letta lato server a ogni invio tramite `GetAccessibilityDeclarationAction` (mai una proprieta' Livewire, che e' del client), 5 invii/ora per IP. Senza casella il modulo non e' mostrato e resta un messaggio.
- Lingue: `Themes/Sixteen/lang/{it,en,de,es}/accessibility.php` (cornice) e `Modules/Fixcity/lang/{it,en,de,es}/accessibility.php` (indicazioni per l'ente, modulo, email).
- Componente d'esempio `components/municipal/accessibility-statement.blade.php` (valori `accessibilita@comune.example.it`, `xxxxxxxx-...`, «Parzialmente conforme»): ARCHIVIATO, non cancellato, in `Themes/Sixteen/docs/bmad/archive/2026-10-13-municipal-accessibility-statement.blade.php.txt` con nota in testa. `grep -rn 'example\.it\|xxxxxxxx'` su `Modules/Fixcity/app` e `Modules/Fixcity/resources` non trova valori d'esempio (la citano solo i commenti del rilevatore); restano in altri componenti non usati del tema (`components/municipal/service-form.blade.php`, `office-map.blade.php`, `components/footer/institutional.blade.php`, `sections/footer-full.blade.php`), fuori dal perimetro di questa story.
- Link dal footer (`/{lingua}/accessibilita`, voce «Dichiarazione di accessibilita'») e dalle pagine di login e registrazione (`auth-login.blade.php`, `auth-register.blade.php`).

## Prove (comandi e output, 2026-10-13)
| Criterio | Comando | Esito |
|---|---|---|
| Pagina in 4 lingue | `for l in it en de es; do curl -s -o /dev/null -w '%{http_code} ' $B/$l/accessibilita; done` | `200 200 200 200` |
| Nessun valore d'esempio | `for l in it en de es; do curl -s $B/$l/accessibilita \| grep -c 'example.it\|xxxxxxxx'; done` | `0 0 0 0` |
| Test verifica | `pest Modules/Fixcity/tests/Unit/AssessAccessibilityStatementActionTest.php` | 18 passati |
| Test pagina | `pest Modules/Fixcity/tests/Feature/Pages/AccessibilityStatementPageTest.php` | 9 passati (4 lingue con h1, feedback e procedura; avviso con dati mancanti in 4 lingue; pagina con dati completi: stato, date «15 settembre 2026», parti, mailto, procedura) |
| Test modulo | `pest Modules/Fixcity/tests/Feature/Livewire/AccessibilityFeedbackFormTest.php` | 6 passati; con il destinatario sbagliato nel codice il test d'invio cade (1 fallito) |
| Guardia di pubblicazione | `pest ... --group=publication-gate` | 4 falliti per costruzione: «Dichiarazione di accessibilita' (it) NON pubblicabile. Da fornire: Stato di conformita' (missing); Metodo e data della valutazione (missing); Data di pubblicazione (missing); Data dell'ultimo aggiornamento (missing); Indirizzo per le segnalazioni (missing)» |
| PHPStan | `./vendor/bin/phpstan analyse <file toccati> --no-progress --error-format=raw` | 0 errori su 5 classi e 4 file di test |
| axe, pagine | `node bashscripts/tools/visual/a11y-page-probe.mjs $B/<lingua>/accessibilita` | 0 violazioni (it, en, de, es; 375 e 1440 px); idem `/it/note-legali`, `/it/media-policy` |
| axe, modulo attivo | sonda Playwright + axe su `php -S` con tenant `eu` e JSON temporaneo (poi ripristinato, md5 verificato) | 0 violazioni a riposo e con errore di validazione; focus sul primo campo non valido |

## Cosa serve dall'ente (nessun valore e' inventato dal codice)
Stato di conformita' (dall'esito dell'audit DCP-143), metodo e data della valutazione, date di pubblicazione e ultimo aggiornamento (riesame ogni anno), casella email che riceve le segnalazioni, parti non accessibili con motivazione, eventuale link alla dichiarazione compilata sulla piattaforma AgID. Conferma che la procedura indicata (`.../accessibilita/procedura-attuazione`) e' quella voluta. Va compilato per ogni lingua in `accessibilita.index.json` (chiave `declaration`), nelle 3 copie.

## Dipendenze e priorita'
DCP-143 (audit), DCP-131 (footer), dati dell'ente (DCP-133). P0: la dichiarazione e' un obbligo di pubblicazione.
