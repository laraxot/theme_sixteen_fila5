---
id: dcp-17
title: "DCP-17: evento-dettaglio (dettaglio di un evento)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity evento dettaglio event-detail galleria carosello dropdown popper accordion bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-17: evento-dettaglio

## Richiesta
"fa https://italia.github.io/design-comuni-pagine-statiche/sito/evento-dettaglio.html".

## Baseline (misurata prima di toccare nulla)
`tests.evento-dettaglio.json` esisteva con blocchi legacy. HTML body 52,48% (56,9% URL normalizzati); pixel 30,4 / 30,3 / 31,3 / 33,2 / 39,7% a 1920 / 1440 / 992 / 768 / 375 px; altezze 8968 contro 4425 (1440).

## Cosa e' stato fatto
1. JSON `tests.evento-dettaglio.json` (tenant e modulo) riscritto con un solo blocco `event-detail`: dati estratti dal riferimento con uno script (titolo, azioni, argomenti, immagine, indice, 10 sezioni, aggiornamento) + `feedback`/`contacts` della homepage.
2. Blocco `components/blocks/event-detail/design-comuni.blade.php`: sezioni scelte per `type` (`rich`, `text`, `place`, `schedule`, `costs`, `attachments`, `related`, `contacts`, `links`); un nuovo tipo = un nuovo `@case`. Le immagini sono URL del JSON (nel riferimento sono segnaposto esterni `picsum.photos`, `via.placeholder.com`).
3. Carosello: `dcCalendar` generalizzato in `dcCarousel` (`resources/js/theme/design-comuni-home.js`), opzioni scelte dalla classe dell'elemento come fa il riferimento (`it-calendar-wrapper` 4 colonne; `it-carousel-landscape-abstract-three-cols` 3 colonne con 2 e 1 colonne sotto 992 e 768 px).
4. Menu a tendina (Condividi, Vedi azioni): `app.js` li posiziona come Popper nel riferimento solo nelle pagine /tests (`data-popper-placement`, `style` con `transform: translate(x, y)`), con 2 px di scarto misurato. Vale anche per la tendina lingua del header (invariata a 99,89%). Accordion e indice: controller `collapse` e `dcNavscroll` esistenti.
5. Pagina aggiunta a `scripts/regenerate-design-comuni-css.sh` con gli stati dei menu e dell'accordion.
6. Non replicato: l'`onclick="listenElements(...)"` della voce "Ascolta" (sintesi vocale, funzione di `scripts.js` del riferimento che da noi non esiste: un `onclick` a una funzione inesistente darebbe un errore). Da fare come comportamento Alpine se serve.

## Risultato (misurato con `bashscripts/tools/visual/parity-gate.sh --stub-images 'picsum\.photos|via\.placeholder\.com'`)
- **HTML body 90,15% rigoroso** (>= 90) e 97,66% con URL normalizzati: qui anche gli URL delle immagini coincidono perche' sono gli stessi del riferimento.
- **Pixel 98,82 / 99,48 / 99,27 / 99,54 / 99,10%** a 1920 / 1440 / 992 / 768 / 375 px, **altezze identiche** (8968, 9108, 9420, 10650).
- Comportamenti sulla pagina intera dopo il clic: accordion trascrizione 99,46% (1440) e 99,13% (375), Condividi 99,48%, Vedi azioni 99,5%, indice -> Costi 99,42%, indice chiuso 99,48%, rating 98,77%. Carosello: 98,89 / 99,89 / 99,77% a 1440 / 768 / 375 px.
- Regressione: homepage, risultati-ricerca, appuntamento-02 ed eventi invariate (99,7-99,9%); `/it` identica (0,000%); `/it/tickets` invariata.

## Trappole incontrate (da ricordare)
- Un ritaglio con `--selector` puo' avere larghezza diversa di 1 px per arrotondamenti di 0,016 px nelle colonne e far crollare la parity di un blocco di testo (90,9%) pur essendo identico a occhio: per i comportamenti misurare con `--selector body` (pagina intera) e leggere le altezze.
- L'estrazione dei dati con espressioni regolari sul markup originale falliva per gli spazi tra i tag: lavorare sul markup con `>\s+<` -> `><` e spazi collassati.

## Come si controlla
```bash
bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/sito/evento-dettaglio.html \
  http://192.168.1.40:8000/it/tests/evento-dettaglio --stub-images 'picsum\.photos|via\.placeholder\.com' --fail-if-contains '|---LINE:'
```
