# Analisi Dettagliata - Argomenti HTML

**Data**: 2026-04-07

---

## Struttura Reference (Design Comuni)

```
main
├── div#id="main-container".container
│   └── div.row.justify-content-center
├── div.container
│   └── div.row.justify-content-center.row-shadow
├── div.container.py-5
│   ├── h2.title-xxlarge.mb-4
│   └── div.row.g-4
├── div#argomento.container.py-5
│   ├── h2.title-xxlarge.mb-4
│   └── div.row.g-4
├── div.bg-primary
│   └── div.container
└── div.bg-grey-card.shadow-contacts
    └── div.container
```

## Struttura Locale (Aggiornato 2026-04-07)

```
main
└── (nessun container diretto trovato)
    └── section.it-hero-wrapper
```

**Dati da Puppeteer**:
- `containerCount: 0` ❌
- `firstContainerId: ""` (manca main-container)
- Solo 1 sezione invece di 5+

---

## Differenze Identificate

### 1. Container #main-container
**Reference**: `div#main-container.container` con `row.justify-content-center` interno
**Locale**: Container senza ID specifico

### 2. Sezioni separate
**Reference**: Ogni sezione ha il suo `div.container`
**Locale**: Un solo container con tutte le sezioni dentro

### 3. Sezione contatti
**Reference**: `div.bg-grey-card.shadow-contacts`
**Locale**: Manca questa sezione (o ha ID diverso)

### 4. Rating section
**Reference**: `div.bg-primary` (senza ID)
**Locale**: `div#rating.bg-primary`

---

## Azioni Richieste

### Fix Struttura Blade
1. [ ] Aggiungere `id="main-container"` al primo container
2. [ ] Separare ogni sezione nel proprio container
3. [ ] Aggiungere sezione contatti `bg-grey-card shadow-contacts`
4. [ ] Verificare classi titoli `title-xxlarge mb-4`
5. [ ] Verificare grid classi `row g-4`

---

## File Coinvolti

- `resources/views/pages/tests/[slug].blade.php`
- Componenti argomenti in `resources/views/components/blocks/`
