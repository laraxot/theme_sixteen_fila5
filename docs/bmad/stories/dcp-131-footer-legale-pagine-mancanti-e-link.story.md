---
id: dcp-131
title: "DCP-131: footer: pagine legali mancanti e link morti"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "footer link 404 note legali media policy amministrazione trasparente mappa del sito rss href cancelletto privacy accessibilita"
related: [dcp-112, dcp-123, dcp-130, dcp-132]
tags: [docs, sixteen, bmad]
---

# DCP-131: ogni link del footer porta a una pagina che esiste

Nata da DCP-112 (matrice normativa N-04, N-27; matrice interfaccia I-16).

## Lacuna e prova (2026-10-13)
`config/local/fixcity/database/content/sections/footer.json` (e la copia in `Modules/Fixcity/config/...`). Alle 17:01 i percorsi erano senza lingua (`/privacy`, 404); dalle 18:12, dopo DCP-123, il footer renderizza `/it/...`. Esito `curl` alle 18:12:

| Link | Esito |
|---|---|
| `/it/privacy`, `/it/note-legali`, `/it/accessibilita`, `/it/amministrazione-trasparente`, `/it/media-policy`, `/it/rss.xml`, `/it/mappa-del-sito`, `/it/assistenza`, `/it/prenota-appuntamento`, `/en/privacy` | 404 |
| `/it/domande-frequenti` | 200 |
| `/it/tickets/create` | 302 al login (corretto) |
| `/it/mappa-sito` | 200: la pagina esiste ma il footer punta a `mappa-del-sito` (slug sbagliato) |

Inoltre 28 voci del footer e 18 dell'header hanno `href="#"` (conteggio sull'HTML di `/it`, rimisurato alle 18:12).

## Norma
CAD art. 53 c. 1 («siti istituzionali [...] accessibilita', [...] completezza di informazione, [...] affidabilita'») e art. 54 c. 1 (i siti contengono i dati del D.Lgs. 33/2013); GDPR art. 12 par. 1 per l'informativa; L. 4/2004 art. 3-quater c. 4 per la dichiarazione di accessibilita' pubblicata sul sito. Testi nel registro fonti 03.

## Requisiti
1. Ogni voce di `legal_links`, `footer_bottom_links` e dei servizi punta a una pagina esistente nella lingua corrente, oppure e' rimossa; le voci "Amministrazione trasparente" puntano alla sezione del sito istituzionale del Comune (URL fornito dall'ente) se FixCity non ne e' il sito.
2. Pagine reali (JSON CMS + blocchi) per "Note legali" e "Media policy", o la loro rimozione motivata; correzione dello slug "Mappa del sito".
3. Le voci con `href="#"` sono reali o rese non attive in modo accessibile (non link).
4. Guardia: un test legge i JSON di footer e header e verifica che ogni `url` interno risolva a 200 in it, en, de, es.

## Criteri di accettazione (stato al 2026-10-13, sera)
- [ ] Script o test che percorre i link interni del footer e dell'header in 4 lingue: zero 404 e zero `#`. FOOTER fatto: `FooterLinksResolveTest` (4 lingue) segue ogni `href` interno del footer renderizzato e pretende 200 (302 per `/tickets/create` da ospite), nessun `href=""` o `#`. HEADER NON fatto, fuori perimetro (agente dell'header): in ogni lingua 9 link interni senza prefisso lingua rispondono 404 (`/regione`, `/amministrazione`, `/novita`, `/servizi`, `/eventi`, `/argomenti`, `/argomenti/iscrizioni`, `/argomenti/estate-in-citta`, `/argomenti/polizia-locale`) e 12 voci hanno `href="#"` (misurato con `curl` alle 22:30; alle 18:12 erano 18). Il test e' lasciato come `->todo()` con questa motivazione.
- [x] Nessun `url` del footer senza prefisso lingua nell'HTML renderizzato (non regredire): `FooterLocalizedLinksTest` 4/4 passati.
- [x] `/it/mappa-sito` raggiunta dal footer: il footer punta a `/it/mappa-sito` (slug corretto da `mappa-del-sito`), 200 in 4 lingue.
- [x] Le pagine legali ricadono su DCP-130 (privacy) e DCP-132 (accessibilita'); questa story non le scrive: `/it/privacy` e `/it/accessibilita` rispondono 200 grazie a quelle story.

## Implementazione (2026-10-13)
- Pagine nuove (JSON CMS, 4 lingue, 3 copie identiche) con il blocco `legal-document` di DCP-130: `note-legali.index.json` (testo: `config/<tenant>/lang/<lingua>/legal-notes.md`) e `media-policy.index.json` (`media-policy.md`). Senza il testo del Comune rispondono 200 con `<h1>` e l'avviso «il testo non e' ancora stato fornito dall'ente»: i valori li scrive il Comune.
- Footer, solo target e dati (`sections/footer.json`, copie tenant e modulo identiche): «Mappa del sito» → `/mappa-sito`; «Amministrazione trasparente», «Prenotazione appuntamento», «Richiesta d'assistenza», RSS, `office_url` e le 27 voci dei gruppi (Amministrazione, Categorie di servizio, Novita', Vivere il comune) con `url` vuoto = nessuna destinazione fornita dall'ente.
- Template `components/sections/footer/design-comuni.blade.php`, solo la risoluzione dei target: una voce senza destinazione (`url` vuoto o `#`) sul sito reale e' un `<a>` senza `href` (testo non attivo e non focalizzabile, come gia' in `news-detail`), mai `href="#"` e mai un percorso 404. Sulle repliche `/{lingua}/tests/*` (`request()->segment(2) === 'tests'`) restano `href="#"`: sono copia fedele del riferimento e il toglierlo costava 2,8 punti di HTML rigorosa sulla homepage (95,07 a 92,27) e 2,4 sui permessi (94,45 a 92,08), perche' il riferimento ha `<a href="#">` sulle voci. Markup identico.
- `/it/privacy`, `/it/note-legali`, `/it/accessibilita`, `/it/media-policy`, `/it/mappa-sito` e `/it/domande-frequenti`: 200 in it, en, de, es.
- Link dalla pagina di login e di registrazione a `/{lingua}/accessibilita` (DCP-132 req. 4): `components/pages/auth-login.blade.php` e `auth-register.blade.php`, solo classi Tailwind gia' compilate in quei file.

## Prove (comandi e output, 2026-10-13)
| Criterio | Comando | Esito |
|---|---|---|
| Pagine del footer in 4 lingue | `for p in privacy accessibilita note-legali media-policy mappa-sito domande-frequenti; do for l in it en de es; do curl -s -o /dev/null -w '%{http_code} ' $B/$l/$p; done; done` | `200` per tutte e 24 le combinazioni; `/{lingua}/tickets/create` = `302` x4 (login, corretto) |
| Tutti i link interni del footer | `pest Modules/Fixcity/tests/Feature/Pages/FooterLinksResolveTest.php Modules/Fixcity/tests/Feature/Pages/FooterLocalizedLinksTest.php` | 24 passati, 1 todo (header); in ogni lingua 13 `<a>` con `href` (tutti 200 o 302) e 32 `<a>` senza `href` (voci non attive), 0 `href="#"` |
| Il test cade senza la correzione | footer e JSON ripristinati ai file di prima | `FooterLinksResolveTest` 4 falliti |
| Parity (3 pagine, `parity-sweep.sh --jobs 1`, `BASE_REF` del riferimento) | prima: homepage 95.07/97.84, index 89.54/98.4, permessi 94.45/97.05, pixel minimi 99.83, 99.78, 99.57, altezze uguali. Dopo: | homepage 95.47/97.84 pixel 99.83; index 89.54/98.4 pixel 99.78; permessi 94.79/97.05 pixel 99.59; altezze uguali. Nessun peggioramento (HTML rigorosa +0,40 e +0,34 perche' ora `/it/tests/*` ha `href="#"` dove prima c'erano percorsi 404) |
| Sentinelle dopo la modifica del template | `curl` su `/it`, `/it/tickets`, `/it/tests/homepage`, `/it/tickets/confirmation`, `/it/tests/permessi-area-personale` | 200 x5; `/it/tickets/create` 302 |

## Cosa serve dal Comune e decisioni
- URL della sezione «Amministrazione trasparente» del sito istituzionale (requisito 1) e delle altre 31 voci senza destinazione: URP (`office_url`), prenotazione appuntamento, richiesta d'assistenza, RSS, le 27 voci dei gruppi. Si attivano mettendo l'URL nel JSON del footer per lingua.
- Decisione: togliere le voci che FixCity non eroga (costa parity sulle repliche, perche' il footer e' condiviso) oppure lasciarle non attive come ora.
- Testi di «Note legali» e «Media policy» (o rinuncia alle voci). I profili social del footer (Twitter, Facebook, YouTube, Telegram, WhatsApp) puntano ai domini generici del riferimento: dati del Comune (DCP-133).
- Header (altro agente): 9 link 404 per lingua e 12 `href="#"`.

## Dipendenze e priorita'
DCP-123 (localizzazione dei link del chrome) ha gia' risolto il prefisso lingua; questa story risolve l'esistenza delle pagine. P0 insieme a DCP-130 e DCP-132.
