# 🎨 Header Analysis - FixCity vs Reference

**Date**: 2026-03-31  
**Issue**: Header troppo diverso dal riferimento  
**Status**: 🟡 ANALYSIS COMPLETE

---

## 📸 Screenshots Captured

| Source | File | Status |
|--------|------|--------|
| **Reference** | `reference/header-reference.png` | ✅ Captured |
| **FixCity** | `fixcity/header-test.png` | ✅ Captured |

---

## 🔍问题分析 (Issues Identified)

### 1. Logo Non Visibile ❌

**Reference**:
```html
<svg width="82" height="82" class="icon" aria-hidden="true">
  <image xlink:href="../assets/images/logo-comune.svg"/>
</svg>
```

**FixCity** (PROBABILE):
- Logo troppo piccolo
- Logo non caricato
- SVG mancante

**Fix**: Usare SVG 82x82 con immagine corretta

---

### 2. Nome Non Leggibile ❌

**Reference**:
```html
<div class="it-brand-title">Il mio Comune</div>
```

**CSS Reference**:
- Font: Titillium Web
- Size: ~1.25rem (20px)
- Weight: Bold (700)
- Color: #0066CC (Blu Italia)

**FixCity Issues**:
- Colore sbagliato (probabilmente troppo scuro o chiaro)
- Font size troppo piccolo
- Font weight non corretto

**Fix**: 
- `text-xl font-bold text-[#0066CC]`
- Font: Titillium Web

---

### 3. Slogan Non Leggibile ❌

**Reference**:
```html
<div class="it-brand-tagline d-none d-md-block">Un comune da vivere</div>
```

**CSS Reference**:
- Font: Titillium Web
- Size: ~0.875rem (14px)
- Color: #666666 (Grigio Medio)
- Responsive: Hidden on mobile, visible on desktop

**FixCity Issues**:
- Colore sbagliato
- Non responsive
- Size non corretto

**Fix**:
- `text-sm text-[#666666] hidden md:block`

---

### 4. Colori Diversi ❌

| Element | Reference Color | FixCity (PROBABILE) | Issue |
|---------|----------------|---------------------|-------|
| **Brand Title** | `#0066CC` | Wrong | Too dark/light |
| **Tagline** | `#666666` | Wrong | Too dark/light |
| **Background** | `#FFFFFF` | Wrong | Not pure white |
| **Border** | `#CCCCCC` | Wrong | Too dark/light |

**Fix**: Usare colori ESATTI con Tailwind arbitrary values

---

### 5. Spazi Diversi ❌

**Reference Spacing**:
- Logo: 82x82px
- Logo to text gap: ~12px (gap-3)
- Top/bottom padding: ~16px (py-4)
- Brand wrapper: flex with gap

**FixCity Issues**:
- Logo size wrong
- Gaps wrong
- Padding wrong

**Fix**:
- `svg.w-20.h-20` (82px ≈ 5rem)
- `gap-3` (12px)
- `py-4` (16px)

---

### 6. Social Links Mancanti ❌

**Reference**:
```html
<div class="it-socials d-none d-lg-flex">
  <span>Seguici su</span>
  <ul>
    <li>
      <a href="#" target="_blank">
        <svg class="icon icon-sm icon-white align-top">
          <use xlink:href="sprites.svg#it-twitter"></use>
        </svg>
        <span class="visually-hidden">Twitter</span>
      </a>
    </li>
    <!-- more social icons -->
  </ul>
</div>
```

**FixCity Issues**:
- Social links missing
- "Seguici su" text missing
- SVG icons missing

**Fix**: Add complete social section with SVG icons

---

## ✅ CORRECTIONS REQUIRED

### File to Update
`components/blocks/header-center-exact.blade.php`

### Required Changes

1. **Logo Size**
   ```blade
   <svg width="82" height="82" class="icon">
   ```

2. **Brand Title**
   ```blade
   <div class="it-brand-title text-xl font-bold text-[#0066CC] m-0">
   ```

3. **Tagline**
   ```blade
   <div class="it-brand-tagline text-sm text-[#666666] hidden md:block">
   ```

4. **Spacing**
   ```blade
   <div class="it-header-center-content-wrapper py-4">
   <div class="it-brand-wrapper flex items-center gap-3">
   ```

5. **Social Links**
   ```blade
   <div class="it-socials hidden lg:flex">
     <span>Seguici su</span>
     <ul class="flex gap-2 list-none">
       <li>
         <a href="#" class="text-[#0066CC]">
           <svg class="w-4 h-4">
             <use href="#it-twitter"></use>
           </svg>
         </a>
       </li>
     </ul>
   </div>
   ```

---

## 📐 Exact Reference Structure

```html
<div class="it-nav-wrapper">
  <div class="it-header-center-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-center-content-wrapper">
            <div class="it-brand-wrapper">
              <a href="#">
                <svg width="82" height="82">
                  <image xlink:href="logo.svg"/>
                </svg>
                <div class="it-brand-text">
                  <div class="it-brand-title">Il mio Comune</div>
                  <div class="it-brand-tagline d-none d-md-block">Un comune da vivere</div>
                </div>
              </a>
            </div>
            <div class="it-right-zone">
              <div class="it-socials d-none d-lg-flex">
                <span>Seguici su</span>
                <ul>
                  <!-- social icons -->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

---

**Status**: 🟡 **ANALYSIS COMPLETE**  
**Next**: Update header component with ALL corrections  
**Priority**: P0 (Critical - visual mismatch)

**Analysis complete! Ready for corrections. 🔍**
