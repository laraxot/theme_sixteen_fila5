---
title: "Header Design Comuni: studio del riferimento, misure e decisione D35"
type: study
status: accepted
updated: 2026-10-26
tags: [bmad, second-brain, design-comuni, header, accessibility, header-json]
links:
  decision: ./decision-log.md#d35
  story: ../stories/header-footer-design-comuni-markup.story.md
qmd: "header design comuni slim region demo accedi area personale rounded-icon header.json vestito"
---

# Header Design Comuni: studio, misure, decisione

Riferimenti: [homepage statica](https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html), [repository italia/design-comuni-pagine-statiche](https://github.com/italia/design-comuni-pagine-statiche).

## Filosofia del repository italia

- E' un **kit di riferimento**, non un prodotto: Handlebars + SCSS + Webpack. Le pagine (`src/pages/sito/*.hbs`, `src/pages/servizi/*.hbs`) sono composizioni di partial (`src/components/cmp-*/`), ognuno con il suo `.hbs` e il suo `.scss`.
- **Markup fedele, contenuto separato**: il markup e' validato per accessibilita' e usa solo classi Bootstrap Italia. I contenuti di lista (card, accordion, FAQ, step) stanno in `src/handlebars-json/*.json`; nell'header i testi sono segnaposto volutamente finti ("Nome della Regione", "Il mio Comune") che chi adotta il kit sostituisce.
- **Poco stile proprio**: `_comuni-custom.scss` e `_variables.scss` ritoccano solo i colori (slim `#00402b`, primario `#007A52`, testo bianco al hover del primario). Forma, spaziature e icone sono quelle di Bootstrap Italia.
- **Icone**: sempre lo sprite `bootstrap-italia/dist/svg/sprites.svg#it-*`, con `icon-primary` o `icon-white` che scelgono il colore.
- **Variabilita' minima**: il partial `cmp-header` ha solo due interruttori, `{{#if logged}}` (menu utente al posto di «Accedi all'area personale») e `{{#if home}}` (titolo del link alla home). Tre fasce: slim (regione, lingua, area personale), centro (brand, social, ricerca), navbar.
- `data-element` (ad esempio `personal-area-login`) sono ganci per prove e monitoraggio, non per lo stile.

Per noi: la **Blade e' il vestito** (markup del riferimento, nessun testo), `sections/header.json` e' il **contenuto** (per lingua), `config('ente')` (GetEnteDataAction, DCP-289) e' il dato reale del tenant che vince sul valore dimostrativo.

## Differenze misurate (riferimento, prima, dopo)

"Prima" e' lo stato misurato alle 20:50 del 2026-10-26, cioe' con un primo giro di modifiche di un'altra sessione (disco 28px con bordo bianco); header.json aveva i marcatori di merge e la regione non appariva.

| Misura (1440 px) | Riferimento | Prima | Dopo |
|---|---|---|---|
| Voce regione | `a.navbar-brand` "Nome della Regione" | assente (JSON non valido) | `span.navbar-brand` "Demo", testo, 14px/400 |
| Pulsante | 251x48, fondo #007a52, 16px/600 | 254,5x48 | 251x48 |
| Cerchio `.rounded-icon` | 24x24, bianco, raggio 12px | 28x28, bordo 2px bianco | 24x24, bianco, raggio 12px |
| Icona `it-user` | 18x18, fill #007a52 | 18x18, fill bianco (invisibile sul bianco) | 18x18, fill #007a52 (5,38:1) |
| Etichetta | 16px/600, 171 px, da lg | 15px/600, 161 px | 16px/600, 171 px |
| Spazio cerchio/etichetta | 8 px | 18 px (gap 10 + margin 8) | 8 px |
| Fondo al hover | rgb(0,99,66) | rgb(0,150,106), testo 3,8:1 | rgb(0,99,66), testo 7,3:1 |

A 375 e 768 px il cerchio e l'icona hanno le stesse misure (24 e 18 px). Il pulsante e' 48x48 (riferimento: 40x51 a 375 e 56x56 a 768): resta 48 per il target >= 44x44 e per il contratto DCP-125. Differenze note e non toccate: peso della voce regione 600 sotto 992 px (riferimento 400), bottone lingua con fondo e raggio 4px (riferimento trasparente, 71x36), margine sinistro della voce regione (24 contro 30 a 375, 48 contro 36 a 768).

## Decisione

Vedi [D35](./decision-log.md): "Demo" in `region.name` (4 lingue), testo non cliccabile, vince l'ente se presente; avatar con le misure del riferimento; hover #006342.

## Verifica

- `HeaderSlimBarContractTest`: Demo come `span` senza `href` in 4 lingue, ente che vince (anche `aria-label` e `title`), markup del pulsante, nome accessibile da `account.label`.
- Misure con Playwright (getBoundingClientRect e stili calcolati) a 375, 768 e 1440 px, in it, en, de, es: nessun overflow, testo 5,38:1, icona 5,38:1.
- Non verificato: lettori di schermo reali.
