---
id: adr-sixteen-contract-tests-follow-live-files
title: "Decisione: i test di contratto seguono i file vivi, non resuscitano il codice morto"
type: decision
status: accepted-with-review
module: Sixteen
created: 2026-11-12
updated: 2026-11-12
tags: [bmad, decisione, sixteen, test, contratti, codice-morto, mirror]
qmd: "test di contratto seguono i file vivi codice morto HeaderAreaPersonaleLinksContractTest FrontofficeRoutesAndSearchSuggestionsTest AuthLoginStyleContractTest L-15 non ripristinare"
related:
  - ../../stories/front-office-production-readiness-audit.story.md
  - ../../stories/dcp-453-ritiro-del-codice-morto-del-tema-decisione.story.md
  - ../../stories/dcp-447-tema-ricostruibile-e-guardie-contro-i-mirror.story.md
issues: []
discussions: ["https://github.com/laraxot/theme_sixteen_fila5/discussions/94"]
---

# Decisione: i test di contratto seguono i file vivi

Stato: **presa dalla sessione che ha fatto il triage (audit L-15 a), da rivedere se il PO non è d'accordo**. Non è una regola del progetto già approvata: la ricavo dal caso.

## Contesto

Dopo `e4a7e412` («header v1 unico template») e il mirror `6cb55f0d`, tre file di test puntavano a viste sparite: `HeaderAreaPersonaleLinksContractTest` (3 test), `FrontofficeRoutesAndSearchSuggestionsTest`, `AuthLoginStyleContractTest`. Erano rossi, e i 7 rossi si sommavano ai 18 di `ComuneControllerTest`.
Due strade: ripristinare i file cancellati per far passare i test, oppure far guardare ai test i file che il sito usa davvero.

## Decisione

1. **Prima si verifica che nessun codice vivo richiami il file** (grep su `Modules`, `Themes`, `routes`, test). Qui: `header/v1.blade.php` include `language-switcher`, `user-dropdown` e `personal-area-login-cta`, tutti presenti; il modal di ricerca vivo (`search-modal/design-comuni`) è guidato dal CMS (`$d('suggestions')`).
2. **Se è morto, non si resuscita per un test**: il test cambia percorso e continua a imporre gli stessi divieti sui file vivi (chiavi legacy `FrontofficeUrl::personalArea`, `ui::ui.profile`).
3. **Un test si toglie solo se il suo oggetto non esiste più e le sue asserzioni sono già altrove.** È successo una volta: «legacy header user-dropdown usa named route Folio» leggeva `components/header/user-dropdown.blade.php` (inesistente) e le sue asserzioni sul partial vivo sono già nel test «user-dropdown usa FrontofficeRoutes…».
4. **I test non si cancellano in blocco**: le regole del progetto vietano di eliminare test senza approvazione. Il cluster `ComuneControllerTest` (18 rossi) non è stato toccato oltre a togliere `RefreshDatabase`: è DCP-453, decisione DEC-70.

## Alternative scartate

| Alternativa | Perché no |
|---|---|
| Ripristinare le viste dal mirror | resuscita codice morto e il suo costo di manutenzione, per far passare test vecchi |
| Lasciare i test rossi | 25 rossi nascondono i rossi veri; il gate non si fida più della suite |
| Cancellare i file di test | proibito senza approvazione; si perde la storia dei divieti |

## Conseguenze

- Suite Sixteen Unit dopo il triage: 18 failed, 4 skipped, 432 passed (2866 asserzioni, 11 novembre), i 18 rossi tutti in `ComuneControllerTest`. Dato non rimisurato oggi.
- Una modifica di un test per cambiare solo il percorso letto va dichiarata nella story, con la prova che il file nuovo è quello vivo.
- Rischio: un test «aggiornato» può nascondere una regressione vera se il file vivo non è davvero l'oggetto del contratto. Per questo il passo 1 (grep dei chiamanti) viene prima.

## Da rivedere

Se il PO preferisce il ripristino di quei file, questa decisione si ribalta: i test tornerebbero a puntare ai vecchi percorsi. Non ho nulla di committato.
