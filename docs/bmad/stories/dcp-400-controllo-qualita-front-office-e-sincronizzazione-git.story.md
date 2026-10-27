---
id: dcp-400
title: "DCP-400: controllo di qualita' del progetto, giro completo del front office e sincronizzazione git"
type: story
status: in-progress
owner: theme:Sixteen
module: Sixteen
created: 2026-10-27
updated: 2026-10-27
tags: [bmad, story, qualita, phpstan, phpmd, phpinsights, front-office, design-comuni, git]
qmd: "controllo qualita phpstan phpmd phpinsights puppeteer playwright front office loggato ospite design comuni sync git merge collisioni"
related:
  - ./dcp-368-avatar-area-personale-icona-verde-e-regione-demo.story.md
  - ../../compliance/03-front-office-scheda-per-pagina.md
issues: []
discussions: []
---

# DCP-400: controllo di qualita', front office e git

Status: **in-progress**. Questa story traccia il giro richiesto il 2026-10-27: controllare il progetto con PHPStan, PHPMD, PHPInsights e i
due browser MCP, poi tutto il front office da ospite e da loggato contro Design Comuni, poi sincronizzare con git gestendo le collisioni.

## Controlli statici (misurati il 2026-10-27)

| Strumento | Esito | Nota |
|---|---|---|
| PHPStan (`analyse Modules`, config unica) | 5 errori in 4 file, poi a zero sui file corretti | Event seeder (factory inesistente), test Fixcity (`array_map` con tipo perso), 2 `file_get_contents` non sicuri in un test del modulo User di un'altra sessione |
| PHPMD (`phpmd.xml`, Modules + Themes/Sixteen/app) | 2067 segnalazioni, nessuna di tipo bug nel codice del progetto | 825 `MissingImport`, 656 CamelCase, 42 catch vuoti (34 in Xot, modulo condiviso), 14 `exit`; `UndefinedVariable` e `eval` sono `$this` nelle closure Pest e un helper di test |
| PHPInsights (`phpinsights.php`, soglie 99) | Code 59,7, Complexity 94,4, Architecture 41,1, Style 71,0; 0 problemi di sicurezza | 19.871 segnalazioni; soglie non raggiungibili, vedi sotto |

Dettagli e perche':

- **Event seeder.** `Modules/Event` non e' attivo (non sta in `modules_statuses.json`) e il suo seeder chiamava `Event::factory()` su un modello senza
  factory. L'ho corretto delegando a `DemoContentSeeder` del Blog (idempotente, `updateOrCreate` per slug); un'altra sessione ha poi rimosso la cartella
  `database/seeders` (DCP-385) e il documento `Modules/Event/docs/fo-state.md` e' gia' allineato. Vale la sua scelta.
- **Test Fixcity `MediaPolicyTemplateTest`.** Con `Safe\preg_split` il tipo si perdeva e `array_map` con closure tipizzata non passava. Ora un `foreach`
  con `Assert::assertIsString`; un'altra sessione ha anche sostituito `preg_split` con `explode`. Le due modifiche convivono; Pest su DB scratch:
  24 test, 216 asserzioni.
- **PHPMD.** La versione installata vuole `phpmd analyze` come sottocomando e `--reportfile-text`; `pdepend` non sa leggere una sintassi PHP 8.4
  in `Modules/Xot/app/Models/Traits/TypedHasRecursiveRelationships.php` (limite dello strumento). Le guide del progetto dicono «zero warning» come
  obiettivo: oggi non lo e', e nessuno ha una baseline. Non l'ho azzerato in blocco: sarebbe churn su Xot, condiviso con altri progetti.
- **PHPInsights.** Le soglie a 99 contraddicono le convenzioni del progetto: 2422 «classi non final» (Filament e Laravel le vogliono estendibili),
  101 «trait vietati» (il progetto e' fatto di trait), 995 «proprieta' pubbliche» (sono i `Data` di Spatie), 4255 lunghezze di riga. Il JSON
  dello strumento ha backslash non validi nei nomi di classe (va ripulito prima di leggerlo).

## Browser MCP

- **Puppeteer MCP:** funziona solo con `launchOptions` espliciti (`executablePath: /usr/bin/google-chrome`, `args: [--no-sandbox]`,
  `allowDangerous: true`); senza, «Could not find Chrome». La prima navigazione e' scaduta a 30 s mentre tre agenti caricavano il dev server,
  la seconda e' riuscita. Misurato: `/it/auth/login` mostra «Demo» nella slim bar e l'avatar di «Accedi all'area personale» con icona verde nel cerchio bianco.
- **Playwright MCP:** «Browser is already in use for ~/.cache/ms-playwright-mcp/mcp-chrome-for-testing-…»: il profilo e' tenuto da un'altra
  sessione Claude. Non l'ho chiusa. Le misure su piu' pagine si fanno con script Playwright (pacchetto del repo) che non usano quel profilo.

## Git: come e' fatto il progetto (verificato)

- La radice **non** usa submodule (nessun `.gitmodules`, nessun gitlink): traccia direttamente i file di `laravel/Modules/*` e `Themes/*`.
  In piu' 21 moduli/temi e `bashscripts` hanno un `.git` proprio (remoti `laraxot/module_*_fila5`, `theme_sixteen_fila5`, `bashscripts_fila5`).
  Lo stesso file e' quindi tracciato da due repo e va committato in entrambi. `Modules/Event` non ha `.git`: sta solo nella radice.
- Prima di sincronizzare: tutti i repo erano a 0/0 rispetto a `laraxot/dev`; restava solo l'albero di lavoro sporco, in 15 repo.

## Evidenze aggiunte nel giro di verifica

- Il redirect di default dopo login e' intenzionalmente `/{lang}/area-personale`, non la home: il test Fixcity e' stato riallineato al contratto di `GetPostLoginUrlAction`.
- `RememberLoginReturnUrlAction` rifiuta ora anche caratteri di controllo (inclusi CR/LF), oltre a host esterni, backslash e schemi non ammessi: evita header-injection/open redirect nel parametro `redirect`.
- La sitemap filtra anche `tests` esatto e i percorsi di test restituiti da provider esterni; il controllo Seo ora passa.
- Il token password a quattro segmenti e' una pagina Folio+Volt dedicata (`pages/auth/password/reset/[token].blade.php`); il middleware CMS non deve intervenire e il widget riceve token/email dal percorso.
- Il 404 verifica il landmark `<main>` senza imporre che `id="main-container"` sia sul tag `main`: l'architettura Sixteen puo' porre il bersaglio skip-link nel contenuto Design Comuni.

## Front office: giro da ospite e da loggato

Metodo: tre audit in sola lettura (flussi di accesso, percorsi da ospite, percorsi da loggato) su `http://192.168.1.40:8000` con un account `@example.test`
del DB di sviluppo. Ogni difetto pesante e' stato riverificato prima di intervenire: un agente aveva dato la colpa a un'altra sessione per un login
fallito, ma la causa era la mia doppia cifratura della password di prova (`BaseUser::setPasswordAttribute` cifra gia' da solo).

### Corretto e provato

| Difetto | Causa | Correzione | Prova |
|---|---|---|---|
| Il logout riporta sempre a `/it` | `POST /logout` non ha il prefisso lingua | `LogoutAction::localeFromReferer()`, accetta solo lingue supportate | `LogoutActionLocaleTest`: rosso, poi 7 casi verdi |
| Menu utente in de/es: 4 voci su 6 in inglese | chiavi `my_services`, `my_practices`, `notifications`, `settings` assenti | chiavi in `lang/de` e `lang/es` di `header.php` | HTML |
| Avatar dell'header: richiesta a gravatar.com con l'hash della stringa vuota, uguale per tutti | `BaseProfile::getAvatarUrl()` cifrava anche l'email vuota | senza email restituisce `''`; resta il ripiego MD5 sull'email dell'utente voluto da CMT-022 | `ProfileAvatarUrlTest`: rosso (riproduce `e3b0c442...b855`), poi 4 casi verdi; sonda browser |
| Blog ed eventi in en/de/es con «Cerca», «Invio», «18 notizie trovate», «NOTIZIE», «EVENTI» | ripieghi italiani scritti nei template | chiavi `news.index.*` nei 4 `news.php`, template con `__()` | `NewsIndexLabelsAreTranslatedTest`: rosso (25), poi verde; HTML di 8 URL, 0 stringhe italiane in en/de/es; compilazione Blade 670 test verdi |
| Registrazione in tedesco: pulsante «Registrati», azioni e messaggi in italiano | `User/lang/de/registration.php` copiato dall'italiano | blocchi `actions` e `messages` tradotti | HTML di `/de/auth/register`: «Registrieren» |
| Registrazione (Gdpr): etichetta marketing e messaggio di successo con «pizza» e il segnaposto `<nome progetto>` | testo di un template | testi civici in en/de/es | lettura del lang, `php -l` |

### Aperto, con il motivo

- **Decisione dell'utente, testi legali.** `[[ente.*]]` e «TESTO NON ANCORA COMPLETO» restano in privacy, note legali, accessibilita' e nel passo 1 del wizard:
  servono i dati reali del Comune oppure dati dichiaratamente fittizi solo per lo sviluppo. Non li invento.
- **Decisione dell'utente, Gravatar nell'header.** L'informativa dice «accanto ai tuoi commenti», ma l'header fa la stessa richiesta a ogni pagina per l'utente
  connesso (lo vuole CMT-022). O si allarga il testo, o l'header mostra solo foto caricata o iniziale.
- **Quattro URL in 404 anche da loggato** (`/it/dashboard`, `/it/profile/edit`, `/it/notifications`, `/it/area-personale/servizi`): le oscura il catch-all
  `[container0]` del tema e nessun link li raggiunge. Non si risolve con un file nel tema (regola del progetto): serve il link giusto o un JSON CMS.
- **Layout e CSS, non toccati** per non scontrarsi con le sessioni che lavorano su Sixteen: le pagine senza `data-dc` (dettaglio blog e evento, area personale,
  wizard, conferma) hanno header e footer diversi dal resto; allineamenti a sinistra incoerenti; footer piu' povero del modello; blocco «Indice della pagina»
  rotto in pratiche e impostazioni; nel passo 2 del wizard il clic sulla mappa non crea il marker (ipotesi non verificata); contrasti tra 3,2 e 4,4 a 1 su
  avatar, paginazione e «Carica file»; focus invisibile sul selettore lingua.
- **Latenti:** la pagina `verify` del modulo User e' uno stub in inglese fuori dal tema (raggiunta solo con `AUTH_MUST_VERIFY_EMAIL=true`, oggi `false`);
  la password chiede «minimo 8» in registrazione e «minimo 12» al reset; il redirect dell'ospite al login non porta il parametro di ritorno;
  il lang Gdpr ha ancora chiavi di template (Pizza Journey, `monthly_meetups`) non usate dal front office.
- **Test di altre sessioni.** Cinque file di test non tracciati (07:50) provano classi inesistenti (`XotPanelController`, `LocationDTO`, `Tests\Modules\Xot\TestCase`) e
  danno 107 errori PHPStan. Non li ho committati e non li ho corretti: non so che API volevano.

## Esito corrente

I controlli mirati su autenticazione/sitemap/PHPStan passano dopo le correzioni. La suite FO larga resta non completamente verde per asserzioni legacy su titoli non brandizzati, markup di paginazione/404 e alcune pagine ancora da riallineare a Design Comuni; non vengono mascherate modificando il codice solo per soddisfare fixture obsolete.

## Esito della sincronizzazione

Misurato dopo l'ultimo `git fetch laraxot`: 22 repo su 23 (moduli, temi, `bashscripts`, radice) a 0 avanti e 0 indietro; restano sporchi solo i file lasciati fuori
apposta (sotto). Sullo stesso albero hanno lavorato tre sessioni Claude (377, 385 e questa) e i commit «.» della macchina di `marco76tv`.

Commit di questa sessione, tutti sul remoto: Gdpr `27f46a6`, User `27cc3ccc5`, Sixteen `eddeaffa`, Job `0fa236f4`, Mobile `eab828a`, Seo `5472245`,
`bashscripts` `80f9cbd2`. La radice, che traccia gli stessi file dei moduli, l'ha rispecchiata la 377: i file miei sono nel suo `HEAD` e sul remoto.

### Collisioni: scelte e lezioni

| Caso | Cosa c'era | Scelta | Perche' | Lezione |
|---|---|---|---|---|
| Lock `/tmp/fixcity-git-sync.lock.d` | io ho fatto add/commit/push dalle 08:14 senza lock; lo teneva la 377 dalle 08:15:20 | mi sono fermato appena l'ho visto, ho atteso 26 minuti e l'ho preso con `mkdir` alle 08:41:08 | in quella finestra i miei 7 push sono stati puliti e con solo file miei; nessun danno misurato | primo comando di ogni sync: leggere il lock e `git log --since` |
| Marker `.merge_file_*` alle 08:20:02 | sei file in tre repo, solo nell'albero di lavoro; `/it/auth/register` rispondeva 500 | ripristinati da HEAD i cinque file in cui la risoluzione coincide con HEAD (4 `lang/*/auth.php` di Fixcity e la vista di registrazione); lasciati ai proprietari i tre con lavoro vero | HEAD e remoto avevano gia' la chiave giusta (`register.loading.text`); nel test e nelle due story c'erano righe che HEAD non ha | la prova e' `git diff HEAD -U0`: nessuna riga `-` e `+` solo di marker o doppioni |
| Remoto avanti di 2 commit in Job, Mobile, Seo | commit «.» di `marco76tv` su file diversi dai miei | merge senza conflitti con `git merge-tree --write-tree` come prova, poi push | nessun file in comune | la prova a secco non tocca l'albero condiviso |
| Guard dei marker cancellato | i commit «.» delle 08:56 hanno tolto `git/guard-conflict-markers.sh` e l'installer, ma `tools/check-conflict-markers.sh` e la regola `committed-conflict-markers.md` li usano ancora | ripristinati da `8587f3a8` con un commit in avanti (`80f9cbd2`) | senza il guard il controllo dei marker su tutto il repo non aveva niente da lanciare | provato su un repo temporaneo: uscita 0 se pulito, 1 con un marker in staging |
| Test di altre sessioni, non tracciati | 5 test su classi inesistenti (107 errori PHPStan), un test Cms senza helper, un test Fixcity con `user_id` nullo | esclusi dai miei commit; la 377 ha poi tenuto i 26 test corretti e scartato i 5 | non sapevo quale API volessero e non spingo test rossi sul remoto | eseguire i candidati da soli sul DB di prova prima di committarli |
| `.gitignore` di `bashscripts` con marker | 66 righe di marker gia' nei commit, anche sul remoto | non l'ho toccato; l'ha ripulito la 377 (`1c38dbb5`) | molte regioni con regole vere dentro, serviva il proprietario | un `.gitignore` non si risolve a unione alla cieca |

Lasciati fuori apposta e ancora non committati: i `*.lock` di sessione accanto ai sorgenti, `Rating/package-lock.json`, `test-results/.last-run.json` e un
`docs/bmad/stories/database/test_data.sqlite` da 0 byte creato dall'MCP sqlite.
