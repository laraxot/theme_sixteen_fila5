---
title: "Login — censimento e piano Design Comuni"
status: active
updated: "2026-10-20"
tags: [auth, login, design-comuni, bmad, filament, second-brain]
qmd: "login censimento piano accesso-servizio cmp-heading cmp-text-button"
related:
  - ../bmad/filament-blueprint.md
  - ../bmad/decision-log.md
  - ../second-brain/designcomuni-auth-blog.md
  - ../auth/login-ux-fixes.md
  - ../../../../Modules/User/docs/wiki/concepts/login-page-design-comuni.md
type: note
---

# Login — perché non è Design Comuni

Riferimento: [accesso-servizio.hbs](https://github.com/italia/design-comuni-pagine-statiche/blob/main/src/pages/servizi/accesso-servizio.hbs).
Bootstrap Italia è solo la misura dei caratteri. Non si carica il suo CSS.

La pagina serve a entrare per segnalare e seguire una pratica. Il dominio (email, password, «Ricordami», esito) resta `LoginWidget` del modulo User. Il tema veste. Non si inventano SPID e CIE: Fixcity non ha quei provider, un bottone morto sarebbe una seconda verità.

## Censimento (live `/it/auth/login`, 2026-10-20)

| # | Riferimento | Live | Perché conta |
|---|---|---|---|
| 1 | Breadcrumb, `cmp-heading`, riga, colonna `col-lg-8`, tre blocchi `cmp-text-button`, fascia `bg-grey-card` + `cmp-contacts` | Card bianca da 36rem su fondo `#f5f7f9`, form dentro | La card è un vestito da sito commerciale. Il riferimento non avvolge l'accesso in una scheda |
| 2 | h1 `title-xxxlarge`: 40px, peso 700, interlinea 1.25, Titillium | h1 a `clamp(1.75rem, 4vw, 2.25rem)` (al massimo 36px) | Il titolo della pagina è il primo elemento che il riferimento fissa |
| 3 | `cmp-breadcrumbs`: il separatore è CSS | `<li aria-hidden>/</li>` | Un nodo «/» in più produce la doppia barra quando il CSS del breadcrumb aggiunge il suo |
| 4 | Fascia contatti in fondo | Assente | Chi non riesce a entrare deve trovare un contatto, non solo «Password dimenticata» |
| 5 | `<hr>` sotto il titolo, visibile da `lg` | Assente | Separa il titolo dai modi di accesso |
| 6 | Campi e bottoni dei componenti (`cmp-button`, label sopra il campo) | Markup Filament `.fi-*` più uno `<style>` privato di `.auth-login-*` | Lo sheet compilato esclude `data-dc`. Lo `<style>` dipinge, ma non è riusabile: la registrazione ne ha un altro uguale |
| 7 | Bottone outline nello stesso blocco del metodo | Partial Google con SVG senza misura propria (prima del ritocco: 476×476) | L'icona non è un componente: senza width esplode |
| 8 | Titolo documento dal nome della pagina e del comune | La Folio page forza `user::auth.login.title.text` («Accedi al tuo account»). Il JSON ha «Accedi — FixCity» e non viene letto | Due titoli per la stessa pagina |
| 9 | SPID, CIE, poi «Altre utenze» | Solo email, password e Google, presentati come tutta la pagina | I primi due non si disegnano finché un modulo non li possiede. L'email è il blocco «Altre utenze», non l'intera pagina |
| 10 | — | [login-page-design-comuni.md](../../../../Modules/User/docs/wiki/concepts/login-page-design-comuni.md) prescrive blu `#0066CC`, sidebar e `rounded-2xl` | È una seconda verità: un agente che la segue ricostruisce la card |
| 11 | — | [designcomuni-auth-blog.md](../second-brain/designcomuni-auth-blog.md) chiedeva «card gradient» e CTA SPID/CIE | Non è la pagina del riferimento |

La colonna civica del 2026-10-20 (chiave «Crea un account», pulsanti alti 44px, checkbox 20px, niente `|---LINE:---|`) toglie i difetti di lettura. Non è la pagina del riferimento.

## Piano

1. Tenere `LoginWidget` come unico posto di email, password, «Ricordami» e submit. Nessun controller, nessuna Resource nel tema. Vedi [filament-blueprint.md](../bmad/filament-blueprint.md).
2. Vestire la pagina con la grammatica già usata dalle pagine di contenuto: `cmp-heading`, `cmp-text-button`, `cmp-contacts`, sotto `.page-content[data-dc]`. Niente `main[data-page]`, niente altro `<style>` di pagina. Lo stile di quei componenti sta nel foglio condiviso che dipinge dentro `data-dc` (oggi lo `<style>` esiste proprio perché lo sheet compilato li esclude: va tolto quel recinto, non copiato un terzo foglio).
3. h1 a 40px / 700 / 1.25. Sottotitolo dal JSON `auth.login`, non da una stringa fissa nella Folio page. Il `<title>` legge lo stesso JSON.
4. Breadcrumb `cmp-breadcrumbs`, senza `<li>` che contiene solo «/».
5. Il form è il blocco «Altre utenze»: h2 32px, testo, campi, bottone pieno, sotto i link «Password dimenticata» e «Crea un account». Google è un bottone outline dello stesso blocco, icona 1.25rem.
6. Fascia contatti in fondo, lo stesso partial delle altre pagine.
7. SPID e CIE restano fuori. Si aggiungono solo quando un modulo owner espone il provider e il JSON accende il blocco.
8. Verifica a 375px e 1440px: un h1, titolo documento dal JSON, contatti visibili, Google e «Accedi» alla stessa altezza, form non inviato.

## Stato

Censimento e piano scritti. Il vestito live non è ancora quello del punto 2.
