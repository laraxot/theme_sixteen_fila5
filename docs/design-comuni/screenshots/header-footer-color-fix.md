# 🎨 Header & Footer Color Fix - Critical Issues

**Data**: 2026-03-31  
**Stato**: 🔴 **CRITICO - Colori non corretti**

## 📸 Screenshot Comparativi

### Header
- **Originale**: `screenshots/03-header-original.png`
- **FixCity**: `screenshots/04-header-fixcity.png`

### Problemi Rilevati
1. ❌ **Colori Header** - Non corrispondono
2. ❌ **Colori Footer** - Non corrispondono
3. ❌ **Layout** - Differenze strutturali
4. ❌ **Icone** - Mancanti o errate

## 🔍 Analisi Colori

### Header - Colori Attesi

```css
/* Bootstrap Italia Original */
.it-header-slim-wrapper {
  background-color: #0066B3; /* Blu istituzionale */
}

.it-header-center-wrapper {
  background-color: #FFFFFF; /* Bianco */
}

.it-header-navbar-wrapper {
  background-color: #003366; /* Blu scuro */
}
```

### Header - Colori Attuali (FixCity)

```css
/* Tailwind @apply - DA CORREGGERE */
.it-header-slim-wrapper {
  @apply bg-gray-800; /* ❌ SBAGLIATO - Grigio invece di blu */
}

.it-header-center-wrapper {
  @apply bg-white; /* ✅ Corretto */
}

.it-header-navbar-wrapper {
  @apply bg-gray-900; /* ❌ SBAGLIATO - Grigio scuro invece di blu */
}
```

## 🔧 Fix Necessari

### 1. Header Colors Fix

**File**: `resources/css/design-comuni.css`

```css
/* PRIMA (SBAGLIATO) ❌ */
.it-header-slim-wrapper {
  @apply bg-gray-800;
}

/* DOPO (CORRETTO) ✅ */
.it-header-slim-wrapper {
  background-color: #0066B3; /* Blu istituzionale Bootstrap Italia */
}

.it-header-center-wrapper {
  background-color: #FFFFFF; /* Bianco */
}

.it-header-navbar-wrapper {
  background-color: #003366; /* Blu scuro */
}
```

### 2. Footer Colors Fix

```css
/* PRIMA (SBAGLIATO) ❌ */
.it-footer {
  @apply bg-gray-900;
}

/* DOPO (CORRETTO) ✅ */
.it-footer {
  background-color: #003366; /* Blu scuro Bootstrap Italia */
}

.it-footer-secondary {
  background-color: #002244; /* Blu ancora più scuro */
}
```

### 3. Text Colors Fix

```css
/* Header text colors */
.it-header-slim-wrapper a {
  color: #FFFFFF; /* Bianco su blu */
}

.it-header-center-wrapper .it-brand-title {
  color: #000000; /* Nero su bianco */
}

.it-header-navbar-wrapper a {
  color: #FFFFFF; /* Bianco su blu scuro */
}
```

## 📊 Bootstrap Italia Color Palette

### Primary Colors

| Name | Hex | Usage |
|------|-----|-------|
| `italia` | `#0066B3` | Header slim, primary actions |
| `italia-dark` | `#003366` | Header navbar, footer |
| `italia-darker` | `#002244` | Footer secondary |
| `white` | `#FFFFFF` | Header center, text on dark |
| `black` | `#000000` | Text on white |

### Secondary Colors

| Name | Hex | Usage |
|------|-----|-------|
| `primary` | `#0066B3` | Links, buttons |
| `secondary` | #`666666` | Secondary text |
| `success` | `#00CC00` | Success messages |
| `warning` | `#FFCC00` | Warning messages |
| `danger` | `#FF0000` | Error messages |

## 🔧 Implementation Plan

### Step 1: Update CSS Variables

**File**: `resources/css/design-comuni.css`

```css
:root {
  /* Bootstrap Italia Colors */
  --bs-italia: #0066B3;
  --bs-italia-dark: #003366;
  --bs-italia-darker: #002244;
  --bs-white: #FFFFFF;
  --bs-black: #000000;
  
  /* Header */
  --header-slim-bg: #0066B3;
  --header-center-bg: #FFFFFF;
  --header-navbar-bg: #003366;
  
  /* Footer */
  --footer-bg: #003366;
  --footer-secondary-bg: #002244;
}
```

### Step 2: Update Header Component

**File**: `resources/views/components/bootstrap-italia/header.blade.php`

```blade
{{-- Ensure correct color classes --}}
<header class="it-header-wrapper">
  <div class="it-header-slim-wrapper" style="background-color: #0066B3;">
    {{-- Header slim content --}}
  </div>
  
  <div class="it-header-center-wrapper" style="background-color: #FFFFFF;">
    {{-- Header center content --}}
  </div>
  
  <div class="it-header-navbar-wrapper" style="background-color: #003366;">
    {{-- Header navbar content --}}
  </div>
</header>
```

### Step 3: Update Footer Component

**File**: `resources/views/components/bootstrap-italia/footer-full.blade.php`

```blade
<footer class="it-footer" style="background-color: #003366;">
  <div class="it-footer-main">
    {{-- Footer main content --}}
  </div>
  
  <div class="it-footer-secondary" style="background-color: #002244;">
    {{-- Footer secondary content --}}
  </div>
</footer>
```

## ✅ Verification Checklist

### Header
- [ ] Background color: #0066B3 (slim)
- [ ] Background color: #FFFFFF (center)
- [ ] Background color: #003366 (navbar)
- [ ] Text color: #FFFFFF (on dark backgrounds)
- [ ] Text color: #000000 (on white background)
- [ ] Logo colors: Correct
- [ ] Social icons: Correct colors

### Footer
- [ ] Background color: #003366 (main)
- [ ] Background color: #002244 (secondary)
- [ ] Text color: #FFFFFF (white on dark)
- [ ] Links color: #FFFFFF (white on dark)
- [ ] Logo UE: Correct colors
- [ ] Social icons: Correct colors

## 📝 Next Steps

1. ⏳ Update CSS with correct colors
2. ⏳ Update header component
3. ⏳ Update footer component
4. ⏳ Take new screenshots
5. ⏳ Compare with original
6. ⏳ Fix any remaining issues

## 🔗 References

### Bootstrap Italia Documentation
- [Colors](https://italia.github.io/bootstrap-italia/docs/colori/)
- [Header](https://italia.github.io/bootstrap-italia/docs/header/)
- [Footer](https://italia.github.io/bootstrap-italia/docs/footer/)

### Screenshots
- `screenshots/03-header-original.png`
- `screenshots/04-header-fixcity.png`

---

**Stato**: 🔴 **CRITICO - Colori da correggere**  
**Prossimo**: **🔧 Fix colori header e footer**
