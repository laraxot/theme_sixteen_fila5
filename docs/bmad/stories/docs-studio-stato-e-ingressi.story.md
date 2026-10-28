---
title: "Sixteen: studio del tema reale e correzione degli ingressi docs"
type: story
status: done-with-open-decisions
created: 2026-10-14
updated: 2026-10-14
theme: Sixteen
owner: theme:Sixteen
related:
  - ../../00-INDEX.md
  - ../../README.md
  - ../../../../../Modules/Fixcity/docs/stories/dcp-56-organizzazione-docs-moduli-e-temi.story.md
  - ../../../../../../bmad-output/stories/docs-organization/DOC-010.module-theme-quality.story.md
  - ../../../../../../bmad-output/stories/docs-organization/DOC-002.canonical-entrypoints.story.md
tags: [docs, sixteen, bmad, ingressi, verifica, doc-010, doc-002]
qmd: "sixteen docs studio stato ingressi README 00-INDEX pub_theme rotte dormienti layout design-comuni indici storici INDEX.md index.md docs-organizer busy"
---

# Sixteen: studio del tema reale e correzione degli ingressi docs

Fase BMAD: manutenzione documentale (DOC-010 e DOC-002 del piano `bmad-output/stories/docs-organization/`). Continua DCP-56.

## Richiesta
Studiare il tema vero (viste, css, js, app, lang, test, build) e correggere `README.md` e `00-INDEX.md` solo con fatti verificati: identita', stato, contenuto con path veri, comandi di build reali, limiti; dichiarare cartelle canoniche, evidence e legacy; nessun file cancellato, spostato o rinominato.

## Analisi
Il tema e' vivo: `'pub_theme' => 'Sixteen'` in tutti e 4 i `laravel/config/**/xra.php` (local/fixcity, localhost, eu/fixcity, net/futurely) e `public_html/themes/Sixteen` e' un link a `laravel/Themes/Sixteen/public/`. E' un submodule (`gitmodules.ini`) con remote `theme_sixteen_fila5`.

Cosa era falso o mancante negli ingressi:

| Dove | Affermazione | Realta' verificata |
|---|---|---|
| `README.md` | badge Markdown rotti (`](url)](url)`, due badge PHP, `]()` orfani), sezione "Perche' esiste" vuota, firma "Modulo `Sixteen`" | tema, non modulo; nessuna indicazione di stato, contenuti o build |
| `00-INDEX.md` | "Non contiene ... controller o rotte" | 5 controller in `app/Http/Controllers/`, 2 middleware, `routes/web.php` (47 righe) e `routes/auth.php` (181), 13 model, 24 enum. A runtime non sono registrati: `php artisan route:list` (461 rotte, nessuna route cache) non ha `comune/*`, `auth/spid`, `auth/cie`; solo `routes/auth.php` ha un `loadRoutesFrom` (`ThemeServiceProvider::registerAuthRoutes`), `routes/web.php` non e' caricato da nessun provider |
| `00-INDEX.md` | "`INDEX.md`, `DOCUMENTATION_INDEX.md`, `00-index.md` e `master-documentation.md` sono indici storici (suffisso `.old`)" | `INDEX.md` e' la mappa viva delle sottocartelle (DCP-112), non storica; `master-documentation.md` e `index.md` non hanno suffisso `.old`; i `.old` sono `00-index.old.md`, `documentation-index.old.md`, `index.historical-bmad.old.md` |
| `index.md` | indice BMAD/QMD | 4 percorsi della tabella "Visual Comparison" non esistono (`segnalazione-dettaglio/README.md`, `homepage/comparison.md`, `visual-parity-report.md`, `complete-report.md`) e nessun `wiki/story-8-108-*` |
| `wiki/rules/no-parallel-design-comuni-layout.md` e `wiki/log.md` (2026-10-11) | "nessun `components/layouts/design-comuni.blade.php`, nessun `<x-layouts.design-comuni>`" | esistono `components/layouts/design-comuni.blade.php`, `design-comuni-authenticated.blade.php` e `design-comuni-bare.blade.php` (mtime 2026-10-13, commit `93d6a3b`); `pages/tests/index.blade.php` usa `<x-layouts.design-comuni-bare>` e `-authenticated` include `<x-layouts.design-comuni>` |
| `README.md` e viste | "Bootstrap Italia non e' una dipendenza runtime" | vero per le dipendenze (`package.json` non lo contiene, gli `@import` in `app.css` sono commentati), ma restano viste legacy: `resources/views/bootstrap-italia/` (16 Blade), `layouts/bootstrap-italia*.blade.php` (4), `pages_old/` (45) |

Conteggi del tema (2026-10-14): 957 Blade in `resources/views` (795 in `components/`, `components/blocks/` 166 voci e 508 Blade, 11 layout), 95 css, 21 js, 79 PHP in `app/`, lang it 43 / en 43 / de 16 / es 15, test: 15 Unit, 6 Feature, 10 spec Playwright.

## Modifiche (solo `laravel/Themes/Sixteen/docs/`)
- `README.md`: tolti i badge rotti; aggiunte tabelle di stato con prove, contenuto con conteggi, comandi di build da `package.json`, limiti noti; `status: active`, `type: readme`, firma corretta ("Tema", PHPStan `level: max` da `laravel/phpstan.neon`).
- `00-INDEX.md`: corretto il paragrafo su controller e rotte; elencati gli indici davvero storici e quelli vivi; tabella di classificazione delle cartelle (canoniche, supporto, evidence, generate, da triare); contraddizione sul layout `design-comuni*` annotata nella riga SSoT; link a questa story; `status: active`.
- `index.md`: `status: stale` e nota datata con `docs-organizer.py stale` (poi corretta a mano: una voce era sbagliata nella mia prima nota).
- `wiki/index.md` e `wiki/log.md`: 5 link ripuntati a bersagli esistenti (`ai-harness-theme-discipline.md` -> `Barthelemy/docs/wiki/concepts/`, tre regole `module-*-mandatory.md` -> `bashscripts/ai/wiki/rules/`), 10 annotati `_(target mancante, verificato 2026-10-14)_`.
- `wiki/log.md`: voce datata.

## Verifica
Link non risolti, `docs-organizer.py --busy-minutes 0 links ... --by-name`, sui file toccati: `wiki/index.md` 10 -> 6, `wiki/log.md` 5 -> 4, `README.md` 0 -> 0, `00-INDEX.md` 0 -> 0 (misura finale con la story gia' creata: 15 -> 10 sui file toccati, 0 eventi sulla story); i 10 rimasti sono annotati e non hanno alcun omonimo su disco (`llm-wiki.txt`, `tenant-modules-navigation-discipline.md`, `runtime-config-religion-hub.md`, `progetto-perfezione-roadmap.md`, `ticket-list-*`, gli artefatti di `header-mobile-nav-scope`). Perimetro intero Sixteen: 1403 -> 1398. Un controllo indipendente dei link relativi (script di sessione) trova 0 link non annotati rotti nei file toccati, a parte la story stessa prima della sua creazione.
Prove di stato: `rg` su `pub_theme`, `ls public_html/themes`, `git ls-files`, `php artisan route:list`, `package.json`, conteggi con `find`.

## Decisioni
- Gli indici si correggono con sostituzioni mirate, senza riscrivere righe di altre sessioni (c'e' una nota "BMAD + second brain note (agent AI update 2026-10-14)" in coda a `00-INDEX.md`, intatta).
- Il codice dormiente (controller, rotte) si documenta, non si tocca: il tema non e' il mio perimetro di codice.
- Nessun secondo indice creato: `INDEX.md` resta la mappa delle sottocartelle, `00-INDEX.md` l'indice canonico.

## Aperto
- Decidere il destino dei layout `design-comuni*` (rimuoverli e aggiornare `pages/tests/index.blade.php`, oppure correggere la regola `no-parallel-design-comuni-layout`).
- Decidere se rimuovere controller e rotte dormienti o riattivarli; fino ad allora `00-INDEX.md` li dichiara non registrati.
- 385 file di Sixteen hanno ancora link non risolti (soprattutto `design-comuni/batch-structure-audit*.md`, 108 ciascuno): richiedono DOC-004/005, non annotazioni a mano.
- Triage delle 25 collisioni di maiuscole e dei `.md` di radice (405).
- Limite del metodo: `docs-organizer.py` salta in silenzio i file toccati da meno di 10 minuti, quindi un dry-run subito dopo un passaggio meccanico vede 48 eventi su 1403 (96,6% nascosto); usare `--busy-minutes 0` (prima del sottocomando).
