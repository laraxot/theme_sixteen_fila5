# Analisi Argomenti - Design Comuni vs Replica

**Data analisi**: 2026-04-07
**URL Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/argomenti.html
**URL Locale**: http://127.0.0.1:8000/it/tests/argomenti

---

## Riepilogo Struttura

### Reference (Design Comuni)
- **Header**: Standard Design Comuni con titolo pagina
- **Breadcrumb**: Navigazione gerarchica
- **Hero**: Titolo "Argomenti" con descrizione
- **Griglia argomenti**: Card grid con icone
- **Footer**: Standard Design Comuni

### Locale (Replica)
- Struttura da verificare

---

## Differenze Strutturali Identificate

### Da analizzare
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Header | Standard DC | ? | Da verificare |
| Breadcrumb | Presente | ? | Da verificare |
| Titolo sezione | "Argomenti" | ? | Da verificare |
| Griglia card | 3 colonne | ? | Da verificare |
| Icone argomenti | Presenti | ? | Da verificare |

---

## Azioni Richieste

### Fase 1: HTML Structure
- [ ] Verificare struttura DOM
- [ ] Confrontare classi Bootstrap Italia
- [ ] Verificare responsive grid

### Fase 2: CSS/JS Migration
- [ ] Convertire classi a Tailwind
- [ ] Implementare colori Design Comuni
- [ ] Verificare responsive

---

## File Coinvolti

```
laravel/Themes/Sixteen/resources/views/components/blocks/topics/
laravel/config/local/fixcity/database/content/pages/tests.argomenti.json
```
