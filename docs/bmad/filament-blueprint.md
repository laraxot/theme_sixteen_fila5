---
title: "Filament Blueprint — Theme Sixteen"
type: filament-blueprint
status: active
theme: Sixteen
created: 2026-10-16
updated: 2026-10-27
tags: [bmad, filament, blueprint, theme, sixteen, folio, x-page, reusable, brand-mark, header-chrome]
qmd: "filament blueprint theme sixteen widget mount no resource folio shell reusable brand-mark header footer"
related:
  - ../bmad-planning.md
  - ../bmad-brainstorming.md
  - ./container0-index-shell-contract.md
  - ./decision-log.md
  - ../rules/reusable-components.md
  - ../wiki/concepts/design-comuni-reusable-components.md
---

# Scopo

Il tema **Sixteen** non possiede Resource Filament. Compone pagine Folio/Volt e puo
montare widget Filament **dei moduli owner** con props canoniche.


## Homepage FO (JSON, non page Blade)

SSOT contenuto tenant: `laravel/config/local/fixcity/database/content/pages/home.json`.
Entry Folio: `resources/views/pages/index.blade.php` → `<x-page slug="home" />`.
Presentazione: solo `components/blocks/*` citati dal JSON.
**Vietato** creare `pages/home.blade.php` o `pages/homepage.blade.php`
([why-home-blade-must-not-exist.md](./knowledge/why-home-blade-must-not-exist.md),
[homepage-content-contract.md](../../../../Modules/Fixcity/docs/homepage-content-contract.md)).
Verifica misurata axe/pixel/vite: [homepage-a11y-pixel-verification.md](./homepage-a11y-pixel-verification.md).


## FO shell (lista container)

Homepage guest desiderabile: blocco `home.hero` → `#head-section.fc-home-head` +
`map-lit` (studio pages_old, non restore). Contratto BMAD + playbook marketing.



`pages/[container0]/index.blade.php` è solo trasporto: Volt + `<x-page>`.
Nessuna Resource, nessun `match` dominio, nessun layout dinamico nel tema.
Alias Design Comuni / `area-personale` / 404 CMS vivono in
`Actions\Folio\ResolveContainer0IndexAction` +
`Infrastructure\Url\FrontofficeContainerAliases` (riutilizzabili),
non in `@php` inline nella Folio page.
URL FO ricorrenti: `Infrastructure\Url\FrontofficeRoutes` /
`Presentation\Search\FrontofficeSearchSuggestions`.
Contratto: [container0-index-shell-contract.md](./container0-index-shell-contract.md) (D20).
Regola: [reusable-components.md](../rules/reusable-components.md) (D32).

Le pagine CMS di primo livello, inclusa `domande-frequenti.index`, non hanno
una propria view Folio in `pages/{container0}/index.blade.php`: il routing è
unico e il contenuto è scelto dai blocchi JSON. Il blueprint Filament del tema
resta quindi **N/A per Resource**, ma il contratto di mount viene verificato da
`FolioPageMountContractTest` (niente file dedicato, niente `if` sul nome del contenitore) e `NoSemanticFolioPageDirectoriesTest` (niente cartelle fuori da `auth`, `[container0]`, `tests`). Il caso FAQ: [why-domande-frequenti-blade-php-must-not-exist.md](./knowledge/why-domande-frequenti-blade-php-must-not-exist.md). Il caso profilo (D34): **mai** `pages/profile/edit.blade.php` nel tema — FO «Impostazioni» = `FrontofficeRoutes::personalAreaImpostazioni()` → JSON `area-personale.impostazioni` ([why-profile-edit-blade-must-not-exist.md](./knowledge/why-profile-edit-blade-must-not-exist.md)).

I widget Filament FO (commenti, wizard ticket, ecc.) entrano **solo** se un blocco
JSON CMS li monta — il tema non decide il dominio.

L'accesso pubblico segue la stessa regola: `pages/auth/login.blade.php` chiede lo slug `auth.login` e il blocco monta `LoginWidget` (modulo User: email, password rivelabile di Filament, «Ricordami», submit). L'occhio sulla password è la suffix action del campo, non un bottone del tema. «Ricordami» resta il `Checkbox` Filament: il foglio Design Comuni azzera l'aspetto di ogni input, quindi il riquadro visibile sta sulle classi `.fi-checkbox-input`. Il vestito non è una card del tema: è la grammatica di [accesso-servizio](https://github.com/italia/design-comuni-pagine-statiche/blob/main/src/pages/servizi/accesso-servizio.hbs), e il form è il blocco «Altre utenze». SPID e CIE non si montano finché un modulo owner non esiste. Piano: [auth-login-design-comuni.md](../plans/auth-login-design-comuni.md). «Accedi con Google» è href localizzato via `oauth.redirect` + `lang` ([oauth-login-locale-fix.md](./plans/oauth-login-locale-fix.md)); il tema non inventa path senza prefisso lingua.

La callback `/auth/login/{provider}/callback` è una pagina Folio+Volt
redirect-only: il tema gestisce il guscio e delega a
`Modules\\User\\Actions\\Socialite\\ProcessCallbackAction`. Non è una Resource
Filament né una policy nel tema; non si crea una route parallela in `web.php` o
nel modulo User.

La registrazione pubblica segue la stessa regola: `pages/auth/register.blade.php`
chiede lo slug `auth.register` e il blocco include
`components/pages/auth-register.blade.php`, che monta il widget GDPR. Titolo e
intro stanno nelle traduzioni del modulo Fixcity, non duplicati nel JSON.

## i18n FO (obbligatorio)

Locali: `it|en|de|es`. Chrome del tema solo via `pub_theme::` (pattern
`context.collection.element.type`, es. `header.user.dropdown.logout.label`,
`navigation.homepage.news`). Dominio prodotto nel modulo owner. Vietato
stringhe UI nel Blade e `->label()` Filament. URL: `route('container0…')`
non `localizeUrl`. Canon:
[frontoffice-link-conventions.md](../../../../Modules/Fixcity/docs/frontoffice-link-conventions.md) ·
[translation-key-governance.md](../../../../Modules/Lang/docs/wiki/rules/translation-key-governance.md).

## Consentito

- Mount `@livewire` / widget Filament modulo con props tipizzate (dai blocchi)
- View Blade del tema che passano solo dati gia autorizzati dal modulo
- Stack FO: Tailwind + DaisyUI + Flowbite + Lit + Alpine (no Bootstrap target)

## Asset statici del tema

`public/` e' l'`outDir` di `vite build`, non un posto dove lasciare file. Lo sprite delle icone FO (`resources/static/.../sprites.svg`) lo emette Vite con `publicDir`, URL stabile per i `<use href="...#it-…">`. Non e' un `FilamentAsset`: il blueprint del tema non possiede Resource, e gli asset del pannello restano nel modulo owner (Xot pubblica `header-actions-wrap.css` in `public_html/assets/xot/`).

## Vietato

- `Themes/Sixteen/app/Filament/Resources/*`
- Depositare SVG o CSS a mano in `public/` fuori da `vite build`
- Duplicare policy/Actions nel tema
- Nascondere sezioni FO quando il contratto owner dice "sempre montato"
- Logica lista/utility hardcoded nella Folio page al posto del JSON `{slug}.index`
- Cartella `pages/<nome-pagina>/` nel tema (`pages/domande-frequenti/` ruba `/it/domande-frequenti` a `[container0]`; `pages/profile/` è alias morto creato ≥3 volte — vietato)
- CSS `main[data-page="…"]`: il vestito è del componente (`.cmp-*` dentro `.page-content[data-dc]`), non del nome della pagina

## Widget tipici consumati

- mount widget moduli (CommentsWidget, ecc.) — nessuna Resource nel tema

## PHPStan (tema)

Il tema non lancia gate Filament propri: PHPStan colpisce Blade/Volt/ test sotto `Themes/Sixteen`. Durante le wave swarm, aggiornare `docs/bmad/` in parallelo al codice (decision-log, blueprint) senza toccare `phpstan.neon`. Ordine permanente monorepo: [phpstan-modules-zero-standing-order](../../../../Modules/Xot/docs/wiki/memories/phpstan-modules-zero-standing-order.md). `graphify-out/` del tema: [graphify-out-gitignore](../../../../Modules/Xot/docs/bmad/graphify-out-gitignore.md) (D30).

## Related

- Planning: [bmad-planning.md](../bmad-planning.md)
- Brainstorming: [bmad-brainstorming.md](../bmad-brainstorming.md)
- Decision log: [decision-log.md](./decision-log.md)
- Shell contract: [container0-index-shell-contract.md](./container0-index-shell-contract.md)

## No Support

Tema e moduli: zero `app/Support/`. Layer FO = Infrastructure/Presentation/Actions. Canon: [second-brain process](../../../../../docs/second-brain/process/no-app-support-queueable-actions.md) · [support-deep-audit](../../../../Modules/Xot/docs/bmad/support-deep-audit.md).

## Governance della documentazione

`docs/archive/` non e' input per il rendering, widget o Resource: ogni root di
modulo/tema lo ignora per applicare la regola Second Brain. Il blueprint del tema
documenta solo l'impatto nullo sul panel; contenuti attivi e storia wiki seguono
la [regola canonica no-docs-archive](../../../../../bashscripts/ai/wiki/concepts/no-docs-archive-rule.md).

## Area personale FO (chrome condiviso)

Le quattro pagine CMS `area-personale.{pratiche,seguite,notifiche,impostazioni}` montano blocchi tema
che **devono** passare da `components/blocks/personal-area/heading.blade.php` (include della nav
`cmp-nav-tab`). Vietato reincludere la nav nelle settings. Contratto:
[personal-area-shared-nav-tabs-contract.md](../wiki/concepts/personal-area-shared-nav-tabs-contract.md) ·
[why-personal-area-tabs-must-be-identical.md](./knowledge/why-personal-area-tabs-must-be-identical.md).

## Chrome brand (header = footer)

Il tema veste `brand.logo` con un solo partial
`components/sections/partials/brand-mark.blade.php` (header, footer, hamburger).
JSON SSoT + guard Pest: [header-footer-sections-contract.md](./header-footer-sections-contract.md).
Colori slim `#00402b` + Accedi primary `#007a52`/testo bianco (parity fixcity.eu) / center `#007a52` + niente fascia bianca breadcrumb + slim senza overlay
hamburger (lingua/Accedi sempre visibili, WCAG):
[header-color-contract.md](./header-color-contract.md) ·
[fo-header-white-band.md](../../../../../docs/second-brain/fo-header-white-band.md).

## Homepage desiderabilità (civic-first)

Studio `pages_old/index` (ritmo, mappa, task CTA) senza restore: atmosfera verde ente,
Lora H1, trust line, map card elevata. Contratto:
[homepage-guest-visual-contract.md](./homepage-guest-visual-contract.md) ·
[civic-homepage-conversion-playbook.md](../marketing/civic-homepage-conversion-playbook.md).

## Homepage track CTA (WCAG)

Le due CTA della banda `.fc-track-section` usano `.fc-track-section__btns`
(stack + gap 1rem, min-height 44px). Non affidarsi a `d-flex`/`gap-*` sotto
`data-dc`. Contratto: [homepage-guest-visual-contract.md](./homepage-guest-visual-contract.md).

## Pagina FO `/tickets/track`

Vestito tema: `components/pages/ticket-track.blade.php` + `21-ticket-track.css`.
Niente Resource Filament. Domini/Actions in Fixcity. Layout DC:
[tracking-search-form-layout.md](./tracking-search-form-layout.md).

