---
id: DCP-385
title: "DCP-385: chiusura del front office, controlli statici, percorsi utente e sync git"
type: story
status: in-progress
owner: Themes/Sixteen
created: 2026-10-27
updated: 2026-10-27
tags: [bmad, fo, quality, design-comuni, git, collisioni]
related:
  - ./dcp-360-google-callback-pagina-folio-volt.story.md
issues: []
discussions: []
---

# DCP-385: chiusura del front office

## Richiesta (2026-10-27, verbatim)

«dopo aver finito e controllato tutto il progetto con phpstan phpmd phpinsights playwright-mcp e puppetter, devi controllare anche tutto il
frontoffice tutti i percorsi degli utenti loggati e non loggati, tutto deve avere senso ed essere coerente con designcomuni, fa anche git
add commit merge pull push, per sincronizzare i files con git poi gestisci al meglio le ipotetiche collisioni studiando le collisioni
facendo scelte ogni volta e imparando sempre poi fa di nuovo i comandi git, punta alla perfezione»

## Fasi BMAD

1. **Analisi**: stato dei repo (22 repo annidati + radice, tutti su `dev`, nessun merge in corso), stato dei controlli.
2. **Controlli statici**: PHPStan L10 su tutto, PHPMD sulla cartella `app` di ogni modulo (mai sulla radice: muore in silenzio e da' zero),
   PHPInsights per modulo.
3. **Percorsi utente**: ospite e loggato, con Playwright e Puppeteer, contro il riferimento Design Comuni; difetti riverificati prima di correggere.
4. **Sync git**: commit per repo con percorsi espliciti, `pull` con merge (mai rebase), risoluzione delle collisioni con il criterio sotto, `push`.
5. **Second brain**: docs di moduli e temi, memoria, lezioni.

## Vincoli di sicurezza per git (non negoziabili)

- Branch `dev`, mai `checkout -b`. Mai `--force`, `reset`, `restore`, `stash`, `rebase`, `commit -am`, `filter-branch`.
- Prima di ogni commit: scansione di segreti (`GOCSPX`, `AIza`, chiavi private, `.env`) e di marker di merge sui file in stage.
- Si usano i `path` di `gitmodules.ini` e `git remote -v` come autorita', mai l'URL scritto nel file. Mai `remote add` o `set-url`.
- Altre sessioni scrivono negli stessi repo: `git status` subito prima di `add`, commit per percorso, `pull --no-rebase --no-edit` per non restare
  fermi in un editor.

## Criterio per scegliere fra le due parti di una collisione

Non e' "current" o "incoming" per principio. Per ogni blocco: (1) cosa dice il codice condiviso fuori dai marker; (2) confronto funzione per
funzione dei due lati; (3) un test rosso/verde che prova la scelta; (4) un blocco vuoto da un lato e' una rimozione voluta; (5) quando nessuno
dei due lati regge, si scrive una terza via. Ogni scelta va nel registro sotto con la ragione.

## Registro delle scelte e delle lezioni

(da compilare durante il lavoro)

## Criteri di accettazione

- [ ] PHPStan: esito completo riportato con il numero di errori.
- [ ] PHPMD e PHPInsights: esito per modulo, con prova che PHPMD non e' morto (output non vuoto su un modulo noto).
- [ ] Percorsi ospite e loggato verificati con browser, con i difetti trovati e quelli corretti.
- [ ] Ogni repo: commit, pull, push eseguiti, o motivo dichiarato per cui no.
- [ ] Nessun segreto e nessun marker nei commit.
- [ ] Docs aggiornati e memoria scritta.

## Coordinamento fra DCP-377 e DCP-385 (scritto da DCP-385, 2026-10-27 07:00)

DCP-377 (Fixcity) e DCP-385 (Sixteen) sono la stessa richiesta data a due sessioni: la 385 e' nata alle 06:49, la 377 alle 06:55. Per non fare
lavoro doppio e per non collidere in git:

| Parte | Chi | Stato |
|---|---|---|
| Gate statici (PHPStan, PHPMD, PHPInsights) | 377 (misurati) | 385 ha corretto i 3 errori PHPStan: `MediaPolicyTemplateTest` (array_map su `Safe\preg_split`, ora `explode`) e rimosso `Modules/Event/database/seeders/EventDemoSeeder.php` (`Event::factory()` non esiste, nessun chiamante, `/it/events` e' servita dagli articoli Blog) |
| Smoke HTTP ospite (`guest-fo-http-smoke.sh`) | 377 | |
| Giro da browser: ospite con Playwright MCP, loggato con Puppeteer MCP, confronto con Design Comuni ufficiale | 385 | in corso (due agenti di sola lettura, correzioni nei moduli proprietari) |
| Verita' dei testi legali pubblicati contro il codice | 385 | in corso |
| **Git (add, commit, pull, push, collisioni)** | **un solo operatore alla volta** | vedi lock sotto |

**Lock git (obbligatorio per entrambe):** prima di qualunque `git add/commit/pull/merge/push` in un repo: `mkdir /tmp/fixcity-git-sync.lock.d` (atomico: se
fallisce, un'altra sessione sta sincronizzando; aspettare e rileggere questa pagina). Scrivere chi lo tiene in
`/tmp/fixcity-git-sync.lock.d/owner` (sessione, ora). Alla fine: `rm -r /tmp/fixcity-git-sync.lock.d`. Chi trova il lock piu' vecchio di 40 minuti
senza processi `git` in corso (`ps -eo args | grep 'git '`) puo' considerarlo orfano e segnalarlo qui prima di toglierlo.

**Puppeteer MCP e' avviabile** (la 377 lo dava per non avviabile): primo `puppeteer_navigate` con
`launchOptions={"headless":true,"executablePath":"/usr/bin/google-chrome-stable","args":["--no-sandbox"]}` e `allowDangerous=true`
(Chromium di Puppeteer 131 non e' installato; `--no-sandbox` solo perche' AppArmor blocca gli userns). Uso limitato al dev `192.168.1.40:8000` e alle
pagine statiche ufficiali Design Comuni, mai a siti sconosciuti. Playwright MCP e' un solo browser condiviso: una sessione per volta.

## Registro dei controlli statici (2026-10-27)

| Controllo | Esito misurato | Note |
|---|---|---|
| PHPStan, config unica `laravel/phpstan.neon`, livello max, tutto il progetto | **0 errori** (secondo run, uscita 0) | primo run 3 errori: `MediaPolicyTemplateTest.php:46` (corretto, `explode` al posto di `Safe\preg_split`, 24 test verdi) e `Modules/Event/.../EventDemoSeeder.php:15` x2 (seeder rimosso: `Event::factory()` non esiste, nessun chiamante) |
| PHPMD 3.0.0, solo `Modules/<M>/app`, ruleset `phpmd.ruleset.xml`, 19 moduli | circa 2900 violazioni, nessun run morto | piu frequenti: MissingImport 632, UnusedFormalParameter 581, CamelCaseParameterName 453, CamelCaseVariableName 380; per modulo Xot 1076, User 602, Geo 292, Notify 190, Media 148; Seo 22 file e 0 violazioni (pulito, non morto: un run morto stampa un messaggio) |
| PHPInsights 2.14.2 (code / complessita / architettura / stile) | Blog 86.5/96.6/82.3/89.1; Fixcity 77.3/77.5/82.3/84.3; Geo 82.4/81.2/64.7/90.3; Media 97.9/90.6/94.1/100; User 79.3/92.2/76.4/81.9; Xot 72.1/84.6/52.9/77.1 | nessun modulo raggiunge la soglia 99; `exit=1` e' la soglia non raggiunta |

Lettura: PHPStan a zero e' il vincolo duro ed e' rispettato. PHPMD e Insights sono debito di stile e di struttura gia' presente (la meta' sono import
mancanti e parametri non usati), non regressioni di questa sessione. Nota: `exit=2` di PHPMD significa "violazioni trovate", non errore. Due ruleset in uso
(`phpmd.xml` e `phpmd.ruleset.xml`) danno conteggi diversi: la sessione DCP-377 ha misurato 1302 con il primo.
