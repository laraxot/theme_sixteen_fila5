---
id: dl-sixteen-design-comuni-redesign
title: "Decision Log — Redesign Design Comuni Tema Sixteen"
type: decision-log
status: active
created: 2026-10-11
updated: 2026-10-22
owner: "@team-fixcity"
links:
  github_issue: "#150"
  architecture: "arc-sixteen-design-comuni-redesign"
tags: [docs, sixteen, bmad]
qmd: "decision log   redesign design comuni sixteen"
---

# Decision Log — Redesign Design Comuni

## 2026-10-27 — Story client camera separata dal fallback Media

- **Decisione:** Sixteen possiede la normalizzazione client-side; Media possiede il fallback Imagick. I due percorsi condividono il contratto Fixcity ma non duplicano ownership.
- **Riferimento:** [story CAM-1.2](./stories/CAM-1.2-browser-normalization-livewire.story.md) e [epic cross-module](../../../Modules/Fixcity/docs/bmad/epics/mobile-camera-upload.epic.md).

## D35: Header slim, "Demo" come regione e avatar come il riferimento (2026-10-26)

- **Decisione:** nella fascia slim, dove il riferimento Design Comuni scrive "Nome della Regione", il tenant dimostrativo mostra "Demo". E' un testo, non un link: senza URL la Blade emette `<span class="navbar-brand">` senza `href`, `aria-label` o `title`.
- **Contenuto:** `config/local/fixcity/database/content/sections/header.json`: `region.name` per lingua (it, en, de, es), `region.title` e `region.aria_label` scritti attorno a "Demo" (nessun segnaposto `{Nome della Regione}`), `account.label` per il pulsante. La Blade e' il vestito: nessun testo.
- **Precedenza:** se l'ente fornisce `region_name` / `region_url` via `config('ente')` (GetEnteDataAction, DCP-289) vince l'ente. `RegionPortalLinkLabels::resolve($region, $ente->region_name)` fa seguire il nome al titolo e all'aria-label del link (WCAG 2.5.3, nome visibile contenuto nel nome accessibile). I tenant reali non vedono mai "Demo".
- **Eccezione al divieto DCP-289:** `NoFakeEnteDataInFrontOfficeContentTest` ammette SOLO `region.name = Demo` in header.json (nessun altro valore e nessun `region.url`). In `EnteDataFrontOfficeTest` cambia solo l'asserzione sul "Demo": senza dati dell'ente compare una sola volta, come testo nella fascia slim; restano invariati gli altri controlli (`href="#"`, numeri finti, segnaposto).
- **Avatar:** le misure sono quelle del riferimento, non inventate. Cerchio bianco 24px (`.rounded-icon`), icona `icon-primary` 18px verde #007a52 (5,38:1 sul bianco), etichetta 16px/600 da lg, pulsante 251x48 a 1440 (come il riferimento), 48x48 sotto lg (target >= 44). Hover e focus #006342, come il riferimento (testo bianco 7,3:1): il vecchio #00966a dava 3,8:1. Annullato il tentativo del disco 28px con bordo bianco, in cui l'icona era bianca su bianco.
- **Come tornare indietro:** togliere `region.name` da header.json (la fascia mostra allora solo i dati dell'ente) e ripristinare nel test NoFake il vecchio divieto `region.(name|url) = .`. L'avatar e' solo CSS in `resources/css/app/22-header-shell.css`.
- **Verifica:** `HeaderSlimBarContractTest` e i test header di Sixteen e Fixcity; pixel a 375, 768 e 1440 px, in quattro lingue, ospite e loggato. Studio e misure in `header-design-comuni-study.md`.

## D34: Mai `pages/profile/edit.blade.php` nel tema Sixteen

<!-- GateGuard: supersede = fo-folio-links che diceva «linka profile.edit»; linked from why-profile-edit + filament-blueprint + NoSemanticFolioPageDirectoriesTest; user: «creare …/pages/profile/edit.blade.php e' sbagliato! … non commettere mai piu'… bmad + second brain + filament blueprint» -->

**Contesto:** l’alias Folio `Themes/Sixteen/.../pages/profile/edit.blade.php` è stato
ricreato almeno tre volte per «riparare» un 404; Folio letterale compete col
modulo User e col CMS `area-personale.impostazioni`.
**Decisione:** vietato nel tema. FO Design Comuni «Impostazioni» =
`FrontofficeRoutes::personalAreaImpostazioni()` → `container0.view`
area-personale/impostazioni. Owner account: `Modules/User/...` se serve, mai
copia nel tema. Enforcement: Pest esplicito su `profile*`, hook
`theme-pages-guard.sh`, knowledge [why-profile-edit-blade-must-not-exist.md](./knowledge/why-profile-edit-blade-must-not-exist.md).
**Rationale:** religione `pages/` (solo auth/container0/tests) + Filament way
(tema veste, JSON+widget owner) + DRY (un solo percorso impostazioni FO).
**Stato:** attivo 2026-10-22.

## D33: Audit UI/UX FO vs Design Comuni — fix `data-dc` + no Gravatar

<!-- GateGuard: supersede = findings aperti in compliance/04-audit; linked from 04-audit + filament-blueprint; user: «devi analizzare tutta la ui/ux di tutto il front office… DesignComuni… bmad + second brain + filament blueprint» -->

**Contesto:** riverifica sera su `fixcity.eu`: home e `/tickets/track` senza `data-dc`;
commenti con Gravatar (terzi); breadcrumb aria hardcoded; CTA `/contatti`.
**Decisione:** home + track nel telaio DC; avatar iniziali locali; breadcrumb i18n nel
partial condiviso; assistenza → `/tickets/create`. Canon audit:
[04-audit-ui-ux-design-comuni.md](../compliance/04-audit-ui-ux-design-comuni.md).
**Rationale:** coerenza Design Comuni = scope CSS + privacy + riuso (Filament way).
**Stato:** attivo 2026-10-22 sera. Aperti restanti: D-01 services Tailwind, A-02 search
modal home, C-* auth, B mappa.

## D32: FO riusabile — Infrastructure/Presentation + Action fuori dalla shell Folio

<!-- GateGuard: supersede = D32 bozza “Support + Action” (stesso giorno); linked from reusable-components.md, filament-blueprint.md, wiki/log.md; user: “devi sempre cercare di creare componenti riutilizzabili questa e' una regola che devi sempre seguire, fa tutto con bmad + second brain + filament blueprint” -->

**Contesto:** alias Design Comuni, redirect `area-personale` e default search-modal
vivevano inline nei Blade (`foIndexAliases`, `route('container0…')` ripetuti).
**Decisione:** estrarre pezzi riusabili fuori dalla shell:
`Infrastructure\Url\FrontofficeContainerAliases` + `FrontofficeRoutes`,
`Presentation\Search\FrontofficeSearchSuggestions`,
`Actions\Folio\ResolveContainer0IndexAction`. La Folio page chiama solo l'Action.
Standing rule: [reusable-components.md](../rules/reusable-components.md).
**Rationale:** DRY/KISS + Filament way (shell sottile) + allineamento layer
Presentation/Infrastructure (ex `Support/`).
**Stato:** attivo 2026-10-22. Blueprint: [filament-blueprint.md](./filament-blueprint.md).

## D31: conflitti merge docs FAQ + prompt 04 risolti a mano

**Contesto:** lane parallele avevano lasciato marker `<<<<<<<` in
[faq-route-ownership.md](./faq-route-ownership.md) e [prompts/04.md](../prompts/04.md).
**Decisione:** unire entrambe le versioni (composizione `content-page` + knowledge
why-blade; regola CMS FAQ + «Errori già pagati»; matrice stato e registro unificati).
**Rationale:** no auto-merge cieco; contratto FAQ e runbook FO devono restare KISS/DRY.
**Stato:** risolto 2026-10-20 sera.

## D30: `graphify-out/` ignorato nel tema (no LFS)

**Contesto:** graphify scrive `Themes/Sixteen/graphify-out/` in locale; non e' asset FO Design Comuni.
**Decisione:** `graphify-out/` nel `.gitignore` del tema; se tracciato → `git rm --cached -rf graphify-out`. Mai Git LFS.
**Rationale:** artefatto generato; il tema veste Filament/FO, non versiona il grafo. Canon: [graphify-out-gitignore](../../../../Modules/Xot/docs/bmad/graphify-out-gitignore.md).
**Stato:** attivo 2026-10-20. Hub Auth: [README.md](./README.md#auth--login--oauth-fo).

Indice rapido Auth/Login + igiene tooling (dettaglio sotto; hub in [README.md](./README.md)):

| ID | Tema | Stato |
|----|------|-------|
| D34 | Mai `pages/profile/` nel tema — FO impostazioni = area-personale | attivo 2026-10-22 — [why-profile-edit](./knowledge/why-profile-edit-blade-must-not-exist.md) |
| D31 | Conflitti merge FAQ + prompt 04 risolti a mano | risolto 2026-10-20 sera |
| D30 | `graphify-out/` in `.gitignore` tema (no LFS) | attivo — [graphify-out-gitignore](../../../../Modules/Xot/docs/bmad/graphify-out-gitignore.md) |
| D27 | Google OAuth FO con prefisso lingua | fix working tree — [oauth-login-locale-fix.md](./plans/oauth-login-locale-fix.md) |
| D26 | Checkbox «Ricordami» visibile sotto `data-dc` | working tree + build — [dcp-268](./stories/dcp-268-login-checkbox-e-occhio-password-dentro-data-dc.story.md) |
| D25 | Occhio password = `revealable()` Filament | live |
| D24 | Login = accesso-servizio, non card | censito |

## D29: Gate PHPStan Modules — rieseguito OK (2026-10-20, audit docs tema)

**Contesto:** standing order Modules a zero; turno docs su tema Sixteen + moduli random (User, Comment, Notify, Activity).
**Decisione:** registrare verifica `phpstan analyse` sui moduli owner del FO (batch quattro moduli → exit 0); docs `bmad/` conformi a `md-filenames.py check` (0 date/suffissi); sotto `docs/bmad/` restano ~79 legacy con maiuscole (story `STORY-DEFECT-*`, `DC-027.*`) — segnalazione senza rinomina finche' il tool non propone target sicuri.
**Track:** memoria [phpstan-modules-zero-standing-order](../../../../Modules/Xot/docs/wiki/memories/phpstan-modules-zero-standing-order.md), hub [00-INDEX.md](../00-INDEX.md), regola architettura [CSS-SCOPING-RULE.md](../architecture/css-scoping-rule.md) (nome legacy maiuscolo, contenuto canonico).
**Stato:** OK al 2026-10-20.

## D28: PHPStan swarm — docs tema in parallelo al codice

**Contesto:** wave PHPStan multi-agente sul monorepo; agenti doc-updater migliorano `Themes/Sixteen/docs/` mentre altre lane fixano sorgente.
**Decisione:** registrare qui le decisioni FO (login, FAQ, shell) e aggiornare [filament-blueprint.md](./filament-blueprint.md) quando cambia il contratto di mount widget; non creare `.neon` ne' documentazione in `bmad-output/`.
**Rationale:** il tema veste moduli owner; la memoria operativa del gate vive in Xot ([phpstan-modules-zero-standing-order](../../../../Modules/Xot/docs/wiki/memories/phpstan-modules-zero-standing-order.md)) e nei prompt [00-start](../../../../../bashscripts/docs/prompts/00-start.md) / [11-phpstan](../../../../../bashscripts/docs/prompts/11-phpstan.md).
**Stato:** attivo per ogni turn non banale con qualita' in scope.

## D27: Google login FO = URL con prefisso lingua (`/it/auth/login/google`)
**Contesto**: su `fixcity.eu/it/auth/login` il bottone «Accedi con Google» puntava
a `/auth/login/google` (senza `it`). La callback console è
`/it/auth/login/google/callback`. Un Folio stub usava `segment(3)` e faceva 404
sul callback localizzato.
**Decisione**: SSoT `oauth.redirect` / `oauth.callback` in
`Modules/User/routes/socialite.php` (`{lang}/auth/login/{provider}`). Il bottone
Sixteen genera `route('oauth.redirect', ['provider' => 'google', 'lang' => $locale])`.
I controller dichiarano `string $lang, string $provider` con `Illuminate\Http\Request`
(non la Facade). Le pagine Folio sotto `pages/auth/login/[provider]/` delegano
ai controller e non reclamano i nomi di rotta.
**Rationale**: FO sempre localizzato; entry e callback devono condividere la lingua
e l’URI registrato su Google. Senza `$lang` nel `__invoke`, Laravel lega `it` a
`$provider` → `ProviderNotConfigured("it")`. Filament Blueprint: dominio User,
tema solo vestito + href.
**Stato**: fix nel working tree NAS — [oauth-login-locale-fix.md](./plans/oauth-login-locale-fix.md).
Prod `fixcity.eu` (46.225.90.178) è copia separata: serve sync + `view:clear`.

## D24: Login — la pagina di riferimento è accesso-servizio, non una card
**Contesto**: `/it/auth/login` è una card bianca da 36rem con form Filament e uno `<style>` privato. Il riferimento [accesso-servizio.hbs](https://github.com/italia/design-comuni-pagine-statiche/blob/main/src/pages/servizi/accesso-servizio.hbs) è `cmp-heading` (h1 40px), poi blocchi `cmp-text-button` (SPID, CIE, Altre utenze), poi `cmp-contacts`. Due documenti (User e second brain) prescrivevano card, blu `#0066CC` o gradient e bottoni SPID.
**Decisione**: il vestito segue quella pagina. L'email è il blocco «Altre utenze». SPID e CIE non si disegnano finché un modulo non li possiede. `LoginWidget` resta il dominio. Niente `<style>` di pagina e niente `main[data-page]`.
**Rationale**: il comune riconosce l'accesso dai componenti, non da una scheda. Un bottone SPID senza provider è una bugia.
**Stato**: censito — [auth-login-design-comuni.md](../plans/auth-login-design-comuni.md). Il vestito live è ancora la colonna del 2026-10-20.

## D25: Occhio password = suffix Filament `revealable()`, non del tema
**Contesto**: richiesta di password rivelabile su `/it/auth/login` alla Filament way
([revealable password inputs](https://filamentphp.com/docs/5.x/forms/text-input#revealable-password-inputs)).
Già in `UserForm::getLoginFormSchema()`; lo sheet FO non dipinge `.fi-input-wrp`
sotto `data-dc`, quindi l'occhio finiva sotto il campo.
**Decisione**: dominio = `->password()->revealable()` nel modulo User. Sixteen
sistema solo il flex della suffix action in `.auth-login-card`. Niente toggle
Alpine del tema. Non duplica [login-ux-fixes.md](../auth/login-ux-fixes.md) né
[filament-blueprint.md](./filament-blueprint.md): qui resta la decisione.
**Rationale**: Filament Blueprint — il tema veste, User possiede il campo.
**Stato**: live su fixcity.eu; guardrail `LoginPasswordRevealableTest`.

## D26: Checkbox «Ricordami» = Filament `Checkbox`, visibile sotto data-dc
**Contesto**: su `/it/auth/login` il `Checkbox::make('remember')` è nel DOM ma
invisibile. DC applica `appearance: none !important` a ogni `input` sotto
`data-dc`; le utility Filament del checkbox non dipingono.
**Decisione**: dominio invariato (`UserForm::getLoginFormSchema()`). Vestito:
`appearance: auto !important` + `-webkit-appearance: checkbox !important` nello
`<style>` di `components/pages/auth-login.blade.php` **e** in
`resources/css/app/20-dc-components.css` (regole già scoped a
`.page-content[data-dc]`, quindi non isolate dal PostCSS legacy). Niente
toggle HTML custom. Story: [dcp-268](./stories/dcp-268-login-checkbox-e-occhio-password-dentro-data-dc.story.md).
**Rationale**: Filament Blueprint — User possiede il campo; Sixteen solo lo
rende leggibile nel perimetro Design Comuni.
**Stato**: fix nel working tree NAS + `npm run build`. Prod `fixcity.eu`
(`46.225.90.178`) ha copia asset/Blade separata: serve sync tema +
`php artisan view:clear` sul server. Guardrail: `AuthLoginStyleContractTest`.

## D23: FAQ = JSON che compone blocchi condivisi, nessun CSS di pagina
**Contesto**: dopo D22 la FAQ restava un blocco monolitico `faq-page`
(`components/pages/faq.blade.php`) con utility Tailwind, `<style>` inline e CSS
`main[data-page="domande-frequenti"]`. Misurato il 2026-10-20: HTML 11,59% vs
`domande-frequenti.html` (la replica composta `/it/tests/domande-frequenti`:
99,31%); su `data-dc` le utility sono spente da
`postcss/isolate-legacy-important.cjs` (titolo rating 40px, contenitore 1280px,
stelle 0×0); `faq-parity.css` = 700 righe mai applicabili.
**Decisione**: la pagina compone il blocco `content-page/design-comuni`
(sezioni `search` + `accordion` con `source: faq`, `feedback`, `contacts`) con
copy per lingua nel JSON; niente `parity_page`, niente CSS/JS di pagina, niente
utility Tailwind su pagine `data-dc`; filtro e «carica altre» sono flag
opzionali dei componenti condivisi. **Supera la clausola «blocco `faq-page`» di
D22**; resta valida la rimozione della Folio concorrente, estesa al file omonimo.
**Rationale**: il riferimento assembla componenti `cmp-*` con SCSS per
componente e nessuna regola di pagina; il riuso sta nel componente; il CSS non
cresce. Vedi [shared-block-composition-no-page-css](../wiki/concepts/shared-block-composition-no-page-css.md).
**Stato**: ✅ locale e verificato — [DCP-260](./stories/dcp-260-faq-composizione-blocchi-condivisi.story.md);
⏳ build, rilascio e rimozione del monolite (T1–T3).

## D22: FAQ senza route Folio esplicita concorrente
**Contesto**: `domande-frequenti.index` è una pagina CMS di primo livello,
quindi `/it/domande-frequenti` è già servita dalla shell generica
`pages/[container0]/index.blade.php`. Una view aggiuntiva in
`pages/domande-frequenti/index.blade.php` duplicava il routing e poteva
selezionare una sorgente diversa dal JSON tenant.
**Decisione**: la view speciale resta assente. La FAQ è il blocco
`content-page` del JSON `domande-frequenti/index.json` (accordion
`source: faq`). I test `FolioPageMountContractTest` e
`NoSemanticFolioPageDirectoriesTest` impediscono il ritorno della cartella.
Perché: [why-domande-frequenti-blade-php-must-not-exist.md](./knowledge/why-domande-frequenti-blade-php-must-not-exist.md).
**Rationale**: Folio trasporta, CMS risolve lo slug, il blocco renderizza il
dominio. È il contratto `container0.index` e la regola Filament Blueprint del
tema; nessun dominio va duplicato nella pagina Folio.
**Stato**: ✅ Corretto e verificato con test di contratto + browser smoke.

## D21: `/it/blog` parity `lista-risorse.html` (body only)
**Contesto**: lista Novità “si vedeva male”: CSS DC spento (`data-dc` assente),
`listing-parity` stilizzava il breadcrumb come card, markup featured spezzato.
**Decisione**: shell con `data-dc` + `body-page=lista-risorse`; blocco allineato
a lista-risorse.html (HTML≥90%/visual≥95% tranne header/footer); CSS lista-risorse
riscritto su `cmp-hero`/`card-wrapper`/`bg-grey-card`.
**Rationale**: Sixteen è Design Comuni; parity sul body, chrome da JSON sections.
**Stato**: ✅ Confirmato — [blog-public-index.md](./blog-public-index.md)

## D20: Folio `container0.index` = shell JSON-only
**Contesto**: `[container0]/index.blade.php` accumulava `match` native/utility,
`@include` di `components/pages/*`, `x-dynamic-component` sul layout e fetch CMS
in `@php` — seconda verità rispetto ai JSON tenant.
**Decisione**: shell Volt minimale (`name` + `PageSlugMiddleware` + `mount` +
`<x-layouts.app>` + `<x-page>`). Contenuto solo da slug `{container0}.index`.
Chiusura tag = `</x-layouts.app>` (mai residuo `</x-dynamic-component>`).
`.page-content` porta sempre `data-dc`. Fuori `@volt` niente `$this` (usa
parametri Folio tipo `$container0` per `body-page`).
Utility FO hanno JSON `{container}.index` dedicati.
**Rationale**: DRY + KISS + religione pages/ (tema = vestito, Cms = contenuto);
allinea Filament way e parallelismo BMAD.
**Stato**: ✅ Confirmato — [container0-index-shell-contract.md](./container0-index-shell-contract.md)

## D19: Footer JSON SSoT (DCP-222 / DCP-198 A5)
**Contesto**: Footer mostrava «Nome del Comune» e voci morte come link.
**Decisione**: Come header — contenuto in `footer.json`; Blade solo vestito;
URL vuoti non emessi; FixCity brand+slogan; social/UE vuoti.
**Rationale**: D11 + Ponytail; accessibilita' (niente `<a>` nudi).
**Stato**: ✅ Confirmato — `dcp-222-footer-json-ssot-vestito.story.md`

## D18: Tipografia FO — Lora hero + Titillium 600 (DCP-221)
**Contesto**: H1 poco leggibile; BI impone Titillium / Lora / Roboto Mono.
**Decisione**: H1 home = **Lora Regular 400** (`.font-serif`), scale BI h1,
lh 1.2; sans UI = Titillium 600. Font via Vite local (`fonts.css` relative url,
DCP-183). Token `--font-serif` / `--dc-font-serif` = Lora.
**Rationale**: Bootstrap Italia tipografia + WCAG; Lora nato per lettura display;
niente peso 600 su Lora (non self-hosted).
**Stato**: ✅ Confirmato — story `dcp-221-homepage-tipografia-leggibilita-wcag.story.md`
**Nota 2026-10-20**: regressione a Titillium 700 nel civic-reframe CSS; ripristinata
Lora 400 + rebuild. Guardia: `FontsCssGuardTest`. Prompt operativo: `docs/prompts/04.md`.

## D1: Script non in laravel/scripts/ ma in bashscripts/
**Contesto**: Richiesta esplicita dell'utente.
**Decisione**: Tutti gli script di audit, build, design-comuni, accessibilità vanno in sottocartelle di `/bashscripts/` (es. `bashscripts/design-comuni/`, `bashscripts/audit/`). Documentati in `bashscripts/docs/`.
**Rationale**: Separazione tra codice applicazione (laravel) e strumenti di sviluppo/validazione. Rispetta la struttura esistente del repo.
**Stato**: ✅ Confirmato

## D2: Docs design system non a radice ma in laravel/Themes/Sixteen/docs/
**Contesto**: L'utente ha corretto l'errore di creare `/design-system/` a radice.
**Decisione**: Documentazione del design system, BMAD, implementazione, script documentati dentro `laravel/Themes/Sixteen/docs/` con struttura `bmad/`, `design-system/`, `implementation/`, `scripts/`.
**Rationale**: Il design system appartiene al tema Sixteen, che è già il tema Design Comuni. Non è un progetto separato.
**Stato**: ✅ Confirmato — file creato `laravel/Themes/Sixteen/docs/bmad/architecture.md`

## D3: Design-comuni.blade.php non duplicato (Sixteen già Design Comuni)
**Contesto**: `resources/views/layouts/design-comuni.blade.php` NON esiste; il tema usa `design-comuni/pages/homepage.blade.php`. L'utente ha spiegato che Sixteen è già il tema Design Comuni.
**Decisione**: NON creare un nuovo `design-comuni.blade.php`. Migliorare `resources/views/design-comuni/pages/homepage.blade.php` e i layout `base.blade.php` / `main.blade.php`. Documentare la logica in `docs/bmad/architecture.md`.
**Rationale**: Evitare duplicazione. Sixteen è già il tema di riferimento per Design Comuni.
**Stato**: ✅ Confirmato

## D4: Stack — NO Bootstrap, only Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament
**Contesto**: Richiesta esplicita. Bootstrap Italia è solo riferimento visivo (grafica), mai stack implementativo.
**Decisione**: Tutta la UI front-end usa Tailwind utilities + DaisyUI components + Flowbite extras + Lit web components + Alpine.js per interattività. Filament solo per admin/back-office. Bootstrap Italia NON importato come CSS/JS.
**Rationale**: Modern approach, lighter bundle, full control over tokens, no legacy framework lock-in.
**Stato**: ✅ Confirmato

## D5: Approccio Homepage — Lit-First (Variante C)
**Contesto**: Brainstorming (3 varianti).
**Decisione**: Usa Variante C (Lit Web Components per elementi ricorrenti + composizione Tailwind). Componenti: `<muni-navbar>`, `<muni-footer>`, `<muni-hero>`, `<muni-card-news>`, `<muni-card-service>`, `<muni-breadcrumb>`, `<muni-chip>`, `<muni-read-more>`, `<muni-skip-links>`.
**Rationale**: Design system reale, riutilizzabilità massima, testabilità isolata, coerenza con stack moderno.
**Stato**: ✅ Confirmato — da implementare in E01/E02

## D6: Pagina Segnalazione — Wizard Alpine (Variante A)
**Contesto**: Priorità massima (pagina `#segnalazione` di Design Comuni), 5 step (categoria → posizione → dettagli → contatti → riepilogo).
**Decisione**: Multi-step wizard con Alpine.js (`x-data="reportWizard()"`), validazione per step, mappa Leaflet per posizione, allegati foto, tracking codice riferimento. State management via Alpine store locale.
**Rationale**: UX guidata, accessibile, coerenza con flussi di servizio Design Comuni (graduatorie, permessi, prenotazioni).
**Stato**: ✅ Confirmato — da implementare in E04

## D7: Accessibilità — MAUVE valida ogni pagina, WCAG 2.1 AA come floor
**Contesto**: `https://mauve.isti.cnr.it/` caricata (WCAG 2.1, 44/78 criteria implementati). Design Comuni richiede inclusività PA.
**Decisione**: Ogni pagina validata con MAUVE prima del merge. Checklist: contrast APCA Lc ≥75 body, focus-visible su tutti interattivi, skip links, ARIA labels, semantic HTML, `prefers-reduced-motion` per animazioni.
**Rationale**: PA (Pubblica Amministrazione) richiede accessibilità obbligatoria. Non è opzionale.
**Stato**: ✅ Confirmato — script `bashscripts/design-comuni/audit-accessibility.sh` da creare

## D8: Design tokens — estratti da Design Comuni, non inventati
**Contesto**: `https://designers.italia.it/kit/comuni/` e `UI Kit Italia`.
**Decisione**: Token color, typography, spacing, radius, elevation definiti in `design-system/tokens.md` basandosi su Design Comuni v2.4.0. Nessun valore off-system. Accent unico (colore istituzionale PA, non viola/indigo).
**Rationale**: Design Comuni ha palette e regole precise. Inventare token = deviazione.
**Stato**: ⏳ Da creare in E01

## D9: Scripts in bashscripts/ + docs in bashscripts/docs/
**Contesto**: User request esplicita.
**Decisione**: `bashscripts/design-comuni/` per script audit/build; `bashscripts/docs/` per documentazione script. Nessun file in `laravel/scripts/`.
**Rationale**: Separazione chiara, rispetto regole repo.
**Stato**: ⏳ Da creare

## D10: No design-system/ a radice — tutto dentro Sixteen
**Contesto**: User ha corretto l'errore.
**Decisione**: Tutte le cartelle relative al redesign (docs, design-system, scripts, implementation, tests) dentro `laravel/Themes/Sixteen/`. Se serve qualcosa a livello progetto, solo symlink o riferimento, mai copia.
**Rationale**: Il tema è il proprietario della grafica, non il repo.
**Stato**: ✅ Confirmato

## D11: Header e footer sono sections CMS del tema
**Contesto**: Le shell pubbliche chiamano `<x-section slug="header" />` e
`<x-section slug="footer" tpl="full" />`; il CMS passa i blocchi localizzati al
renderer risolto dal tema.
**Decisione**: `header.json` e `footer.json` del tenant sono la fonte dei dati
per logo, nome, slogan, navigazione, lingua, account, contatti, social e link
legali. Sixteen possiede un solo renderer Tailwind/Alpine per ciascuna section;
non si usano `header-comune`, `footer-comune` o view Bootstrap come renderer
paralleli.
**Rationale**: una section è il confine corretto tra contenuto tenant e
presentazione del tema; mantiene SSR, accessibilità e riuso su `app`, `test` e
`guest` senza duplicare Design Comuni.
**Stato**: ✅ Implementato e verificato con view cache, test di localizzazione e
Playwright su 375/768/1440.

## D12: `tests/{slug}` è una route CMS dinamica, non una collezione di Blade
specifiche

**Contesto**: `/it/tests/homepage` era stato interpretato come motivo per
creare `resources/views/pages/tests/homepage.blade.php`. Questo rompe la
responsabilità del CMS e duplica il renderer per ogni pagina Design Comuni.

**Decisione**: `pages/tests/index.blade.php` gestisce esclusivamente il
catalogo `/it/tests`; `pages/tests/[slug].blade.php` gestisce ogni dettaglio,
compreso `homepage`, costruendo lo slug `tests.<slug>`. Il contenuto viene da
`config/local/fixcity/database/content/pages/tests.<slug>.json`; i componenti
riutilizzabili vivono in `resources/views/components/blocks/`.

**Layout**: il catalogo usa esplicitamente `<x-layouts.test>`; il dettaglio
dinamico usa `<x-layouts.app>`. Il campo JSON `layout` resta disponibile per i
wrapper CMS generici allow-listati, non per generare nuove view Folio.

**Rationale**: una route, un contratto CMS, nessuna duplicazione e possibilità
di aggiungere pagine modificando JSON e blocchi universali.

**Stato**: ✅ Confermato; `homepage.blade.php` non esiste.

## D13: nessun sotto-router semantico `tests/segnalazioni`

**Contesto**: creare `pages/tests/segnalazioni/[slug].blade.php` introduce un
secondo albero Folio per una famiglia di pagine, duplicando middleware, Volt,
layout e risoluzione CMS.

**Decisione**: tutti gli URL `/it/tests/{slug}`, inclusi
`/it/tests/segnalazioni-elenco`, `/it/tests/segnalazione-dettaglio` e gli step
del flusso, usano esclusivamente `pages/tests/[slug].blade.php`. Il valore
`slug` è il segmento completo dopo `tests/` e diventa `tests.<slug>`; i dati e
l'ordine dei blocchi arrivano dal JSON tenant corrispondente.

**Rationale**: Folio definisce il routing tecnico, mentre `tests.<slug>` è il
contratto editoriale CMS. Un sotto-percorso Blade chiamato `segnalazioni`
confonderebbe dominio e routing e renderebbe impossibile aggiungere pagine
senza creare nuove view.

**Stato**: ✅ Corretto; rimossi `tests/homepage.blade.php` e
`tests/segnalazioni/[slug].blade.php`.

## D14: il route dinamico non contiene fallback di catalogo

**Contesto**: il mount di `tests/[slug].blade.php` leggeva
`tests.catalog.json` e selezionava view speciali quando mancava una pagina CMS.
Questo introduceva una seconda sorgente editoriale e rendeva il risultato
dipendente dallo slug.

**Decisione**: il mount costruisce esclusivamente `tests.<slug>` e passa i dati
di contesto a `<x-page>`. La pagina viene risolta dal JSON
`database/content/pages/tests.<slug>.json`; blocchi e varianti sono scelti dal
contratto CMS, non da `if` nel route file.

**Rationale**: il route è infrastruttura Folio, mentre catalogo e contenuto
sono responsabilità del CMS. Un fallback nasconde i JSON mancanti e rende
impossibile verificare la parità pagina per pagina.

**Stato**: ✅ Implementato; rimosse importazioni `File`/`Page`,
`catalogFallback` e gli include catalogo.

## D15: lo slug vuoto ricade su `tests.index`

**Contesto**: il fallback `$pageSlug = 'tests'` non corrisponde allo slug CMS
della pagina indice, che è `tests.index`. Questo può produrre una pagina senza
blocchi se il componente viene montato senza parametro.

**Decisione**: `tests/[slug].blade.php` usa
`$slug ? 'tests.'.$slug : 'tests.index'`. Lo slug valorizzato resta invariato;
lo slug vuoto identifica sempre il documento indice CMS.

**Rationale**: il valore Folio della route e lo slug editoriale JSON devono
essere identici. `tests.index` è il contratto canonico del catalogo.

**Stato**: ✅ Implementato e verificato con lint e smoke HTTP.

## D16: risultati-ricerca richiede una sequenza BMAD dedicata

**Contesto**: il primo block `search-results` produceva solo due card e una
sezione minimale, mentre la reference contiene filtri, dieci risultati,
caricamento ulteriore, rating e contatti. La misurazione reale era 12.87% body
HTML e 24.02% visuale a 1440px.

**Decisione**: il lavoro è stato suddiviso nelle storie `DC-027.1`–`DC-027.5`:
evidence/contratto, JSON, markup e stile, interazioni WCAG, verifica finale.
Nessuna pagina Folio specifica viene creata.

**Rationale**: il fallimento derivava da un contratto dati incompleto e da una
verifica prematura, non da un semplice difetto CSS. Le soglie devono essere
misurate a 375, 768 e 1440px con body comparator e screenshot.

**Stato**: ✅ Pianificato; implementazione rinviata alla sessione successiva.

## D13: Mappa e wizard ticket — map marker visibility (STORY-054)
- **Scelta**: Aggiornare il marker SVG in `tickets/index.blade.php` con Design Comuni green `#007A52`, dimensione `36×48`, `aria-label="Segnalazione sul territorio"`, `role="img"`, nessun overlay `?`.
- **Motivazione**: Il marker attuale era scuro, piccolo e aveva un overlay di punto di domanda — non conforme a Design Comuni (green PA, visibilità WCAG, nessun icona decorativa).
- **Risultato**: marker visibile, conforme, WCAG compliant, nessun fallback necessario.

## D14: Pulsanti mappa non trasparenti (STORY-XXX)
- **Scelta**: Applicare Design Comuni styling ai pulsanti `ctrl-btn` della mappa:
  - Background: `#007a52`
  - Hover/focus-visible: `#005c3d`
  - Ombra leggera: `box-shadow: 0 2px 6px rgba(0,122,82,0.3)`
  - Transizioni: `transition: background-color 150ms ease, box-shadow 150ms ease, transform 120ms ease`
  - `rounded-lg`, `cursor:pointer`
- **File**: `Modules/Geo/resources/js/components/map/controls/geolocation.js` (renderButton function)
- **Rationale**: I pulsanti devono essere visibili e accessibili, non devono avere sfondo trasparente. Il design Comuni richiede colori di contrasto e stato chiaro/attivo ben definiti.

## D15: Geolocalizzazione non funzionante (STORY-530)
- **Scelta**: Documentare e rafforzare l'uso di HTTPS (`FORCE_HTTPS=true` in `.env.production.example`) e l'uso corretto di `fallBackToApproximate` per scenari non sicuri.
- **Motivazione**: Il browser richiede `isSecureContext`, altrimenti la geolocalizzazione fallisce. Il codice esistente ha già un fallback, ma è stato documentato e verificato.
- **Status**: ✅ Confirmed
- **Impact**: Allows users to still report locations even when geolocation is unavailable (e.g., HTTP, permission denied), with neutral messaging and fallback to approximate location.

## D16: Documentazione parallela — aggiornamento second-brain
- **Fixcity**: `second-brain.md` §8 aggiornato con 3 storie parallele e riferimenti ai BMAD stories.
- **Sixteen**: `second-brain/geo-map-tickets.md` creato con dettagli tecnici e riferimenti.
- **BMAD stories**: `STORY-054-ticket-marker-visibility.md`, `STORY-XXX-wizard-map-buttons.md`, `STORY-530-geolocation-not-working.md` create con frontmatter completo.

## D17: Documentation standards — consistency across modules
- All `docs/bmad/` stories must include: `github_issue`, `discussion`, `type`, `tags`, `qmd`, `links`, `status`, `module`.
- All `docs/second-brain/` must reference specific stories via `links` and `tags`.
- All `docs/bmad/` stories must follow the Design Comuni documentation standards (no Bootstrap, proper token usage, accessibility).

## D39: Ownership and semantic resolution of frontoffice markers (2026-10-26)

> Numero corretto il 2026-10-26: in origine D18, ma D18 era gia' preso quattro volte (tipografia DCP-221, contratto UserContract, ritorno post-login e questa voce). Prossimo libero verificato: D39 (il piu' alto in uso era D38).

- **Decisione:** Sixteen owns frontoffice markup, Blade, CSS and responsive parity; Fixcity/Tenant own Actions, domain data and data contracts.
- **Decisione:** committed merge markers are audited separately from `git status` unmerged entries. A clean index does not prove marker-free runtime files.
- **Risoluzione:** keep tenant-driven `ente: toll_free` content, remove empty regional placeholders, drop unused `$phoneItems`, and resolve the footer as a third way: the Design Comuni structure (incoming, the only branch that closes the block and defines every variable it renders) with the localized contact labels from `footer.json` `contact.labels` (current), because the incoming branch read `pub_theme::footer.*`, which exists only in Italian.
- **Verifica:** marker scan, JSON validation and Blade compile/lint; visual parity remains required at 375, 768 and 1440 px.
## 2026-10-26 — Google CTA nel login Sixteen

- Login e registrazione usano lo stesso componente `components.utilities.google-button`.
- La visibilità dipende dalla configurazione reale del provider, non dalla sola esistenza della route.
- Il tema non conosce né conserva credenziali: espone solo il link localizzato verso il contratto OAuth del modulo User.

## D40: feedback degli eventi usa fallback localizzati

- **Decisione:** testi fallback del feedback e delle relative risposte stanno nei cataloghi `pub_theme::news.index.feedback.*`; il blocco CMS della lingua attiva può sovrascriverli.
- **Decisione:** il feedback statico di `config/sixteen.php` è legacy italiano e si applica solo in italiano. Per en/de/es il fallback viene dai cataloghi tradotti.
- **Motivazione:** un fallback italiano sotto `<html lang="en|de|es">` era annunciato con la lingua sbagliata da screen reader e restava visibile ai cittadini.
- **Verifica:** cataloghi coperti dal test `NewsIndexLabelsAreTranslatedTest`; Blade cache e smoke responsive da eseguire nell'ambiente con DB e browser disponibili.