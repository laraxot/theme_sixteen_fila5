# Domande frequenti parity

Percorso pagina locale: `/it/tests/domande-frequenti`

Riferimenti:
- [Indice tema](../../../INDEX.md)
- [Screenshot reference top](./reference-top.png)
- [Screenshot locale top](./local-top-after.png)
- [Screenshot reference full](./reference-full.png)
- [Screenshot locale full](./local-full-after.png)

## Confronto strutturale

La pagina locale non era equivalente alla reference almeno nel blocco centrale `<main>`.
Header, footer e search modal erano gia vicini; la differenza stava nella porzione FAQ.

Reference:
- breadcrumb dentro `.cmp-breadcrumbs`
- hero bianco con `h1` molto grande e testo descrittivo
- search FAQ centrata
- un unico accordion FAQ lungo
- sezione feedback/rating su fondo blu
- sezione contatti su fondo grigio

Locale prima del fix:
- blocchi JSON separati (`breadcrumb`, `hero`, due `accordion`, `cta`)
- hero dark e testo troppo piccolo
- accordion spezzato per categoria e layout differente
- assenti rating e contatti nel `main`
- non comparabile oltre il 90% nel body/main

## Approccio applicato

Vincolo rispettato: intervento solo su CSS e JS del tema `Sixteen`, senza introdurre Bootstrap Italia runtime.

Modifiche eseguite:
- `resources/js/domande-frequenti-parity.js`
  - attiva solo su `/it/tests/domande-frequenti`
  - estrae le FAQ gia renderizzate dai blocchi esistenti
  - ricostruisce il contenuto del `<main>` in struttura piu vicina alla reference
  - aggiunge search/filter, accordion custom, rating e contatti
- `resources/css/faq-parity.css`
  - definisce il layer visuale dedicato alla FAQ
- `resources/js/app.js`
  - importa ed esegue il modulo parity
- `resources/css/app.css`
  - importa il foglio `faq-parity.css`

## Build e verifica

Comandi eseguiti da `laravel/Themes/Sixteen`:
- `npm run build`
- `npm run copy`

Bundle finale verificato in pagina:
- CSS: `app-BlpyE4De.css`
- JS: `app-BC8cTqIx.js`

Verifiche runtime:
- `body.dc-faq-parity` presente
- search FAQ presente
- accordion FAQ presente con 19 item
- blocco rating presente
- blocco contatti presente

## Gap residui

La parte alta e il flusso centrale sono ora molto piu vicini alla reference.
Restano differenze secondarie nei dettagli del micro-layout:
- peso/kerning del titolo
- spaziatura fine di breadcrumb e search
- styling delle singole righe accordion e icona di espansione
- contenuto rating semplificato rispetto alla reference
- contenuto contatti semplificato rispetto alla reference

Per allineamento finale al pixel conviene il passo successivo:
1. rifinire solo `faq-parity.css`
2. fare screenshot desktop + mobile
3. correggere spaziature/misure confrontando reference/local affiancati

## Pass 2 - Screenshot-guided refinements

Refinements applicati dopo confronto diretto tra `reference-top.png` e `local-top-after.png`:
- header page-scoped riportato a testo bianco e verde piu vicino al riferimento
- titolo hero forzato a nero puro con dimensione/peso piu vicini
- breadcrumb e search compattati e alleggeriti
- accordion con typography e spacing piu simili alla reference
- rating shell resa piu vicina alla reference con stelle vere e card piu compatta
- contacts shell semplificata con icone e spaziature piu coerenti

File toccati nel pass 2:
- [../../../resources/css/faq-parity.css](../../../resources/css/faq-parity.css)
- [../../../resources/js/domande-frequenti-parity.js](../../../resources/js/domande-frequenti-parity.js)
