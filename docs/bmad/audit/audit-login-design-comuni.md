---
title: "Audit Design Comuni — Login Page (/auth/login)"
type: audit
status: active
theme: Sixteen
created: 2026-10-20
updated: 2026-10-20
tags: [bmad, audit, design-comuni, auth, login, css-data-page, second-brain]
qmd: "audit-login-design-comuni"
---

# Audit Design Comuni — Login Page (`/it/auth/login`)

## Riferimento Design Comuni
- URL riferimento: `https://italia.github.io/design-comuni-pagine-statiche/sito/area-personale.html` (404 — pagina non disponibile online)
- Riferimento locale: nessun `docs/design-comuni-reference.md` esistente nel tema
- Stack corretto: Tailwind + Alpine + Lit + DaisyUI + Flowbite (Bootstrap Italia solo riferimento visivo)

## Stato Attuale (verificato 2026-10-20)
URL live: `https://fixcity.eu/it/auth/login`
File blade: `laravel/Themes/Sixteen/resources/views/pages/auth/login.blade.php`

---

## ❌ Errori Rilevati

### 1. Anti-pattern `body-page` eliminato ✅ (già corretto)
- **Prima**: `body-page="auth-login"` sul layout app → generava `<main data-page="auth-login">`
- **Dopo**: rimosso — `<main>` ora plain (verificato nel codice)
- **Conformità**: body-class-rule.md ✅ — body plain

### 2. Anti-pattern `data-page` su `<main>` ✅ (eliminato)
- **Prima**: `<main id="main-container" data-page="auth-login">`
- **Dopo**: `<main id="main-container">` (senza `data-page`)
- **Hook canonico**: `div.page-content[data-dc][data-slug][data-side="content"]` ✅
- **Conformità**: css-scoping-rule.md ✅

### 3. `data-slug` hardcoded in `login.blade.php` ⚠️ (corretto in questa sessione)
- **Prima**: `data-slug="auth.login"` (stringa fissa — non segue naming Folio)
- **Dopo**: `data-slug="{{ $this->pageSlug }}"` (variabile componente — corretto)
- **Impatto**: se `pageSlug` cambia, il CSS data-page selector non si aggiorna
- **Conformità**: JSON-DRIVEN-PHILOSOPHY.md ✅ dopo fix

### 4. Uso diretto di `<x-page>` con Filament widget (NON conforme Design Comuni per la resa visiva)
- **Problema**: `<x-page side="content" :slug="$this->pageSlug" :data="$this->data" />` renderizza `LoginWidget` con markup Filament (`fi-fo-field-wrapper`, `fi-fo-field-label-col`, `fi-grid`, ecc.)
- **Problema**: il markup Filament NON corrisponde ai componenti Design Comuni (DC) — usa classi proprietarie (`fi-fo-field-wrapper`, `.fi-ac-btn-action`, `.auth-login-card`) invece di quelle standard DC
- **Problema**: non esiste un componente `auth-login-card` standard nel design-system Design Comuni; è una classe custom creata nel tema che non segue il pattern componenti riutilizzabili
- **Conformità css-scoping-rule.md**: il selettore `data-dc` funziona, ma il contenuto interno non segue il markup canonico Design Comuni per i form di autenticazione

### 5. `register.blade.php` — `<x-page>` rimosso per errore ⚠️ (corretto in questa sessione, ma il file era stato sostituito con markup statico)
- **Problema**: il file `register.blade.php` era stato editato con markup statico (`<form>` diretto senza `<x-page>`) — questo rompe l'integrazione con `LoginWidget` e il middleware `PageSlugMiddleware`
- **Problema**: il markup statico (`fi-fo-field-wrapper`, ecc.) non corrisponde al componente `LoginWidget` che gestisce login, errori, redirect, sessioni
- **Fix richiesto**: ripristinare `<x-page>` con il componente Volt corretto, ma documentare che il widget Filament necessita di un wrapper Design Comuni

### 6. Mancanza di wrapper Design Comuni per il componente Filament
- **Problema**: il componente `LoginWidget` (`Modules\User\Filament\Widgets\Auth\LoginWidget`) renderizza con il suo template interno (`pub_theme::filament.widgets.auth.login`) che usa markup Filament, non Design Comuni
- **Problema**: non esiste un `docs/design-comuni/domande-frequenti-implementazione.md` o equivalente per il login
- **Conformità**: Filament Blueprint dice che il widget deve rimanere riutilizzabile e data-driven; il markup visivo deve allinearsi al design-system

---

## ✅ Stato Post-Correzione (2026-10-20)

### File verificati:
- `login.blade.php`: `body-page` rimosso ✅, `data-slug="{{ $this->pageSlug }}"` ✅, `<x-page>` mantenuto ✅
- `register.blade.php`: `body-page` rimosso ✅, `data-slug` variabile ✅, `<x-page>` mantenuto ✅ (dopo correzione)

### Cosa manca ancora per Design Comuni:
1. **Wrapper componente login**: il `LoginWidget` renderizza con classi Filament (`fi-fo-field-wrapper`, `.fi-fo-field-label-col`, `.fi-fo-field`, `.fi-fo-text-input`, `.fi-btn`). Per Design Comuni si aspettano componenti come `.form-group`, `.form-label`, `.form-control`, `.btn-primary` (o equivalenti DC standard)
2. **Componente card**: `.auth-login-card` è custom; Design Comuni usa `.card-wrapper` o `.shadow-xl` con `.rounded-2xl`
3. **Link "Password dimenticata?"**: usa classi custom (`font-semibold text-italia-blue-700 underline underline-offset-2`) invece di `.link-list` o componenti link Design Comuni standard
4. **Link "Dichiarazione di accessibilità"**: usa `.font-semibold text-sky-900 underline underline-offset-4` — non standard DC
5. **Titolo pagina**: usa `h1` con `text-3xl font-bold tracking-tight text-slate-950` — non segue gerarchia tipografica Design Comuni per le pagine di servizio

---

## 📊 Matrice Errori Design Comuni

| # | Errore | File | Stato | Priorità |
|---|--------|------|-------|----------|
| 1 | `body-page` anti-pattern | `login.blade.php`, `register.blade.php` | ✅ Fisso | Alta |
| 2 | `data-page` su `<main>` (via layout) | `layouts/app.blade.php` | ✅ Fisso (indiretto) | Alta |
| 3 | `data-slug` hardcoded | `login.blade.php` | ✅ Fisso | Media |
| 4 | Markup Filament non DC | `LoginWidget` view (tema) | ⚠️ Non risolto | Alta |
| 5 | Card `.auth-login-card` custom | `login.blade.php` (via CSS) | ⚠️ Non risolto | Media |
| 6 | Link stili non standard | `login.blade.php` | ⚠️ Non risolto | Bassa |
| 7 | Form label/form-control non DC | `LoginWidget` template | ⚠️ Non risolto | Media |

---

## 📋 Decisioni BMAD (da registrare)

- **D10**: `body-page` eliminato da entrambe le pagine auth — conforme body-class-rule.md
- **D11**: `data-slug` variabile `{{ $this->pageSlug }}` — conforme naming Folio (`auth.login`, `auth.register`)
- **D12**: `<x-page>` mantenuto — conforme Filament Blueprint (widget riutilizzabile, data-driven)
- **D13**: Markup Design Comuni per il contenuto interno del widget NON ancora applicato — richiede override del template `pub_theme::filament.widgets.auth.login`

---

## 🔗 Riferimenti Second Brain

- [knowledge: why-domaine-frequenti-blade-php-must-not-exist.md](../knowledge/why-domande-frequenti-blade-php-must-not-exist.md)
- [plan: css-data-page-elimination-plan.md](../plans/css-data-page-elimination-plan.md)
- [story: s-parity-domande-frequenti.story.md](../stories/s-parity-domande-frequenti.story.md)
- [doc: design-comuni/domande-frequenti-implementazione.md](../../design-comuni/domande-frequenti-implementazione.md)
