---
id: dcp-112
title: "DCP-112: scopo del progetto, norme applicabili e come le rispettiamo (con prove e lacune)"
type: story
epic: dc-parity-v2
status: in-review
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "scopo progetto fixcity norme conformita gdpr cad spid cie accessibilita legge stanca cookie garante nis2 matrice prove lacune dcp-130 dcp-145 imprecisioni documenti"
related: [dcp-54, dcp-106, dcp-111, dcp-42, dcp-48, dcp-49, dcp-102, dcp-120, dcp-123]
tags: [docs, sixteen, bmad]
---

# DCP-112: scopo, norme e conformita' con prove

## Richiesta (utente, 2026-10-13)
«Andare a fondo sullo scopo del progetto: perche' lo stiamo facendo cosi', quali sono le norme legislative che dobbiamo rispettare e come le stiamo rispettando.» In piu': organizzare e migliorare le cartelle `docs/` dei moduli e del tema, e rispettare multilingua, mobile e accessibilita'. Prodotto professionale e accademico. Regola dell'incarico: nessuna affermazione normativa senza fonte primaria con articolo e data; cio' che non si riesce a verificare e' «NON VERIFICATO: da validare con DPO/legale». Lavoro di studio, prova e documentazione: nessun codice, vista, JSON o CSS modificato; le correzioni diventano story.

## Fase BMAD
Analysis + Verify (con Documentazione). Artefatti: i documenti sotto e le 16 story di chiusura DCP-130..145. Nessuna implementazione.

## Metodo
1. Lettura critica dei documenti indicati (epic DCP-00, DCP-106, DCP-42, `ticket-wizard-frontoffice.md`, panoramica del modulo, regola CSS, documenti dell'altra sessione sull'header) e del brief, del PRD e del piano di sicurezza in `bmad-output/`.
2. Verifica normativa su fonte primaria scaricata con `curl` (Normattiva in Akoma Ntoso, archivio Cellar dell'UE perche' EUR-Lex risponde 202 a `curl`, Garante, AgID, ACN, GitHub per le licenze), affidata a due agenti di verifica (privacy e sicurezza; CAD e accessibilita') con vincolo di citare solo il testo scaricato e di marcare «DA MEMORIA» cio' che non lo e'. Riletta a campione da questa sessione (vedi i registri).
3. Prove sul progetto reale (2026-10-13, ambiente locale `http://192.168.1.40:8000`): `curl` su decine di percorsi; Playwright su 10 pagine (cookie, richieste di terze parti, scorrimento orizzontale, bersagli piccoli, `axe-core` con tag wcag2a, wcag2aa, wcag21a, wcag21aa); 9 tentativi di login con email inesistente; 14 richieste al tracciamento; `grep` su codice e config; `php artisan tinker` in sola lettura (`Treatment`, `Consent`); `git log` sulla pagina privacy. Un browser alla volta (carico macchina 44).
4. Nessun test Pest, build, `view:clear`, `config:clear`, `optimize`. Nessuna scrittura su file di altre sessioni, salvo l'aggiunta ancorata degli INDEX.

## Documenti prodotti
| File | Contenuto |
|---|---|
| `Modules/Fixcity/docs/compliance/00-scopo-del-progetto.md` | Cos'e' FixCity, problema pubblico, attori, ciclo del ticket, perche' e' costruita cosi' (scelta, motivazione, costo, fonte) |
| `Modules/Fixcity/docs/compliance/01-matrice-conformita-normativa.md` | 39 righe: dati personali, sicurezza, CAD e identita', procedimento, trasparenza, riuso, licenze; appendice di comandi; domande al DPO e al legale; imprecisioni trovate |
| `Themes/Sixteen/docs/compliance/01-matrice-conformita-interfaccia.md` | 27 righe: accessibilita', lingue, design, cookie e terze parti sul front-end, mobile, licenze |
| `Modules/Fixcity/docs/compliance/02-fonti-privacy-sicurezza-verificate.md` | Registro di 84 voci (66 verificate, 17 parziali, 1 non verificata) |
| `Modules/Fixcity/docs/compliance/03-fonti-cad-accessibilita-verificate.md` | Registro di 153 voci (121 verificate, 27 parziali, 5 non verificate) |
| `INDEX.md` di `Modules/Fixcity/docs/` e `Themes/Sixteen/docs/` | Sottocartelle e loro scopo, con la cartella `compliance/` |

## Sintesi dello stato
66 righe di matrice (39 normative, 27 di interfaccia):

| Stato | Normativa | Interfaccia | Totale |
|---|---:|---:|---:|
| conforme | 0 | 3 | 3 |
| parziale | 10 | 9 | 19 |
| assente | 8 | 6 | 14 |
| non applicabile | 3 | 1 | 4 |
| NON VERIFICATO | 18 | 7 | 25 |
| informativo | 0 | 1 | 1 |

Le tre righe conformi sono controlli specifici e riproducibili (salto ai contenuti e alternative testuali, `lang` della pagina, assenza di scorrimento orizzontale a 375 e 768 px sulle pagine misurate). Il resto dell'esito e' sfavorevole per un servizio che dovrebbe andare in produzione per un Comune: informativa non raggiungibile, nessuno SPID o CIE, dichiarazione di accessibilita' assente, nessun limite di tentativi al login, nessuna intestazione di sicurezza, nessuna procedura per i diritti dell'interessato.

## Le cinque lacune piu' gravi, con prova
1. **Informativa privacy non raggiungibile e incompleta** (N-03, N-04). `curl /it/privacy` = 404; la pagina `Themes/Sixteen/resources/views/pages/privacy/index.blade.php` e' stata cancellata dal commit `30d521c` (2026-10-11); il testo tenant (`lang/it/policy.md`, circa 700 byte) non indica titolare, DPO, base giuridica, conservazione, diritti ne' reclamo. Story DCP-130, DCP-131.
2. **Nessun SPID o CIE** (N-24). Il login e' email e password; CAD art. 64 c. 2-quater e 3-bis e D.L. 76/2020 art. 24 impongono SPID e CIE per i servizi PA che richiedono identificazione, dal 28.2.2021. La qualificazione del servizio e' del legale, il fatto tecnico e' provato (`sso_providers` 0 righe). Story DCP-144.
3. **Dichiarazione di accessibilita' assente** (I-01). `/it/accessibilita` = 404; il componente d'esempio non e' usato e ha valori fittizi; nessun feedback (L. 4/2004 art. 3-quater c. 2 lett. b). Story DCP-132.
4. **Limite di tentativi inefficace e nessuna intestazione di sicurezza** (N-13, N-14). Alle 17:08: 9 tentativi errati senza blocco. Alle 17:28 un'altra sessione ha aggiunto un `RateLimiter` nel widget di login, ma rimisurato alle 18:07 il blocco non scatta (8 tentativi, `RateLimiter::attempts` = 0; `bootstrap/cache/config.php` ha `cache.default = 'array'`). `curl -I` senza CSP, `X-Frame-Options`, `nosniff`, HSTS; `SecurityHeaders` non e' registrato. Story DCP-138, DCP-139.
5. **Diritti dell'interessato e prova dei consensi** (N-02, N-06, N-10). Nessun canale per gli artt. 15-22; `Treatment` e `Consent` hanno 0 righe quindi la registrazione non puo' lasciare traccia del consenso; `privacyAccepted` non e' persistito. Story DCP-134, DCP-135, DCP-140, DCP-142.

## Story di chiusura (una per lacuna)
Numerazione: DCP-113..119 non sono stati usati perche' `DCP-104` cita «claim dcp113» (etichetta di un altro agente) e il blocco 120-124 e' gia' occupato da altre story di questo lotto; DCP-130..145 sono liberi (verificato con `find`). Le story non sono implementate.

| Story | Lacuna | Priorita' | Stato | Cartella |
|---|---|---|---|---|
| [DCP-130](../../../../../Modules/Fixcity/docs/stories/dcp-130-informativa-privacy-art13-e-pagina-servita.story.md) | Informativa art. 13 completa e pagina `/privacy` servita | P0 | ready-for-dev | Fixcity |
| [DCP-131](dcp-131-footer-legale-pagine-mancanti-e-link.story.md) | Footer: pagine legali mancanti e link 404 | P0 | ready-for-dev | tema |
| [DCP-132](dcp-132-dichiarazione-accessibilita-e-meccanismo-feedback.story.md) | Dichiarazione di accessibilita' e feedback | P0 | ready-for-dev | tema |
| [DCP-133](dcp-133-identita-dellente-e-recapiti-al-posto-dei-segnaposto.story.md) | Identita' dell'ente e recapiti reali | P0 | needs-data | tema |
| [DCP-134](../../../../../Modules/Fixcity/docs/stories/dcp-134-base-giuridica-e-casella-privacy-prova-di-presa-visione.story.md) | Base giuridica, casella privacy, prova | P0 (decisione) | needs-decision | Fixcity |
| [DCP-135](../../../../../Modules/Gdpr/docs/stories/dcp-135-registrazione-documenti-accettati-termini-e-consensi-registrati.story.md) | Registrazione: documenti, termini, consensi registrati | P1 | ready-for-dev | Gdpr |
| [DCP-136](../../../../../Modules/Gdpr/docs/stories/dcp-136-cookie-inventario-informazione-e-guardia-sui-cookie-impostati.story.md) | Cookie: inventario, informazione, guardia | P1 | ready-for-dev | Gdpr |
| [DCP-137](dcp-137-risorse-di-terze-parti-google-fonts-tessere-osm-nominatim.story.md) | Google Fonts, tessere OSM, Nominatim | P1 | ready-for-dev | tema |
| [DCP-138](../../../../../Modules/User/docs/stories/dcp-138-limite-di-tentativi-su-login-registrazione-e-azioni-costose.story.md) | Limite di tentativi che funzioni davvero | P1 | ready-for-dev | User |
| [DCP-139](../../../../../Modules/Fixcity/docs/stories/dcp-139-intestazioni-di-sicurezza-http-e-hardening-per-la-produzione.story.md) | Intestazioni di sicurezza e produzione | P1 | ready-for-dev | Fixcity |
| [DCP-140](../../../../../Modules/Gdpr/docs/stories/dcp-140-diritti-dellinteressato-procedura-e-strumenti.story.md) | Diritti dell'interessato | P1 | ready-for-dev | Gdpr |
| [DCP-141](../../../../../Modules/Gdpr/docs/stories/dcp-141-conservazione-log-e-minimizzazione-tecnica.story.md) | Conservazione, log, EXIF | P1 | needs-decision | Gdpr |
| [DCP-142](../../../../../Modules/Gdpr/docs/stories/dcp-142-accountability-registro-trattamenti-dpia-dpa-e-violazioni.story.md) | Registro, DPIA, nomine, violazioni | P1 | needs-data | Gdpr |
| [DCP-143](dcp-143-accessibilita-difetti-aria-e-audit-manuale-wcag-21-aa.story.md) | Audit manuale WCAG 2.1 AA, axe su pagine con login, ACC-01..05 | P1 | ready-for-dev | tema |
| [DCP-144](../../../../../Modules/User/docs/stories/dcp-144-accesso-del-cittadino-con-spid-cie-o-decisione-motivata.story.md) | SPID/CIE o decisione motivata | P1 | needs-decision | User |
| [DCP-145](dcp-145-licenze-e-attribuzioni-bsd3-font-icone-e-licenza-del-codice.story.md) | Licenze e attribuzioni | P2 | ready-for-dev | tema |

Coperte da story esistenti (non duplicate): tracciamento senza limite = DCP-102; `lang` delle parti, link localizzati, selettore lingua = DCP-123; copertura per lingua = DCP-120; pagine «Impostazioni e privacy» = DCP-111; pagine vuote con 200 = DCP-106; codice fiscale = DCP-48.

## Relazione con DCP-54
La story DCP-54 (modulo Fixcity, avviata alle 16:51, con il documento in corso `wiki/concepts/norme-e-conformita-fixcity.md`) ha lo stesso scopo e e' stata scritta in parallelo da un'altra sessione. Non e' stata modificata. Differenze: DCP-112 verifica ogni norma su testo scaricato e registra il testo nei registri 02 e 03, e misura le pagine con browser e `curl`; DCP-54 usa la sigla V/T/D/L e un'analisi del codice. Il coordinatore deve decidere se marcare una delle due `superseded` o collegarle; consiglio: tenere DCP-112 come riferimento normativo e far riferire DCP-54 al registro delle fonti. La nota di DCP-54 sul percorso errato di `fixcity-scopo-e-target.md` e' corretta ed e' ripresa qui.

## Imprecisioni nei documenti di altre sessioni
Elenco completo con prova nella sezione «Imprecisioni trovate nei documenti esistenti» della matrice normativa (16 voci). Le piu' rilevanti: le quattro pagine `*-area-personale` dichiarate 404 rispondono 200; `scopi-e-norme.md` usa l'id `dcp-24` gia' assegnato (due volte) e, insieme a `header-auth-logic.md`, contiene una credenziale di prova in chiaro (da rimuovere e ruotare; non e' ripetuta qui); `header.tailwind.blade.php` citato come file modificato non esiste; lo studio sul login cita l'EAA ed eIDAS e non il CAD art. 64 che impone SPID/CIE; i numeri D15, D16, D17 sono usati due volte; `privacy-policy-folio-route.md` e la story del gate danno per attiva una pagina cancellata il 2026-10-11.

## Cosa non ho potuto verificare
- Produzione: TLS (il proxy `https://192.168.1.40:8080` non risponde), intestazioni finali, backup, log reali, cookie senza debug bar.
- Pagine con login: wizard, area personale, back office (nessun axe, tastiera o lettore di schermo). Account di prova di DCP-98 non usato: la password non si legge ne' si scrive.
- Test Pest esistenti (citati, non rieseguiti per regola dell'incarico), compreso `LoginThrottleTest`.
- Perche' il limite di tentativi non scatta: la causa `cache.default = 'array'` nella config in cache e' la spiegazione piu' probabile, non provata (servirebbe `config:clear`, vietato qui).
- Stato dinamico: altre sessioni hanno modificato tema e login mentre lavoravo; i fatti che sono cambiati (footer localizzato, `/it/tickets` senza violazioni axe, rate limiter nel widget) sono rimisurati alle 18:07-18:12 e riportati con entrambi gli orari.
- Costo e algoritmo dell'hash, regola password lato server in registrazione (`ValidateUserDataAction` non letto).
- Norme: i punti PARZIALE e NON VERIFICATO dei registri 02 e 03 (testo EN 301 549, D.Lgs. 165/2001 art. 1 c. 2 per l'ambito dei Comuni, atto di adozione delle Linee guida di design, avviso in GU della det. 354/2022, effetto degli atti UE sul comunicato Garante 2022, clausole degli atti di esecuzione eIDAS, elenco completo delle Linee guida del Garante oltre le prime 11 voci, determine ACN 2026).
- Il Comune destinatario non e' definito: NIS2, L. 90/2024, L. 482/1999 e il regolamento sul procedimento dipendono da lui.

## Criteri di accettazione di questa story
- [x] `00-scopo-del-progetto.md` con scelte, motivazioni, costi e file citati.
- [x] Due matrici con riferimento preciso, prova, stato, rischio, story; nessun «conforme» senza comando o file riproducibile (appendici A).
- [x] Fonti primarie scaricate e registrate (237 voci); NON VERIFICATO con indicazione di cosa servirebbe.
- [x] Una story nuova per ogni lacuna assente o parziale con rischio medio o alto (verificato con script: nessuna riga senza story).
- [x] `INDEX.md` delle due cartelle `docs/` che elencano le sottocartelle e la cartella `compliance/`; nessun file spostato, rinominato o cancellato.
- [ ] Revisione del DPO e del legale (domande nella matrice normativa).

## Second brain
Memoria di progetto aggiunta: `scopo-e-conformita-dcp112.md` (indice in `MEMORY.md`). Wiki: i registri 02 e 03 sono la fonte; da indicizzare con QMD (`bash bashscripts/docs/llm-wiki-qmd.sh update`, non lanciato qui).
