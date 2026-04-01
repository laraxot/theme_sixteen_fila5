# 🚨 Header Critical Fix Report

**Date**: 2026-03-30  
**Status**: 🔴 **CRITICAL**  
**Priority**: P0

---

## 📸 Issues Identified

### 1. Logo Issues 🔴
- [ ] Logo non visibile
- [ ] Logo dimensions wrong
- [ ] Logo border radius missing

### 2. Typography Issues 🔴
- [ ] Nome del Comune non leggibile
- [ ] Slogan non leggibile
- [ ] Font size troppo piccolo
- [ ] Font weight sbagliato
- [ ] Color contrast insufficiente

### 3. Color Issues 🔴
- [ ] Header background color sbagliato
- [ ] Text color non contrasta
- [ ] Hover colors mancanti

### 4. Spacing Issues 🔴
- [ ] Padding insufficiente
- [ ] Margin sbagliate
- [ ] Gap tra elementi errato
- [ ] Height header sbagliata

---

## 🎯 Upstream Reference (AGID)

### Header Main Structure

```html
<div class="it-header-main-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="it-header-main-content-wrapper">
          <div class="it-brand-wrapper">
            <a href="/">
              <img src="logo.png" alt="Logo" class="it-logo">
              <div class="it-brand-text">
                <h2 class="it-brand-title">NOME DEL COMUNE</h2>
                <p class="it-brand-tagline">Un comune da vivere</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

### Exact Colors (from upstream)

```css
/* Header Main Background */
.it-header-main-wrapper {
  background-color: #FFFFFF !important;  /* WHITE background */
}

/* Brand Text */
.it-brand-title {
  color: #000000 !important;  /* BLACK text */
  font-size: 1.5rem !important;
  font-weight: 700 !important;
}

.it-brand-tagline {
  color: #5d7083 !important;  /* GRAY slogan */
  font-size: 0.875rem !important;
  font-weight: 400 !important;
}

/* Logo */
.it-logo {
  width: 80px !important;
  height: 80px !important;
  border-radius: 50% !important;  /* CIRCULAR logo */
}
```

### Exact Spacing

```css
.it-header-main-wrapper {
  padding-top: 1rem !important;
  padding-bottom: 1rem !important;
}

.it-brand-wrapper {
  display: flex !important;
  align-items: center !important;
  gap: 1rem !important;  /* 16px gap between logo and text */
}

.it-brand-text {
  display: flex !important;
  flex-direction: column !important;
  gap: 0.25rem !important;  /* 4px between title and tagline */
}
```

---

## 🔧 Fix Plan

### Phase 1: Update main.blade.php (15 min)

**Changes**:
1. ✅ White background (#FFFFFF)
2. ✅ Black text for title
3. ✅ Gray text for slogan (#5d7083)
4. ✅ Circular logo (80x80px)
5. ✅ Correct font sizes
6. ✅ Correct spacing/gap

### Phase 2: Update CSS (15 min)

**File**: `bootstrap-italia-classes.css`

**Changes**:
1. ✅ `.it-header-main-wrapper` - white bg
2. ✅ `.it-brand-title` - black, bold, 1.5rem
3. ✅ `.it-brand-tagline` - gray, 0.875rem
4. ✅ `.it-logo` - 80x80, circular
5. ✅ `.it-brand-wrapper` - flex, gap-4

### Phase 3: Verify (10 min)

**Check**:
1. ✅ Logo visibile (80x80, circular)
2. ✅ Nome leggibile (black, bold)
3. ✅ Slogan leggibile (gray)
4. ✅ Colors match upstream
5. ✅ Spacing match upstream

---

## 🤖 OpenViking Context

```bash
openviking add-memory "Header CRITICAL fix: Logo missing, text unreadable, colors wrong. Upstream: WHITE bg, BLACK title, GRAY slogan, CIRCULAR logo 80x80. Fix in progress."
```

---

**Last Updated**: 2026-03-30  
**Priority**: 🔴 **CRITICAL (P0)**  
**Next**: Execute Phase 1 immediately  
**Owner**: Multi-Agent Team
