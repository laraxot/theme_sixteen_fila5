---
id: dcp-220
title: "DCP-220: lingue mancanti e viste senza chiavi nel front office"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P2
owner: theme:Sixteen
module: Sixteen
created: 2026-10-15
updated: 2026-10-15
qmd: "traduzioni de es file lingua mancanti segnalazione 404 social notifications chiavi grezze guardia attributi aria-label viste non montate pub_theme fallback italiano"
related: [dcp-186, dcp-153]
tags: [i18n, sixteen, front-office, guard]
---

# DCP-220: lingue mancanti e viste senza chiavi nel front office

## Fase BMAD
Plan. Nessun codice in questa story: raccoglie cosa fare e cosa decidere. Nasce dal giro di correzioni di DCP-186 (chiavi grezze su recupero password, `/services`, `/segnalazioni`, gia' risolte) e da una misura statica di tutte le viste del tema.

## Perche' conta
Una chiave mancante non da errore: Laravel mostra la chiave stessa, oppure ripiega sul file italiano. Il visitatore tedesco o spagnolo vede una pagina con `<html lang="de">` e testo italiano. Per chi usa un lettore di schermo la lingua dichiarata e quella del testo non coincidono (WCAG 3.1.1 e 3.1.2; **non ho provato con un lettore di schermo**).

## Fatti misurati (2026-10-15)
1. **Sito vivo.** `/de/segnalazioni` e `/es/segnalazioni` rispondono 200 con `lang` giusto ma `<h1>` «Elenco segnalazioni» (italiano); `/en/segnalazioni` dice «Reports List». Le 404 in tedesco e spagnolo sono invece tradotte («Seite nicht gefunden», «Página no encontrada»).
2. **File di lingua del tema assenti.** `Themes/Sixteen/lang/{de,es}/` non ha `segnalazione.php` ne' `404.php`. `social.php` e `notifications.php` mancano in **tutte e quattro** le lingue.
3. **Analisi statica** delle 918 viste del tema: 222 usi letterali di `__('pub_theme::...')`, 38 chiavi distinte con problemi, circa 14 sono rumore (prefissi costruiti a runtime come `accessibility.status.`, `legal.documents.`, e array voluti come `faq.items`, `sitemap.groups`). Strumento di misura: script PHP usa-e-getta, non conservato; si rifa con `rg` sui letterali e un `include` dei file lingua.
4. **Chiavi assenti in tutte e 4 le lingue**, con i riferimenti trovati da `rg`:
   - `accessibility.accessibility_tools`, `high_contrast`, `font_size`, `accessibility_statement`, `privacy_policy`, `close_accessibility_bar`: vista `partials/accessibility-bar`, **0 riferimenti**.
   - `accessibility.close`: vista `blocks/segnalazioni-elenco/mobile-filters-modal`, **0 riferimenti**.
   - `social.follow_us`, `social.follow_on`: vista `social/social-links`, **0 riferimenti**. `notifications.close`: vista `feedback/notification`, **0 riferimenti**.
   - `ui.header_area_personale.parity_demo_user.label` (manca in de/es): vista `sections/header/partials/personal-area-guest-parity`, **0 riferimenti**.
   - `home.list.track_eyebrow`, `home.list.create_button`: vista `blocks/quick-actions`, **1 riferimento** (e' montata).
   - `auth.reset.submit`, `auth.login.submit` in spagnolo (manca il file `auth.php` del tema): viste `filament/widgets/auth/forgot-password-widget` e `reset-password-widget`. La pagina vera di recupero password usa la vista del modulo User, non queste.
5. **Limite della prova.** «0 riferimenti» viene da `rg` sui nomi nei file `.php`, `.blade.php` e nei JSON di configurazione; un `@include` con nome costruito a runtime o un blocco nominato solo in un JSON non verrebbe visto.

## Gia' corretto (non rifare)
Recupero password (`user::auth.forgot-password.*`), breadcrumb di `/services` e `/segnalazioni` (`navigation.home`, `services.meta.breadcrumb`, `fixcity::global.breadcrumb`): vedi DCP-186.

## Cose da fare
- [ ] **T1.** Provare che le cinque viste a 0 riferimenti sono davvero morte: cercare include dinamici (`@include($`, `<x-dynamic-component`) e nomi nei JSON di pagina. Se vive, aggiungere le chiavi; se morte, andare alla decisione D220-2.
- [ ] **T2.** Creare `Themes/Sixteen/lang/de/segnalazione.php`, `de/404.php`, `es/segnalazione.php`, `es/404.php` a partire dai file italiano e inglese (stesse chiavi, una per riga come negli altri file).
- [ ] **T3.** `social.php` e `notifications.php` solo se T1 dice che le viste sono vive.
- [ ] **T4.** `home.list.*`: vedere dove e' montato `quick-actions` e che testo mostra oggi; aggiungere le due chiavi in 4 lingue.
- [ ] **T5.** Spagnolo: `auth.php` del tema, oppure togliere i due widget se T1 li dichiara morti.
- [ ] **T6.** Estendere `Modules/Fixcity/tests/Feature/Pages/PublicPagesStructureTest.php` (riuso, nessun test nuovo): oggi legge solo il testo visibile di `<main>`; aggiungere gli attributi `aria-label`, `title`, `placeholder`, `alt`, `value` con lo stesso schema `ns::file.chiave`, in 4 lingue. Aspettarsi prima rosso se ce ne sono.
- [ ] **T7.** Usare lo strumento gia' esistente in `bashscripts/tools/i18n/` per elencare i file mancanti per namespace montato, invece di scriverne un altro.
- [ ] **T8.** Aggiungere `/segnalazioni` all'elenco della guardia quando il suo titolo non coincide piu' con quello di `/tickets` (oggi entrambe dicono «Elenco segnalazioni» in italiano).

## Decisioni da prendere
| ID | Chi decide | Domanda | Opzioni | Proposta |
|---|---|---|---|---|
| D220-1 | Prodotto | de e es sono lingue ufficiali del front office? | A) tradurre le pagine montate (T2); B) togliere de/es dal selettore finche' non sono complete; C) lasciare il ripiego sull'italiano | A per `segnalazione` e `404`, le uniche montate e raggiungibili. Non e' un parere sull'accessibilita': la scelta e' di prodotto |
| D220-2 | Sviluppo con il titolare tecnico | Cosa fare delle viste provate morte (T1) | cancellare; tenere | Cancellare dopo T1 con la procedura del prompt 42 (zero riferimenti, nessun lavoro altrui sul file, report): git le conserva |
| D220-3 | Ente o fornitore | Chi rivede le traduzioni de/es | traduttore; traduzione automatica rivista da madrelingua | Non decidibile da qui: l'ente e' italiano e il pubblico tedesco/spagnolo non e' misurato |

## Criteri di accettazione
1. `PublicPagesStructureTest` verde in it, en, de, es, con gli attributi e con `/segnalazioni`.
2. `curl` di `/de/segnalazioni` e `/es/segnalazioni`: `<h1>` non italiano.
3. Nessuna delle 38 chiavi segnalate resta senza esito scritto: tradotta, rumore documentato o vista cancellata.

## Non verificato
Rendering di `quick-actions`; testo di `404.no_article` a schermo in de/es; lettori di schermo; include dinamici delle cinque viste. Le traduzioni de/es non sono state scritte: sono una decisione (D220-3) prima che un lavoro.
