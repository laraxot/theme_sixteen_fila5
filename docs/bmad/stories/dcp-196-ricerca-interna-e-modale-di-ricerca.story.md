---
id: dcp-196
title: "DCP-196: la ricerca interna non ha funzione e la modale di ricerca in home non e' cliccabile"
type: story
epic: dc-parity-v2
status: open
priority: P1
owner: theme:Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "ricerca interna cerca nel sito modale pointer-events none autocomplete-two suggerimenti servizi non erogati risultati ricerca dcp-166 sitemap"
related: [dcp-186, dcp-166, dcp-07]
tags: [docs, sixteen, bmad, ricerca, front-office]
---

# DCP-196: la ricerca del sito

## Fase BMAD
Plan. Nata dall'audit [DCP-186](./dcp-186-front-office-scopo-e-senso-di-ogni-pagina-ed-elemento.story.md), gruppo A (voci A3 e A4). Si somma a [DCP-166](./dcp-166-ricerca-interna-sitemap-canonical-e-hreflang.story.md), che ha come obiettivo la ricerca interna e non e' stata fatta.

## Scopo
Il campo «Cerca nel sito» c'e' su ogni pagina (header e modale). Le linee guida di design della PA lo prevedono per i siti istituzionali. Oggi non porta da nessuna parte.

## Stato misurato (gruppo A, MISURATO dall'agente, non rimisurato dal coordinatore)
- Il form non ha `action`: fa un GET sulla stessa pagina (`?autocomplete-two=...`) e non produce risultati. `/search`, `/cerca` e `/ricerca` rispondono 404.
- I 6 suggerimenti della modale sono `href="#"` e riguardano servizi che FixCity non eroga (CIE, tributi, tessera elettorale, cambio di residenza, appuntamenti, voucher).
- **A4:** in home la modale non e' cliccabile: `.modal-content` ha `pointer-events: none` e il clic sull'input finisce sull'hero (su `/tickets` e' `auto`). Il campo resta vuoto.
- La replica `/it/tests/risultati-ricerca` esiste (parita' visiva col riferimento), ma e' una vetrina, non la ricerca reale.

## Cose da fare
- [ ] Decidere cosa si cerca (D196-1) e cosa non si deve cercare (D196-2).
- [ ] Rotta e pagina dei risultati nelle 4 lingue, con `<title>`, `h1` unico e `noindex` sulle pagine di risultato.
- [ ] Il form della modale e dell'header punta a quella rotta; la modale riceve il focus e il clic (togliere `pointer-events: none` solo dove non serve, e spiegare in un commento perche' c'era).
- [ ] Togliere i 6 suggerimenti segnaposto oppure sostituirli con voci vere (le pagine di FixCity: «Segnala un disservizio», «Elenco segnalazioni», «Segui una segnalazione», «Domande frequenti», «Privacy»).
- [ ] Test: risultati per una parola nota in ciascuna lingua; zero risultati con messaggio utile; XSS sulla stringa cercata (escape).
- [ ] Throttle sulla rotta (decisione D196-3) e nessun dato personale nei log di ricerca.
- [ ] Aggiornare DCP-166 e la matrice di interfaccia (I-17).

## Decisioni da prendere
| ID | Domanda | Opzioni | Raccomandazione | Chi decide | Blocca |
|---|---|---|---|---|---|
| D196-1 | Qual e' il perimetro della ricerca? | (a) solo le pagine del sito e le FAQ; (b) anche le segnalazioni pubbliche; (c) nessuna ricerca: togliere il campo | (a) piu' le segnalazioni pubbliche per indirizzo e titolo, che hanno gia' la ricerca di `/tickets` (DCP-150): un solo motore; (c) se non c'e' tempo, perche' un campo che non funziona e' peggio di nessun campo | prodotto | tutto il resto |
| D196-2 | Si indicizzano testo libero e indirizzi dei cittadini? | si' / no | no per i campi non gia' pubblici; si' solo per cio' che `isVisibleOnPublicFrontoffice()` gia' espone | titolare e DPO | D196-1 (b) |
| D196-3 | Limite di richieste | nessuno / simile a `tickets/track` (10 al minuto) | un limite largo (es. 30 al minuto per IP), perche' la ricerca non e' un token | sviluppo | rotta |
| D196-4 | I servizi non erogati dei suggerimenti | togliere / lasciare come «prossimamente» | togliere: una voce che non porta a niente inganna (vedi anche i servizi `#` della home, DCP-198) | prodotto | modale |

## Criteri di accettazione
- [ ] Da home e da `/tickets` la ricerca restituisce una pagina di risultati in it, en, de, es, con test.
- [ ] La modale e' cliccabile e raggiungibile da tastiera (Esc la chiude, il focus ritorna al pulsante).
- [ ] Nessun suggerimento con `href="#"`.
- [ ] Nessuna richiesta a terzi; il testo cercato e' escapato.

## Owned File/Module Scope
- `laravel/Themes/Sixteen/resources/views/components/sections/search-modal.blade.php`
- `laravel/Themes/Sixteen/resources/views/pages/**` (rotta e pagina dei risultati)
- `laravel/Themes/Sixteen/lang/*/` (testi della ricerca, 4 lingue)
- `laravel/Themes/Sixteen/tests/**` (test della ricerca)

## Non verificato
Il perche' di `pointer-events: none` in home (regola ereditata dal riferimento o difetto); l'effetto sulla modale di eventuali script di Bootstrap Italia.
