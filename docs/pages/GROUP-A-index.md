# GROUP A - Analisi Parità Visiva

**Agente**: GROUP-A Agent
**Data analisi**: 2026-04-06
**Metodologia**: Fetch HTML da reference GitHub + local Laravel, confronto struttura DOM

---

## Indice Pagine Analizzate

| Pagina | Reference Disponibile | Status | Priorità Intervento | DIFF Analysis |
|--------|----------------------|--------|---------------------|---------------|
| [lista-risorse](#lista-risorse) | SI | Analizzata | CRITICA | [DIFF-analysis.md](./lista-risorse/DIFF-analysis.md) |
| [lista-categorie](#lista-categorie) | SI | Analizzata | ALTA | [DIFF-analysis.md](./lista-categorie/DIFF-analysis.md) |
| [lista-risorse-categorie](#lista-risorse-categorie) | SI | Analizzata | CRITICA | [DIFF-analysis.md](./lista-risorse-categorie/DIFF-analysis.md) |
| [mappa-sito](#mappa-sito) | SI | Analizzata | CRITICA | [DIFF-analysis.md](./mappa-sito/DIFF-analysis.md) |
| [amministrazione](#amministrazione) | SI | Analizzata | CRITICA | [DIFF-analysis.md](./amministrazione/DIFF-analysis.md) |
| [aree-amministrative](#aree-amministrative) | NO (404) | Analizzata (locale) | BASSA | [DIFF-analysis.md](./aree-amministrative/DIFF-analysis.md) |
| [area-amministrativa-dettaglio](#area-amministrativa-dettaglio) | NO (404) | Analizzata (locale) | BASSA | [DIFF-analysis.md](./area-amministrativa-dettaglio/DIFF-analysis.md) |
| [organo](#organo) | NO (404) | Analizzata (locale) | BASSA | [DIFF-analysis.md](./organo/DIFF-analysis.md) |
| [persona](#persona) | NO (404) | Analizzata (locale) | BASSA | [DIFF-analysis.md](./persona/DIFF-analysis.md) |

---

## Pagine con Reference Disponibile (5/9)

Le seguenti pagine hanno reference Design Comuni disponibile su GitHub:
- https://italia.github.io/design-comuni-pagine-statiche/sito/lista-risorse.html
- https://italia.github.io/design-comuni-pagine-statiche/sito/lista-categorie.html
- https://italia.github.io/design-comuni-pagine-statiche/sito/lista-risorse-categorie.html
- https://italia.github.io/design-comuni-pagine-statiche/sito/mappa-sito.html
- https://italia.github.io/design-comuni-pagine-statiche/sito/amministrazione.html

## Pagine Senza Reference (4/9)

Le seguenti pagine restituiscono **404** sul reference GitHub:
- `aree-amministrative.html` - 404
- `area-amministrativa-dettaglio.html` - 404
- `organo.html` - 404
- `persona.html` - 404

Queste pagine sono implementazioni custom del progetto FixCity senza equivalente diretto nel Design Comuni statici.

---

## Riepilogo Differenze per Pagina

### lista-risorse
**Priorità**: CRITICA

Differenze principali trovate (confronto struttura DOM):
1. **CRITICA**: Card structure errata - local usa `card-teaser card-teaser-image-top` invece di `card-wrapper` + `card no-after` + `img-responsive-wrapper`
2. **CRITICA**: Background sezioni invertite - grigio/bianco scambiati rispetto al reference
3. **CRITICA**: Hero usa `cmp-heading` invece di `cmp-hero` + `it-hero-wrapper`
4. **ALTA**: Lista principale usa 2 colonne (`col-lg-6`) invece di 3 (`col-xl-4`)
5. **ALTA**: Sezione ricerca usa `form-control` invece di autocomplete widget
6. **MEDIA**: Paginazione assente nel local (presente nel reference)
7. **MEDIA**: Sezione feedback/rating assente

---

### lista-categorie
**Priorità**: ALTA

Differenze principali:
1. **CRITICA**: Card sezione 1 usa `cmp-card-simple` (solo testo) invece di `card-wrapper` + `img-responsive-wrapper` (con immagini)
2. **ALTA**: `row-shadow` mancante nel wrapper hero
3. **ALTA**: Paginazione assente
4. **MEDIA**: `id="argomento"` mancante sulla sezione categorie
5. **MEDIA**: Sezione feedback/rating assente

---

### lista-risorse-categorie
**Priorità**: CRITICA (riscrittura necessaria)

Differenze principali:
1. **CRITICA**: Layout completamente diverso - local usa `list-group` (lista Bootstrap) vs reference usa card grid 3 colonne
2. **CRITICA**: Sezione grigia `bg-grey-card` con autocomplete completamente assente
3. **ALTA**: Paginazione assente
4. **ALTA**: Sezione categorie `cmp-card-simple` assente
5. **ALTA**: H2 con `text-secondary` assente

---

### mappa-sito
**Priorità**: CRITICA (riscrittura necessaria)

Differenze principali:
1. **CRITICA**: Struttura completamente diversa - reference usa `link-list-wrapper` + `link-list` + `link-sublist` gerarchica (3 livelli)
2. **CRITICA**: Local aggiunge hero + breadcrumb che NON esistono nel reference
3. **CRITICA**: Local usa card grid invece di lista gerarchica testuale
4. **ALTA**: Profondità navigazione - reference 3 livelli, local 1 livello

---

### amministrazione
**Priorità**: CRITICA

Differenze principali:
1. **CRITICA**: Background sezioni invertite - sezione 1 dovrebbe essere GRIGIA (`bg-grey-card`), sezione 2 BIANCA
2. **CRITICA**: Sezione 2 usa `link-list` invece di `cmp-card-simple` card grid
3. **ALTA**: Card titles usano `h5` invece di `h3`
4. **ALTA**: Struttura card sezione 1 diversa (`card-teaser` vs `cmp-card-simple`)
5. **MEDIA**: `title-xxlarge` mancante su H2

---

### aree-amministrative
**Priorità**: BASSA (no reference)

Struttura local analizzata: usa `cmp-card-simple` con `col-md-6 col-xl-4`. Coerente con il pattern generale. Nessun punto di confronto diretto disponibile.

---

### area-amministrativa-dettaglio
**Priorità**: BASSA (no reference)

Struttura local analizzata: contenuto testuale minimalista con `cmp-content`. Potrebbe richiedere più sezioni informative.

---

### organo
**Priorità**: BASSA (no reference)

Struttura local analizzata: usa `cmp-card-simple` con `col-md-6 col-xl-4`. Identica a `aree-amministrative`.

---

### persona
**Priorità**: BASSA (no reference)

Struttura local analizzata: card bio + sezione `cmp-contacts`. Design più ricco degli altri. Verificare con `persona-dettaglio` (la pagina correlata nel reference).

---

## Issues Comuni a Tutte le Pagine con Reference

1. **Sezione feedback/rating**: Tutte le pagine con reference hanno sezione feedback; nel local è spesso assente o diversa
2. **Autocomplete search**: Il reference usa `autocomplete form-control` widget; il local usa form semplici
3. **Paginazione**: Molte pagine con lista nel reference hanno `pagination-wrapper`; alcune assenti nel local

---

## Link

- [Design Comuni docs](../design-comuni/00-index.md)
- [BATCH-ANALYSIS-SUMMARY](./BATCH-ANALYSIS-SUMMARY.md)
- [COMPREHENSIVE-PARITY-REPORT](./COMPREHENSIVE-PARITY-REPORT.md)
