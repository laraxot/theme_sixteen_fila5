# 🔍 HTML Body Comparison Report

**Date**: 2026-03-31  
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**FixCity**: http://fixcity.local/it/tests/homepage  
**Status**: 🟡 COMPARING...

---

## 📋 Reference HTML Structure (First 100 lines)

```html
<body>
    <div class="skiplink">
      <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
      <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
    </div><!-- /skiplink -->
    <header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
      <div class="it-header-slim-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="it-header-slim-wrapper-content">
                <a class="d-lg-block navbar-brand" ...>Nome della Regione</a>
                <div class="it-header-slim-right-zone" role="navigation">
                  <div class="nav-item dropdown">
                    ...
```

---

## ✅ Required Structure Elements

| Element | Reference Class | FixCity Match |
|---------|----------------|---------------|
| **Skiplink** | `.skiplink` | ⚪ To verify |
| **Header** | `.it-header-wrapper` | ⚪ To verify |
| **Top Bar** | `.it-header-slim-wrapper` | ⚪ To verify |
| **Container** | `.container` | ⚪ To verify |
| **Content Wrapper** | `.it-header-slim-wrapper-content` | ⚪ To verify |
| **Brand** | `.navbar-brand` | ⚪ To verify |
| **Right Zone** | `.it-header-slim-right-zone` | ⚪ To verify |
| **Dropdown** | `.nav-item.dropdown` | ⚪ To verify |
| **Login Btn** | `.btn.btn-primary.btn-icon.btn-full` | ⚪ To verify |
| **Center Wrapper** | `.it-header-center-wrapper` | ⚪ To verify |
| **Brand Wrapper** | `.it-brand-wrapper` | ⚪ To verify |
| **SVG Logo** | `svg.icon[width=82][height=82]` | ⚪ To verify |
| **Brand Title** | `.it-brand-title` | ⚪ To verify |
| **Tagline** | `.it-brand-tagline.d-none.d-md-block` | ⚪ To verify |
| **Socials** | `.it-socials.d-none.d-lg-flex` | ⚪ To verify |

---

## 🎯 Verification Needed

1. ⚪ Check if skiplink exists
2. ⚪ Check if header classes match
3. ⚪ Check if dropdown structure matches
4. ⚪ Check if login button classes match
5. ⚪ Check if brand wrapper structure matches
6. ⚪ Check if social links structure matches

---

**Status**: 🟡 **ANALYSIS IN PROGRESS**  
**Next**: Capture FixCity HTML and compare

**Waiting for FixCity HTML capture... ⏳**
