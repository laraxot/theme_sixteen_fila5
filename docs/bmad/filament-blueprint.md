---
title: "Filament Blueprint — Theme Sixteen"
type: filament-blueprint
status: active
theme: Sixteen
created: 2026-10-16
updated: 2026-10-20
tags: [bmad, filament, blueprint, theme, sixteen, folio, x-page]
qmd: "filament blueprint theme sixteen widget mount no resource folio shell"
related:
  - ../bmad-planning.md
  - ../bmad-brainstorming.md
  - ./container0-index-shell-contract.md
  - ./decision-log.md
---

# Scopo

Il tema **Sixteen** non possiede Resource Filament. Compone pagine Folio/Volt e puo
montare widget Filament **dei moduli owner** con props canoniche.

## FO shell (lista container)

`pages/[container0]/index.blade.php` è solo trasporto: Volt + `<x-page>`.
Nessuna Resource, nessun `match` dominio, nessun layout dinamico nel tema.
Contratto: [container0-index-shell-contract.md](./container0-index-shell-contract.md) (D20).

Le pagine CMS di primo livello, inclusa `domande-frequenti.index`, non hanno
una propria view Folio in `pages/{container0}/index.blade.php`: il routing è
unico e il contenuto è scelto dai blocchi JSON. Il blueprint Filament del tema
resta quindi **N/A per Resource**, ma il contratto di mount viene verificato da
`FolioPageMountContractTest` (niente file dedicato, niente `if` sul nome del contenitore) e `NoSemanticFolioPageDirectoriesTest` (niente cartelle fuori da `auth`, `[container0]`, `tests`). Il caso FAQ: [why-domande-frequenti-blade-php-must-not-exist.md](./knowledge/why-domande-frequenti-blade-php-must-not-exist.md).

I widget Filament FO (commenti, wizard ticket, ecc.) entrano **solo** se un blocco
JSON CMS li monta — il tema non decide il dominio.

L'accesso pubblico segue la stessa regola: `pages/auth/login.blade.php` chiede lo slug `auth.login` e il blocco monta `LoginWidget` (modulo User: email, password rivelabile di Filament, «Ricordami», submit). L'occhio sulla password è la suffix action del campo, non un bottone del tema. Il vestito non è una card del tema: è la grammatica di [accesso-servizio](https://github.com/italia/design-comuni-pagine-statiche/blob/main/src/pages/servizi/accesso-servizio.hbs), e il form è il blocco «Altre utenze». SPID e CIE non si montano finché un modulo owner non esiste. Piano: [auth-login-design-comuni.md](../plans/auth-login-design-comuni.md). «Accedi con Google» è href localizzato via `oauth.redirect` + `lang` ([oauth-login-locale-fix.md](./plans/oauth-login-locale-fix.md)); il tema non inventa path senza prefisso lingua.

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
[frontoffice-link-conventions.md](../../../Modules/Fixcity/docs/frontoffice-link-conventions.md) ·
[translation-key-governance.md](../../../Modules/Lang/docs/wiki/rules/translation-key-governance.md).

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
- Cartella `pages/<nome-pagina>/` nel tema (`pages/domande-frequenti/` ruba `/it/domande-frequenti` a `[container0]`)
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
