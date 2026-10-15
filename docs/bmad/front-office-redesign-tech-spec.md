---
title: "Tech Spec — Front Office Redesign DesignComuni"
type: tech-spec
tags: [design-comuni, front-office, tailwind, alpine, lit, wcag-21-AA]
links:
  story: "docs/stories/front-office-complete-redesign.story.md"
  investigation: "docs/investigation/front-office-redesign-planning.md"
  prd: "docs/bmad/front-office-redesign-prd.md"
  decision_log: "docs/decision-log.md"
  design_ref: "https://italia.github.io/design-comuni-pagine-statiche/index.html"
status: draft
updated: 2026-10-11
qmd: "tech spec   front office redesign designcomuni v2.4.0 sixteen"
---

# Tech Spec — Front Office Redesign DesignComuni v2.4.0

## Stack tecnologico
- **CSS Framework**: Tailwind CSS v4 (standalone CLI) + `@apply` per mapping Bootstrap Italia
- **Componenti JS**: AlpineJS 3.x (stato UI), Lit 3.x (Web Components)
- **Mappa**: Leaflet 1.9.4 + MarkerCluster (servito locale, no CDN)
- **Layout**: Sixteen’s canonical `layouts/app.blade.php` over
  `components/layouts/main.blade.php`; DesignComuni is the theme identity, not a
  parallel layout variant.
- **Asset deployment**: symlink `public_html/themes/Sixteen → laravel/Themes/Sixteen/public`

## Asset mapping (Bootstrap Italia → Tailwind)

| Bootstrap Class | Tailwind `@apply` | Note |
|---|---|---|
| `.btn-primary` | `@apply bg-primary text-white px-4 py-2 rounded` | Primary action |
| `.btn-link` | `@apply text-primary underline hover:no-underline` | Secondary action |
| `.card` | `@apply bg-white rounded shadow-sm border-0` | Card base |
| `.card-bg` | `@apply bg-gray-50` | Background alternativo |
| `.it-header-wrapper` | `@apply bg-white border-b border-gray-200` | Header istituzionale |
| `.it-footer` | `@apply bg-gray-900 text-white` | Footer scuro |
| `.it-brand-text` | `@apply text-xl font-bold text-primary` | Brand comune |
| `.it-step-indicator` | custom component | Wizard progress |

## Struttura CSS
```
laravel/Themes/Sixteen/resources/css/
├── app.css                    # Tailwind v4 entry
├── design-comuni.css          # @apply mapping Bootstrap Italia
├── design-comuni-global-fixes.css  # .ticket-marker-visible + utility
└── map-lit.css                # Stili map-lit Web Component
```

## Componenti Blade (layout)
```
laravel/Themes/Sixteen/resources/views/
├── layouts/
│   └── app.blade.php               # Layout pubblico Sixteen/DesignComuni
├── components/
│   ├── it-header.blade.php         # Header DesignComuni
│   ├── it-footer.blade.php         # Footer DesignComuni
│   ├── skip-links.blade.php        # Skip links WCAG
│   ├── card.blade.php              # Card component
│   ├── btn.blade.php               # Button component
│   └── step-indicator.blade.php    # Wizard step indicator
├── tickets/
│   ├── index.blade.php             # Lista + mappa
│   ├── create/
│   │   ├── wizard.blade.php        # Container wizard
│   │   ├── step-privacy.blade.php  # Step 1
│   │   ├── step-dati.blade.php     # Step 2
│   │   ├── step-riepilogo.blade.php # Step 3
│   │   └── step-conferma.blade.php # Step 4
│   ├── show.blade.php              # Dettaglio
│   └── track.blade.php             # Traccia per codice
├── categories/
│   └── index.blade.php             # Elenco categorie
├── errors/
│   ├── 404.blade.php
│   └── 500.blade.php
└── accessibility.blade.php         # Dichiarazione accessibilità
```

## Web Component `<map-lit>`
```html
<map-lit 
  data-center="[45.57, 12.25]" 
  data-zoom="13"
  data-markers='[{"lat":45.57,"lng":12.25,"title":"Segnalazione #123"}]'
  data-marker-icon="custom-svg"
></map-lit>
```
- **Props**: `center`, `zoom`, `markers` (JSON), `markerIcon` (SVG string)
- **Events**: `marker-click`, `map-ready`
- **Accessibilità**: `role="application"`, `aria-label`, focus-visible sui marker

## Marker mappa — Spec WCAG 2.1 AA
```javascript
// Leaflet L.divIcon custom
const markerIcon = L.divIcon({
  html: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Segnalazione">
    <circle cx="12" cy="12" r="10" fill="#007a52" stroke="#ffffff" stroke-width="2"/>
    <circle cx="12" cy="12" r="4" fill="#ffffff"/>
  </svg>`,
  className: 'ticket-marker-visible',
  iconSize: [24, 24],
  iconAnchor: [12, 24],
  popupAnchor: [0, -24]
});
```

CSS `.ticket-marker-visible`:
```css
.ticket-marker-visible:focus-visible {
  outline: 3px solid #17334f;
  outline-offset: 2px;
  border-radius: 50%;
}
```

## Wizard segnalazione — 4 step
| Step | Route | Component | Validazione |
|---|---|---|---|
| 1. Privacy | `/tickets/create?step=privacy` | `step-privacy.blade.php` | `GetPublishedPrivacyPolicyAction` obbligatorio |
| 2. Dati | `/tickets/create?step=dati` | `step-dati.blade.php` | Form completa (nome, tipo, contenuto, posizione) |
| 3. Riepilogo | `/tickets/create?step=riepilogo` | `step-riepilogo.blade.php` | Read-only conferma |
| 4. Conferma | `/tickets/create?step=conferma` | `step-conferma.blade.php` | Submit → `CreateTicketAction` |

### Validazione `owner_id`
```php
// CreateTicketAction.php
public function execute(array $data, ?string $locale = null): Ticket
{
    if (! isset($data['owner_id']) || $data['owner_id'] === null) {
        $user = auth()->user();
        if (! $user) {
            throw new \Illuminate\Validation\ValidationException(
                validator([], ['owner_id' => 'required'])
            )->withMessages(['owner_id' => 'Devi accedere per creare una segnalazione.']);
        }
        $data['owner_id'] = $user->id;
    }
    // ... resto logica
}
```

## WCAG 2.1 AA Checklist
- [ ] Contrasto testo: ≥4.5:1 (normale), ≥3:1 (large)
- [ ] Contrasto UI: ≥3:1 (bordi, icone, focus)
- [ ] Focus-visible su tutti gli interattivi
- [ ] Skip links (contenuti + footer)
- [ ] ARIA labels su marker mappa
- [ ] Ordine logico tab
- [ ] Testo alternativo immagini
- [ ] Form label associate
- [ ] Messaggi errore accessibili

## CI/CD
- `npm run build:css` → compila Tailwind + design-comuni.css
- `php artisan view:cache` → cache Blade
- `php artisan vendor:publish --tag=public` → asset pubblici
- Symlink creato via `bashscripts/deploy/symlink-themes.sh`
