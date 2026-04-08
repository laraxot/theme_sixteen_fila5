# 🎨 Header Critical Issues - Fix Plan

**Data**: 2026-03-31  
**Stato**: 🔴 **CRITICO - Header molto diverso dall'originale**

## 📸 Screenshot Comparativi

### Original Design Comuni
- **File**: `screenshots/08-original-full-header.png`
- **URL**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html

### FixCity
- **File**: `screenshots/09-fixcity-full-header.png`
- **URL**: http://fixcity.local/it/tests/homepage

## 🔴 Problemi Critici Rilevati

### 1. Logo Non Visibile ❌
**Originale**: Logo SVG visibile a sinistra  
**FixCity**: Logo non visibile

### 2. Nome Comune Non Leggibile ❌
**Originale**: "Il mio Comune" - testo nero su bianco, font grande  
**FixCity**: Testo non leggibile

### 3. Slogan Mancante ❌
**Originale**: Slogan sotto il nome  
**FixCity**: Slogan assente

### 4. Colori Sbagliati ❌
**Originale**:
- Header Slim: #0066B3 (blu istituzionale)
- Header Center: #FFFFFF (bianco)
- Header Navbar: #003366 (blu scuro)

**FixCity**: Colori non corrispondono

### 5. Spaziature Diverse ❌
**Originale**: Padding e margin specifici  
**FixCity**: Spaziature non corrette

### 6. Social Icons Mancanti ❌
**Originale**: Icone social visibili  
**FixCity**: Icone non visibili

### 7. Search Bar Mancante ❌
**Originale**: Barra di ricerca visibile  
**FixCity**: Search assente

### 8. Login Button Diverso ❌
**Originale**: "Accedi all'area personale" con icona  
**FixCity**: Button non corretto

## 🎯 Struttura Header Originale

```html
<header class="it-header-wrapper">
  <!-- Header Slim -->
  <div class="it-header-slim-wrapper">
    - Regione/Comune name
    - Language selector
    - Login button ("Accedi all'area personale")
  </div>
  
  <!-- Header Center -->
  <div class="it-header-center-wrapper">
    - Logo SVG (82x82)
    - Brand text (Nome del Comune)
    - Slogan
    - Social icons
    - Search bar
  </div>
  
  <!-- Header Navbar -->
  <div class="it-header-navbar-wrapper">
    - Navigation menu
  </div>
</header>
```

## 🔧 Fix Necessari

### 1. Logo
```html
<!-- DEVE ESSERE PRESENTE -->
<svg width="82" height="82" class="icon">
  <image xlink:href="logo-comune.svg"/>
</svg>
```

### 2. Brand Text
```html
<div class="it-brand-text">
  <div class="it-brand-title">Il mio Comune</div>
  <div class="it-brand-slogan">Slogan del Comune</div>
</div>
```

### 3. Colori CSS
```css
.it-header-slim-wrapper {
  background-color: #0066B3 !important;
}

.it-header-center-wrapper {
  background-color: #FFFFFF !important;
}

.it-header-navbar-wrapper {
  background-color: #003366 !important;
}
```

### 4. Spaziature
```css
.it-header-center-wrapper {
  padding: 1.5rem 0;
}

.it-brand-title {
  font-size: 1.5rem;
  font-weight: 700;
}

.it-brand-slogan {
  font-size: 0.875rem;
  color: #666666;
}
```

## 📝 Action Plan

### Immediato (Oggi)
1. ⏳ Analizzare struttura HTML originale
2. ⏳ Confrontare con FixCity
3. ⏳ Identificare elementi mancanti
4. ⏳ Creare header component corretto

### Breve termine
5. ⏳ Implementare logo
6. ⏳ Implementare brand text + slogan
7. ⏳ Implementare social icons
8. ⏳ Implementare search bar
9. ⏳ Correggere colori
10. ⏳ Correggere spaziature

### Testing
11. ⏳ Confronto screenshot
12. ⏳ Test responsive
13. ⏳ Test accessibilità

## 🔗 References

### Screenshots
- `screenshots/08-original-full-header.png` - Originale
- `screenshots/09-fixcity-full-header.png` - FixCity

### HTML Structure
- `/tmp/original-header-structure.html` - Originale
- `/tmp/fixcity-header-structure.html` - FixCity

---

**Stato**: 🔴 **CRITICO - Header da rifare completamente**  
**Prossimo**: **🔧 Analisi dettagliata e fix**
