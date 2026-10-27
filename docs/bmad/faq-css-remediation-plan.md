---
title: "Piano BMAD — FAQ CSS riusabile e stack Tailwind"
type: plan
status: partially-superseded
superseded_by: ./stories/dcp-260-faq-composizione-blocchi-condivisi.story.md
theme: Sixteen
created: 2026-10-20
tags: [bmad, ux, css, tailwind, alpine, faq, design-comuni, filament-blueprint]
links:
  design_reference: https://github.com/italia/design-comuni-pagine-statiche
  shell_contract: ./container0-index-shell-contract.md
  filament_blueprint: ./filament-blueprint.md
updated: 2026-10-20
qmd: "obiettivo sixteen"
---

> **Esito (2026-10-20, [DCP-260](./stories/dcp-260-faq-composizione-blocchi-condivisi.story.md), D23).** La diagnosi di questo
> piano regge (CSS di pagina, `faq-parity.css` morto, ADR-FAQ-01/04/05). La **strada di implementazione no**: **ADR-FAQ-02
> («utility Tailwind direttamente sul markup») è superata per le pagine `data-dc`**, dove la shell mette sempre `data-dc` e
> `postcss/isolate-legacy-important.cjs` spegne ogni utility (misurato: `text-xl` → 40px, `max-w-[720px]` → 1280px, `h-8 w-8` → 0×0
> con le classi presenti nel CSS servito). La FAQ è stata invece ricomposta con i blocchi condivisi `content-page` (replica già a
> 99,31% di parity HTML; la pagina scritta a mano era all'11,59%), senza nuovo CSS e con 700+ righe di CSS morto rimosse. Le Fasi 2–3
> qui sotto sono quindi **eseguite in altra forma**; restano valide la Fase 4 (QA) e i task T1–T6 della story.

# Obiettivo

Correggere la pagina FAQ senza aggiungere un altro strato di CSS speciale per
`domande-frequenti`. Il risultato deve mantenere la grammatica visiva di
Design Comuni, ma avere un'implementazione nativa dello stack Sixteen:

- Tailwind CSS come linguaggio di stile principale;
- Alpine per stato locale e interazioni;
- Lit solo se serve un comportamento condiviso già esistente;
- DaisyUI/Flowbite solo per primitive già installate e compatibili;
- Bootstrap Italia esclusivamente come riferimento visuale e tipografico,
  mai come runtime CSS/JS o come contratto di comportamento.

## Diagnosi

La soluzione attuale confonde tre livelli diversi:

1. `main[data-page="domande-frequenti"]` usa il routing della pagina per
   correggere lo stile del componente. Questo rende il CSS non riusabile e fa
   sì che la stessa ricerca o lo stesso accordion abbiano comportamenti diversi
   a seconda dell'URL.
2. La view contiene uno `<style>` inline con override `!important` su classi
   semantiche del riferimento (`cmp-input-search`, `cmp-accordion`,
   `accordion-button`). È una seconda implementazione locale del design system.
3. `resources/css/faq-parity.css` contiene circa 700 righe di regole storiche
   sotto `body.dc-faq-parity`, molte delle quali non sono usate dal markup
   attuale. Tenerle in bundle crea peso, ambiguità e regressioni future.

Il template ufficiale di riferimento conferma il senso corretto: la pagina
compone `cmp-input-search`, `cmp-accordion-faq`, rating e contatti; non definisce
una famiglia di selettori `main[data-page=...]`. In Sixteen il contenuto resta
nel blocco CMS `faq-page`, mentre la presentazione deve vivere in primitive
riusabili del tema.

# Contratto architetturale (BMAD)

## ADR-FAQ-01 — Il componente non conosce l'URL

Il blocco FAQ deve funzionare anche se montato in una pagina diversa o più volte
nella stessa pagina. Nessuna regola CSS può dipendere da `main[data-page]`,
`body.dc-faq-parity`, dallo slug, dal nome della route o da un id globale della
pagina.

Sono consentiti:

- classi del componente (`dc-faq`, `dc-faq__search`, `dc-faq__item`);
- classi semantiche condivise (`cmp-input-search`, `cmp-accordion`), se il loro
  contratto è globale e non viene sovrascritto localmente;
- utility Tailwind direttamente sul markup;
- selettori CSS di un componente condiviso, mai selettori di una pagina.

## ADR-FAQ-02 — Preferire utility e primitive alla nuova stylesheet (SUPERATA su pagine `data-dc`, vedi D23)

Il primo tentativo deve essere markup con utility Tailwind e primitive già
presenti. Si crea o si mantiene una regola CSS solo quando Tailwind non esprime
in modo affidabile il comportamento cross-browser (ad esempio il marker nativo
di `summary`) o quando la stessa regola è condivisa da più consumer.

Non si introducono nuove varianti di colore, breakpoint, ombre o componenti
DaisyUI per replicare un dettaglio del riferimento. I token esistenti del tema
sono la sola fonte dei valori cromatici e tipografici.

## ADR-FAQ-03 — HTML nativo per l'accordion, Alpine solo per il filtro

`details/summary` resta il controllo accessibile per aprire una risposta.
Alpine gestisce solo filtro, paginazione locale e questionario. Non si aggiunge
un accordion JS, Flowbite o un `data-bs-*`: Bootstrap Italia è reference-only.

## ADR-FAQ-04 — Il feedback è un blocco condivisibile

La valutazione FAQ non deve essere stilizzata attraverso selettori della pagina.
Il markup può usare il blocco feedback/rating esistente se il suo contratto
copre rating, stati e accessibilità; altrimenti si estrae solo la parte minima
con un nome di componente neutro e dati passati dal CMS. Non si copia il
questionario in altre pagine.

## ADR-FAQ-05 — Il tema non diventa owner del dominio

Il tema continua a ricevere `title`, `intro`, `items`, contatti e URL dal blocco
CMS. Nessun testo, route, policy o action nuova entra nel CSS o nella Folio
shell. Il Filament Blueprint del tema resta N/A per Resource: eventuali widget
appartengono al modulo owner e vengono montati dal blocco JSON.

# Piano di esecuzione

## Fase 0 — Baseline e inventario (seriale)

Owner: architettura/UX.

- registrare screenshot e DOM della FAQ a 320, 375, 390, 768, 1024 e 1440 px;
- misurare overflow orizzontale, altezza del blocco hero, ricerca, accordion,
  feedback e contatti;
- inventariare ogni classe usata dal blocco e cercare tutti i consumer di
  `cmp-input-search`, `cmp-accordion`, `faq-rating-section` e contatti;
- verificare se `faq-parity.css` è davvero morto. Se un selettore ha consumer
  reali, migrare il consumer prima di eliminarlo;
- non modificare header/footer o altri blocchi nel baseline.

Exit criteria: matrice `classe → consumer → owner CSS → stato` e baseline
salvata nel report di verifica.

## Fase 1 — Contratto UX e markup (seriale)

Owner: Sixteen block component.

- rimuovere lo `<style>` inline da `components/pages/faq.blade.php`;
- sostituire i nomi ereditati da Bootstrap (`accordion-button`,
  `accordion-collapse`, `btn` dove non servono al contratto) con una struttura
  semantica del componente e utility Tailwind;
- mantenere `details/summary`, label reale per la ricerca, focus visibile,
  target minimi di 44 px e stato vuoto localizzato;
- mantenere un root di componente (`dc-faq`) e sotto-classi stabili solo dove
  servono come hook riusabili, non come identificatori di pagina;
- eliminare il bottone di submit fittizio se la ricerca è live, oppure renderlo
  coerente con un form reale: un solo modello di interazione;
- lasciare intatto il contratto dati JSON e le fallback nullable già presenti.

Exit criteria: il markup non contiene `main[data-page]`, `body.dc-faq-parity`,
`@import`/JS Bootstrap, né CSS inline per la FAQ.

## Fase 2 — Stile minimale e condivisione (parallela dopo Fase 1)

Owner: design system.

### 2A. Search primitive

- usare `.cmp-input-search` solo come primitive globale, con utility Tailwind
  per layout, input, icona e bottone;
- se il comportamento è comune, spostare la normalizzazione nel foglio della
  primitive search, non nel blocco FAQ;
- garantire una riga fluida a desktop e un controllo leggibile a 320 px senza
  larghezze fisse che causino overflow.

### 2B. Accordion primitive

- usare un hook neutro `.dc-accordion`/`.dc-accordion__item` condivisibile;
- usare utility Tailwind per bordi, spaziatura, colore e focus;
- usare `group-open:rotate-180` (o equivalente già supportato) per l'icona;
- limitare l'eventuale CSS residuo al marker `summary` e documentare il perché;
- non usare `display:none !important` sul pannello: il browser deve governare
  l'apertura di `details`.

### 2C. Feedback e contatti

- riusare `blocks/feedback` e `blocks/partials/dc-contacts` se i loro contratti
  coprono il caso FAQ;
- se manca una sola variante, aggiungere una variante dati-driven al blocco
  condiviso, non regole `faq-*` nel CSS globale;
- portare le etichette in lang/CMS, senza stringhe italiane hardcoded.

Exit criteria: nessun nuovo foglio FAQ page-specific; il CSS aggiunto, se
inevitabile, è component-scoped e utilizzato da almeno due consumer o è
giustificato da un limite del browser.

## Fase 3 — Eliminazione del debito (seriale)

- rimuovere l'import di `faq-parity.css` da `resources/css/app.css`;
- eliminare `faq-parity.css` solo dopo la matrice di Fase 0 e dopo aver
  verificato che nessun markup usa `dc-faq-parity`;
- rimuovere classi e override inutilizzati derivati dal vecchio markup;
- eseguire build Vite e controllare che il bundle non contenga runtime
  Bootstrap Italia e che il CSS diminuisca, non aumenti.

## Fase 4 — QA e gate (seriale)

- test Pest del contratto CMS/Folio e test browser Playwright per tutte le
  lingue;
- ricerca: vuoto, match, nessun match, reset query;
- accordion: mouse, tastiera, focus, più istanze e refresh;
- feedback: tutti gli stati senza JS error;
- viewport 320/375/390/768/1024/1440, nessun overflow;
- audit axe + controllo manuale landmark/focus/contrasto;
- confronto visuale con il template ufficiale, senza usare il suo CSS/JS in
  runtime;
- verificare DOM e network per assenza di `bootstrap*.css`, `bootstrap*.js`,
  `data-bs-toggle` e sprite Bootstrap Italia introdotti dalla FAQ.

Gate: **SHIP** solo con test verdi, zero errori console, zero overflow e
nessuna regola CSS dipendente dallo slug. Se manca un baseline visivo, il
verdetto visuale è INCONCLUSIVE, non PASS.

# Dipendenze e parallelismo (Blueprint)

```text
Fase 0 baseline
    ├──> Fase 1 markup/contratto
    │       ├──> Fase 2A search
    │       ├──> Fase 2B accordion
    │       └──> Fase 2C feedback/contatti
    └──> inventario consumer
            └──> Fase 3 eliminazione debito

Fase 2A + 2B + 2C
    └──> Fase 3 cleanup
            └──> Fase 4 QA gate
```

Le fasi 2A, 2B e 2C possono essere parallele solo se hanno file scope separati.
La pulizia dell'import e il refactor dell'app.css restano seriali per evitare
merge di bundle incoerenti.

# File scope previsto

| File | Azione |
|---|---|
| `resources/views/components/pages/faq.blade.php` | rimuovere CSS inline, markup utility/semantic hooks |
| `resources/css/app.css` | togliere import della stylesheet FAQ morta |
| `resources/css/faq-parity.css` | eliminare dopo inventario consumer |
| `resources/css/components/*` | modificare solo primitive condivise, se necessario |
| `tests/browser/design-comuni-utility-pages.spec.mjs` | coprire comportamento e responsive |
| `tests/Unit/*` | guardrail contro page-selector CSS e runtime Bootstrap |
| `docs/bmad/decision-log.md` | registrare ADR e risultato della QA |
| `docs/second-brain/*` | annotare la regola riusabile CSS/stack |

Non rientrano nello scope: nuove dipendenze, Resource Filament nel tema,
modifiche a header/footer, migrazioni database, nuove route Folio o redesign di
altre pagine.

# Regole anti-regressione

1. Il test statico fallisce se la FAQ reintroduce `main[data-page=` o
   `body.dc-faq-parity`.
2. Il test statico fallisce se la block view contiene `<style>` per la propria
   pagina.
3. Il test statico verifica che il bundle entry non importi Bootstrap Italia.
4. Il browser test verifica lo stesso blocco FAQ a più viewport e lingue.
5. Ogni nuovo override deve indicare il componente condiviso che lo consuma;
   un override usato da una sola URL viene rifiutato in review.

# Handoff

Questo documento è il piano, non l'implementazione. Dopo l'approvazione si
possono derivare le storie BMAD `FAQ-CSS-01` (markup), `FAQ-CSS-02`
(primitive), `FAQ-CSS-03` (cleanup), `FAQ-CSS-04` (QA), aggiornando prima il
decision log e il Second Brain. Il Filament Blueprint non produce codice per
questa correzione: conferma soltanto che nessuna Resource o policy appartiene
al tema.
