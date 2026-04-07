# Analisi Dettagliata - Servizi HTML

**Data**: 2026-04-07

---

## Struttura Reference (Design Comuni)

```
main
├── div#main-container.container
│   └── div.row.justify-content-center
├── div.container
│   └── div.row.justify-content-center
└── div.bg-grey-card
    └── div.container
```

## Struttura Locale (Aggiornato 2026-04-07)

```
main
├── div.row.justify-content-center (senza container!)
├── div.row.justify-content-center
├── section#servizi.py-20.bg-white.scroll-mt-20
└── div#rating.bg-primary
```

**Dati da Puppeteer**:
- `mainChildren[0]`: `div.row` (manca container wrapper) ❌
- `firstChildId`: "" (manca main-container)
- Struttura completamente diversa da reference

---

## Differenze Identificate

### 1. Container Principale
**Reference**: `div#main-container.container`
**Locale**: `div.container` (senza ID)

### 2. Sezioni Separate
**Reference**: Container separati per ogni sezione
**Locale**: Un container con tutte le sezioni

### 3. Sezione Servizi
**Reference**: Dentro container separato
**Locale**: `section#servizi` con classi Tailwind `py-20 bg-white`

### 4. Background Sezione Contatti
**Reference**: `div.bg-grey-card`
**Locale**: Manca o ha struttura diversa

---

## Azioni Richieste

1. [ ] Aggiungere `id="main-container"` al primo container
2. [ ] Separare sezioni in container distinti
3. [ ] Verificare classe `bg-grey-card` per sezione contatti

---

## File Coinvolti

- `resources/views/pages/tests/[slug].blade.php`
- Componenti servizi in `resources/views/components/blocks/services/`
