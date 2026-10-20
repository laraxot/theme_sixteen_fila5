---
title: "DCP-268 — Login: checkbox «Ricordami» e occhio della password visibili dentro data-dc"
type: story
status: done-pending-prod-sync
updated: 2026-10-20
tags: [docs, sixteen, bmad, auth, login, filament-blueprint, design-comuni, css]
qmd: "dcp 268 login checkbox ricordami invisibile appearance none data-dc occhio password revealable fi-input-wrp suffix action Lang button"
related:
  - ../../auth/login-ux-fixes.md
  - ../decision-log.md
  - ../../../../../Modules/User/docs/bmad/filament-blueprint.md
---

# DCP-268 — Login: checkbox «Ricordami» e occhio della password visibili dentro data-dc

**Numero:** 268, preso con controllo che blocca (massimo trovato 260; 240..259 riservati).

**Stato:** done-pending-prod-sync. Fix NAS + build OK; prod `fixcity.eu` ancora su CSS/Blade vecchio (host `46.225.90.178` separato). Misurato in locale (`php artisan serve --port 8082`). Non rilasciato: alle 08:55 `fixcity.eu` serviva
ancora il checkbox senza la correzione (`appearance: none`). Non so come `fixcity.eu` riceva le modifiche (`46.225.90.178`, la
modifica dell'occhio delle 08:51 era online dopo un minuto, la mia delle 08:54 no): da verificare prima di dire «pubblicato».

## Story

Come cittadino voglio vedere e poter spuntare «Ricordami» e poter mostrare la password con l'occhio, sul login `/it/auth/login`.
Come team voglio che i campi restino quelli di Filament (`TextInput::password()->revealable()`, `Checkbox::make('remember')` in
`Modules/User/.../Schemas/UserForm::getLoginFormSchema()`), senza HTML scritto a mano.

## Diagnosi (misurata il 2026-10-20 su `fixcity.eu` e in locale)

| # | Causa | Evidenza |
|---|---|---|
| C1 | Il checkbox è nel DOM, 20×20, ma **invisibile**: lo sheet compilato ha `body:has(.page-content[data-dc]) input { appearance: none !important }` e nessuno dà bordo o sfondo. Il `appearance: auto` del componente non era `!important` e perdeva. | `getComputedStyle`: `appearance: none`, `border: 0`, sfondo trasparente. Con `appearance: auto !important`: spunta verde, si seleziona e si deseleziona, `wire:model="data.remember"` invariato. |
| C2 | L'occhio di `revealable()` usciva **sotto** il campo come icona gigante con il testo «Mostra password» in chiaro. Il CSS di Filament non è caricato sul front office, e `postcss/isolate-legacy-important.cjs` spegne `.fo-filament-form-shell …` su `data-dc` (11 regole, tutte con `:not(:where(body:has(.page-content[data-dc])…))`). | Wrapper `display: block`, suffisso a y=650 contro input 606+44, bottone 121×145. Ora: wrapper `flex`, un bordo, bottone 44×44, icona 20 px, toggle `password` ↔ `text` provato. |
| C3 | «Ricordami» era attaccato al riquadro della password (3 px) e non centrato col testo. | Dopo: 14 px sopra, differenza di centro 0. |

## Decisione

Lo stile sta **nel componente** (`components/pages/auth-login.blade.php`), come dice il suo commento: «lo sheet compilato non
dipinge dentro data-dc». Non si tocca il plugin PostCSS e non si ridisegna il checkbox: `appearance: auto !important` più
`accent-color` verde dà un controllo nativo, accessibile anche in modalità contrasto forzato.

- Checkbox: `appearance: auto !important`, `flex: 0 0 auto`, etichetta `display: flex; align-items: center; margin-top: .75rem`.
- Occhio: regole `:has(input.fi-revealable)` e `.fi-input-wrp-actions .fi-ac-btn-action` (sorgente dell'altra modifica, ora coperta da test).
- Test: `Themes/Sixteen/tests/Unit/AuthLoginStyleContractTest.php` («login paints the Filament password reveal and remember
  checkbox inside the data-dc scope»). Controprova: senza `!important` o senza la regola dell'occhio la verifica fallisce.

## Filament blueprint (da documentazione 5.x, versione installata 5.10.2)

`TextInput::password()->revealable()` aggiunge `ShowPasswordAction` e `HidePasswordAction` come suffix action; `HasAffixes`
imposta `defaultView(ICON_BUTTON_VIEW)`, cioè **solo icona** (etichetta nascosta ai vedenti).

## Aperti (non toccati, serve una decisione)

1. **Lang forza `button()` su ogni Action senza record.** `Modules/Lang/app/Providers/LangServiceProvider.php`,
   `Action::configureUsing(...)`: `if (getRecord() === null) $component->button()`. `button()` imposta `view` esplicito e
   batte il `defaultView(ICON_BUTTON_VIEW)` delle suffix action: sul login l'occhio esce come `fi-btn` **con etichetta**
   (misurato: `fi-ac-btn-action fi-btn`, testo «Mostra password»), nascosto da `font-size: 0`. Nel back office la stessa
   configurazione si applica, ma **non l'ho misurato**. Correzione possibile e stretta: escludere le suffix action
   (`ShowPasswordAction`, `HidePasswordAction`, `CopyAction`). Toccherebbe tutto il back office: da decidere.
2. **Email sottolineata, password a riquadro.** `body:has(.page-content[data-dc]) input[type="email"]` (specificità 0,3,2)
   batte il riquadro del componente (0,2,2): l'email mostra solo il filo sotto, la password il riquadro intero.
3. **`.fo-filament-form-shell` è inerte su data-dc** (unico uso: `filament/widgets/auth/login.blade.php`).
4. **Test già rosso, non mio:** `AuthLoginStyleContractTest` primo blocco si aspetta `data-slug="auth.login"` letterale in
   `pages/auth/login.blade.php` (oggi `{{ $this->pageSlug }}`) e `/forgot-password` nel componente (oggi `/auth/password/forgot`).
5. Il tooltip dell'occhio (`x-tooltip`) esce senza stile: il CSS di Tippy non è caricato sul front office.
