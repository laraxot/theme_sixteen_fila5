# Analisi Dettagliata - Homepage HTML Differences

**Data**: 2026-04-07
**Confronto**: Locale vs Reference Design Comuni

---

## Differenze Strutturali Identificate

### 1. Hero Section (`#head-section`)

#### Classe section
```diff
- <section id="head-section" class="section">
+ <section id="head-section">
```
**Fix**: Rimuovere classe `section` dalla hero

#### Colonne ordine
```diff
- <div class="col-lg-6">
+ <div class="col-lg-6 order-2 order-lg-1">
```
**Fix**: Aggiungere classi ordine per responsive

#### Card margin
```diff
- <div class="card">
+ <div class="card mb-5">
```
**Fix**: Aggiungere `mb-5` alla card

#### Data font weight
```diff
- <span class="data fw-semibold ms-2">18 mag 2022</span>
+ <span class="data fw-normal">18 mag 2022</span>
```
**Fix**: Cambiare `fw-semibold ms-2` in `fw-normal`

---

### 2. Governance Cards (`#calendario`)

#### Mario Rossi Card Structure
**Locale attuale**:
```html
<div class="card-body p-3 pb-5">
  <!-- content -->
</div>
<div class="card-image">
  <img src="...">
</div>
```

**Reference**:
```html
<div class="card-image-wrapper with-read-more">
  <div class="card-body p-3 pb-5">
    <!-- content -->
  </div>
  <div class="card-image card-image-rounded pb-5">
    <img src="...">
  </div>
</div>
```

**Fix**: Aggiungere wrapper `card-image-wrapper with-read-more` e classi `card-image-rounded pb-5`

#### Read more link
```diff
- <a class="read-more" href="#">
+ <a class="read-more ps-3" href="#">
```
**Fix**: Aggiungere `ps-3` al link

---

### 3. SVG Sprite References

```diff
- <use href="/themes/Sixteen/...
+ <use xlink:href="../assets/...
```
**Nota**: Mantenere href locale, verificare solo che gli sprite esistano

---

## Azioni di Fix Richieste

### File: `resources/views/components/blocks/hero/homepage.blade.php`

1. [ ] Rimuovere `class="section"` dal tag section (se presente)
2. [ ] Aggiungere `order-2 order-lg-1` alla colonna di sinistra
3. [ ] Aggiungere `mb-5` alla card
4. [ ] Fix font weight della data: `fw-normal` invece di `fw-semibold`
5. [ ] Rimuovere `ms-2` dalla data

### File: `resources/views/components/blocks/governance/cards.blade.php`

1. [ ] Aggiungere wrapper `card-image-wrapper with-read-more` per Mario Rossi
2. [ ] Spostare `card-image` dentro il wrapper
3. [ ] Aggiungere classi `card-image-rounded pb-5` al container immagine
4. [ ] Aggiungere `ps-3` al link read-more

---

## CSS Richiesto

```css
/* Card image wrapper */
.card-image-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}

.card-image-wrapper.with-read-more {
  position: relative;
}

/* Card image rounded */
.card-image-rounded {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  overflow: hidden;
}

.card-image-rounded img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
```

---

## Verifica Post-Fix

- [ ] HTML structure match ≥90%
- [ ] Classi ordine responsive funzionanti
- [ ] Card Mario Rossi con layout orizzontale
- [ ] Immagine circolare 80x80px
- [ ] Link read-more correttamente posizionato
