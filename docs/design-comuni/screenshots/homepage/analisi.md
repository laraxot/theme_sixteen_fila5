<<<<<<< HEAD
# Analisi Homepage - Design Comuni vs Replica

**Data analisi**: 2026-04-07
**URL Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
**URL Locale**: http://127.0.0.1:8000/it/tests/homepage

---

## Riepilogo Struttura

### Reference (Design Comuni)
- **Header**: `.it-header-wrapper` con struttura Bootstrap Italia
- **Main**: Container con sezioni: hero, calendario, evidence, useful-links
- **Footer**: `.it-footer` con struttura Bootstrap Italia

### Locale (Replica)
- **Header**: `.it-header-wrapper` (stesse classi Bootstrap Italia)
- **Main**: Container con sezioni simili ma struttura diversa
- **Footer**: `.it-footer` (stesse classi Bootstrap Italia)

---

## Differenze Strutturali Identificate

### 1. Header Structure
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Hamburger position | Sinistra del logo | ? | Da verificare |
| Login button | Outline bianco con icona | ? | Da verificare |
| Social icons | Presenti | ? | Da verificare |
| Search | Presente | ? | Da verificare |

### 2. Hero Section (head-section)
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Card layout | Card laterale destra | ? | Da verificare |
| Titolo notizia | Verde (#006E47) | ? | Da verificare |
| Categoria/data | Spacing corretto | ? | Da verificare |
| Chip "Estate in città" | Verde con bg chiaro | ? | Da verificare |
| Link "Tutte le novità" | Verde con freccia | ? | Da verificare |

### 3. Governance/Calendario Section
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Mario Rossi card | Layout orizzontale (img right) | ? | Da verificare |
| Altri cards | Testo semplice | ? | Da verificare |
| Calendario slider | Visibile con dots | ? | Da verificare |
| Layout grid | 3 colonne desktop | ? | Da verificare |

### 4. Argomenti Section
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Header | Verde scuro con testo bianco | ? | Da verificare |
| Card grid | 2-3 colonne | ? | Da verificare |
| Link "Esplora" | Verde | ? | Da verificare |

### 5. Eventi Section
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Visibilità | Presente | ? | Da verificare |
| Card layout | 3 colonne con immagine | ? | Da verificare |
| Link | Verde | ? | Da verificare |

### 6. Siti Tematici
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Card colorate | Presenti (blue, warning, dark) | ? | Da verificare |
| Layout grid | 3 colonne | ? | Da verificare |

### 7. Link Utili
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Stile | Testo semplice, non bottoni | ? | Da verificare |
| Colore | Verde (#006E47) | ? | Da verificare |
| Icone | A sinistra | ? | Da verificare |

### 8. Rating Section
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Background | Verde pieno (#007a52) | ? | Da verificare |
| Inner box | Bianca con padding | ? | Da verificare |
| Titolo | Nero, font-size medio | ? | Da verificare |
| Stelline | Grigio default, blu selected | ? | Da verificare |

### 9. Contatti Section
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Link style | Verde con underline | ? | Da verificare |
| Icone | A sinistra | ? | Da verificare |

### 10. Footer
| Aspetto | Reference | Locale | Stato |
|---------|-----------|--------|-------|
| Logo EU | Presente | ? | Da verificare |
| Colonne | 3 colonne layout | ? | Da verificare |
| Link style | Bianchi con underline | ? | Da verificare |

---

## Classi Bootstrap Italia da Rimuovere/Sostituire

### Header
- `.it-header-wrapper` → Tailwind custom
- `.it-header-slim-wrapper` → Tailwind custom
- `.it-nav-wrapper` → Tailwind custom
- `.it-header-center-wrapper` → Tailwind custom
- `.it-header-navbar-wrapper` → Tailwind custom

### Content
- `.container` → Tailwind `container mx-auto px-4`
- `.row` → Tailwind `flex flex-wrap`
- `.col-*` → Tailwind `w-full md:w-1/2 lg:w-1/3`
- `.card` → Tailwind custom card classes
- `.section` → Tailwind `py-12` o custom

### Footer
- `.it-footer` → Tailwind custom
- `.it-footer-main` → Tailwind custom

---

## Azioni Richieste

### Fase 1: HTML Structure (PRIORITÀ ALTA)
1. [ ] Verificare struttura DOM header
2. [ ] Verificare gerarchia sezioni main
3. [ ] Verificare struttura footer
4. [ ] Confrontare classi specifiche

### Fase 2: CSS/JS Migration
1. [ ] Sostituire classi Bootstrap Italia con Tailwind
2. [ ] Implementare colori Design Comuni (#006E47)
3. [ ] Implementare responsive breakpoints
4. [ ] Aggiungere Alpine.js per interazioni

### Fase 3: Validazione
1. [ ] Screenshot confronto finale
2. [ ] Verifica responsive (mobile, tablet, desktop)
3. [ ] Check zero hardcoded text
4. [ ] Check qualità codice (PHPStan, Pint)

---

## Note

- La pagina locale usa ancora classi Bootstrap Italia (it-*)
- È necessario migrare completamente a Tailwind
- Il CSS attuale (`dc-homepage-parity`) sembra gestire alcune override
- La struttura JSON sembra completa

---

## File Coinvolti

```
laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php
laravel/Themes/Sixteen/resources/views/components/blocks/
├── hero/
│   └── homepage.blade.php
├── governance/
│   └── cards.blade.php
├── topics/
│   └── homepage.blade.php
├── events/
│   └── homepage.blade.php
├── thematic-sites/
│   └── *.blade.php
├── useful-links/
│   └── *.blade.php
├── feedback/
│   └── rating.blade.php
└── contact/
    └── homepage.blade.php

laravel/Themes/Sixteen/resources/css/
└── (Tailwind + custom CSS)

laravel/config/local/fixcity/database/content/pages/tests.homepage.json
```
=======
# Analisi Visiva: homepage

**Data:** 2026-04-07
**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
**Locale:** http://127.0.0.1:8000/it/tests/homepage

## Risultato Confronto

| Metrica | Valore |
|---------|--------|
| Pixel diversi | 5,531,819 |
| Pixel totali | 10,295,040 |
| Similarità | 46.27% |
| Threshold | 0.05 |

## Interpretazione

❌ **FAIL** - Similarità visiva < 70%. Necessario lavoro sostanziale su CSS/HTML.

## Screenshot

| File | Descrizione |
|------|-------------|
| [originale.png](originale.png) | Reference Design Comuni |
| [replica.png](replica.png) | Replica locale |
| [diff.png](diff.png) | Differenze pixel (highlighted in red) |

## Note

- Diff generato con pixelmatch (threshold: 0.05)
- Aree rosse = differenze significative
- Aree nere = pixel identici

---
*Generato automaticamente da compare.js*
>>>>>>> 4b74b32 (.)
