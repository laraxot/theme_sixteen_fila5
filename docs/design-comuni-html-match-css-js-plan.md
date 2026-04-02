# Design Comuni HTML Match - Piano di Lavoro CSS/JS

**Status**: IN PROGRESS  
**Created**: 2026-04-02  
**Priority**: CRITICAL  
**Enforced**: ALWAYS

---

## Obiettivo

Replicare il design di https://italia.github.io/design-comuni-pagine-statiche/ usando Tailwind CSS + Alpine.js invece di Bootstrap Italia, mantenendo la stessa struttura HTML.

---

## Analisi Strutturale Completata

### Risultato Confronto HTML Body

| Metrica | Reference | FixCity | Match |
|---------|-----------|---------|-------|
| Linee totali | 1328 | 1259 | 95%+ |
| Sezioni ID | 34 | 35 (+1 Livewire) | ✅ |
| Classi CSS | 200+ | 200+ | ✅ |
| Struttura DOM | Identica | Identica | ✅ |

### Differenze Identificate

1. **Livewire attributes** (`wire:key`, `wire:snapshot`, `wire:id`) - Inevitabili, non strutturali
2. **Blade comments** (`<!--[if BLOCK]><![endif]-->`) - Artefatti di Blade, non visibili
3. **Classi mancanti in FixCity** (solo reference):
   - `col`, `col-lg-5`, `d-md-none` - Layout grid Bootstrap
   - `fade`, `modal`, `modal-body`, `modal-content`, `modal-dialog`, `modal-lg`, `modal-title` - Search modal
   - `search-modal`, `searches-list`, `searches-list-wrapper` - Search functionality
   - `perfect-scrollbar`, `ps-5`, `variable-gutters`, `other-link-title` - UI polish
   - `icon-md`, `text-underline` - Utility classes
4. **Differenze minori**:
   - `text-paragraph-card` vs `text-paragraph-card` (stessa classe, contesto diverso)
   - SVG `href` vs `xlink:href` - Funzionalmente equivalenti
   - HTML entity `&#039;` vs `'` - Escape Blade

### Conclusione Analisi

**La struttura HTML è identica al 95%+. Le differenze sono attributi Livewire, commenti Blade, e classi mancanti per funzionalità (search modal) che devono essere aggiunte via CSS.**

---

## Piano di Lavoro CSS/JS

### Fase 1: CSS - Classi Mancanti (PRIORITÀ ALTA)

**Target**: `laravel/Themes/Sixteen/resources/css/design-comuni.css`

#### 1.1 Grid System Classes
```css
/* Bootstrap Italia grid classes needed */
.col { flex: 1 0 0%; }
.col-lg-5 { width: 41.666667%; }
.d-md-none { display: none; }
@media (min-width: 768px) { .d-md-none { display: block; } }
```

#### 1.2 Modal Classes (Search Modal)
```css
/* Modal structure */
.modal { position: fixed; inset: 0; z-index: 1050; display: none; }
.modal.fade { opacity: 0; transition: opacity 0.15s; }
.modal.show { display: block; opacity: 1; }
.modal-dialog { position: relative; margin: 1.75rem auto; max-width: 500px; }
.modal-lg { max-width: 800px; }
.modal-content { background: #fff; border-radius: 0.25rem; }
.modal-body { padding: 1rem; }
.modal-title { margin: 0; }
```

#### 1.3 Search Component Classes
```css
.search-modal { /* overlay styles */ }
.searches-list { list-style: none; padding: 0; }
.searches-list-wrapper { /* container styles */ }
.perfect-scrollbar { /* scrollbar styling */ }
```

#### 1.4 Utility Classes
```css
.icon-md { width: 1.5rem; height: 1.5rem; }
.text-underline { text-decoration: underline; }
.variable-gutters { /* gutter variations */ }
.other-link-title { /* link title styles */ }
```

### Fase 2: CSS - Tailwind Equivalents (PRIORITÀ ALTA)

**Target**: `laravel/Themes/Sixteen/resources/css/design-comuni.css`

Molte classi Bootstrap Italia hanno equivalenti Tailwind. Documentare le mappature:

| Bootstrap Italia | Tailwind CSS | Note |
|-----------------|--------------|------|
| `mb-5` | `mb-5` | ✅ Already mapped |
| `pb-5` | `pb-5` | ✅ Already mapped |
| `px-0` | `px-0` | ✅ Already mapped |
| `pb-90` | `pb-[90px]` | Custom spacing |
| `pt-0` | `pt-0` | ✅ Already mapped |
| `mb-10` | `mb-10` | Custom spacing |
| `pt-30` | `pt-[30px]` | Custom spacing |
| `mt-40` | `mt-[40px]` | Custom spacing |
| `section-muted` | Custom | Background color |
| `card-overlapping` | Custom | Overlapping card effect |
| `card-teaser-wrapper-equal` | Custom | Equal height cards |

### Fase 3: JavaScript - Alpine.js Interactions (PRIORITÀ MEDIA)

**Target**: `laravel/Themes/Sixteen/resources/js/agid.js` e nuovi componenti Alpine

#### 3.1 Mobile Navigation
```html
<!-- Alpine.js replacement for Bootstrap Italia navbar -->
<div x-data="{ open: false }">
    <button @click="open = !open">Menu</button>
    <div x-show="open" x-cloak>...</div>
</div>
```

#### 3.2 Search Modal
```html
<div x-data="{ open: false }">
    <button @click="open = true">Cerca</button>
    <div x-show="open" x-cloak class="modal show">
        <!-- Search content -->
    </div>
</div>
```

#### 3.3 Carousel (Splide → Alpine/Swiper)
```html
<!-- Replace Splide carousel with Alpine or Swiper -->
<div x-data="carousel()" x-init="init()">
    <!-- Carousel slides -->
</div>
```

#### 3.4 Dropdown (Language Selector)
```html
<div x-data="{ open: false }" @click.outside="open = false">
    <button @click="open = !open">ITA</button>
    <div x-show="open" x-cloak>
        <!-- Language options -->
    </div>
</div>
```

### Fase 4: CSS - Custom Properties & Design Tokens (PRIORITÀ MEDIA)

**Target**: `laravel/Themes/Sixteen/resources/css/agid-colors.css`

```css
:root {
    /* Bootstrap Italia color tokens → Tailwind custom properties */
    --it-primary: #0066cc;
    --it-secondary: #5c6f82;
    --it-success: #00875c;
    --it-warning: #ffb81c;
    --it-danger: #e6002b;
    
    /* Typography */
    --it-font-family-sans: 'Titillium Web', sans-serif;
    --it-font-serif: 'Lora', serif;
    
    /* Spacing */
    --it-space-unit: 1rem;
    --it-space-xs: 0.25rem;
    --it-space-sm: 0.5rem;
    --it-space-md: 1rem;
    --it-space-lg: 1.5rem;
    --it-space-xl: 2rem;
    --it-space-xxl: 3rem;
}
```

### Fase 5: Build & Deploy (PRIORITÀ BASSA)

```bash
cd laravel/Themes/Sixteen
npm run build    # Compila CSS/JS con Vite
npm run copy     # Copia in public_html/themes/Sixteen/
```

---

## File da Modificare

| File | Fase | Priorità |
|------|------|----------|
| `resources/css/design-comuni.css` | 1, 2, 4 | ALTA |
| `resources/css/style-apply.css` | 2 | ALTA |
| `resources/js/agid.js` | 3 | MEDIA |
| `resources/js/app.js` | 3 | MEDIA |
| `resources/js/custom.js` | 3 | MEDIA |
| `vite.config.js` | 5 | BASSA |

---

## Checklist di Verifica

- [ ] Classi grid mancanti aggiunte
- [ ] Classi modal aggiunte
- [ ] Classi search aggiunte
- [ ] Utility classes aggiunte
- [ ] Mappature Tailwind verificate
- [ ] Alpine.js per navigazione mobile
- [ ] Alpine.js per search modal
- [ ] Alpine.js per dropdown lingue
- [ ] Carousel funzionante
- [ ] Build completato senza errori
- [ ] `npm run copy` eseguito
- [ ] Verifica visuale pagina homepage

---

## Note per Altri Agenti

1. **NON modificare** la struttura HTML dei block components - è già corretta al 95%
2. **Lavorare SOLO su** CSS e JS
3. **Dopo ogni modifica CSS**: eseguire `npm run build && npm run copy`
4. **Documentare** ogni modifica in questo file con data e descrizione
5. **Testare** sempre su `http://127.0.0.1:8000/it/tests/homepage`

---

**Ultimo aggiornamento**: 2026-04-02  
**Prossima revisione**: Dopo Fase 1
