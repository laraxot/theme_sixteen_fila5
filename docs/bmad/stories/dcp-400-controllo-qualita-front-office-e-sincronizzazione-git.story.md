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

## Esito corrente

I controlli mirati su autenticazione/sitemap/PHPStan passano dopo le correzioni. La suite FO larga resta non completamente verde per asserzioni legacy su titoli non brandizzati, markup di paginazione/404 e alcune pagine ancora da riallineare a Design Comuni; non vengono mascherate modificando il codice solo per soddisfare fixture obsolete.

(La sezione «Esito della sincronizzazione» si aggiunge a fine giro.)
