# Analisi Servizi - Design Comuni vs Replica

**Data analisi**: 2026-04-07
**URL Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/servizi.html
**URL Locale**: http://127.0.0.1:8000/it/tests/servizi

---

## Riepilogo Struttura

### Reference (Design Comuni)
- **Header**: Standard Design Comuni
- **Breadcrumb**: Navigazione gerarchica
- **Hero**: Titolo "Servizi" con search bar
- **Categorie**: Card con icone per categorie servizi
- **Servizi in evidenza**: Lista servizi popolari
- **Footer**: Standard Design Comuni

### Locale (Replica)
- Struttura da verificare

---

## Differenze Strutturali Identificate

### Da analizzare
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Search bar | Prominente | ? | Da verificare |
| Categorie grid | 2x2 o 3 colonne | ? | Da verificare |
| Card categorie | Icona + titolo | ? | Da verificare |
| Servizi lista | Con icone | ? | Da verificare |

---

## Azioni Richieste

### Fase 1: HTML Structure
- [ ] Verificare struttura DOM
- [ ] Confrontare classi Bootstrap Italia
- [ ] Verificare search bar styling

### Fase 2: CSS/JS Migration
- [ ] Convertire classi a Tailwind
- [ ] Implementare colori Design Comuni
- [ ] Verificare responsive

---

## File Coinvolti

```
laravel/Themes/Sixteen/resources/views/components/blocks/services/
laravel/config/local/fixcity/database/content/pages/tests.servizi.json
```
