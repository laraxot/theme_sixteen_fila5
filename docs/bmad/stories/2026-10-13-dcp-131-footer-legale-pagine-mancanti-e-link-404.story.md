---
id: dcp-131
title: "DCP-131: footer: pagine legali mancanti e link morti"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "footer link 404 note legali media policy amministrazione trasparente mappa del sito rss href cancelletto privacy accessibilita"
related: [dcp-112, dcp-123, dcp-130, dcp-132]
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

## Criteri di accettazione
- [ ] Script o test che percorre i link interni del footer e dell'header in 4 lingue: zero 404 e zero `#`.
- [ ] Nessun `url` del footer senza prefisso lingua nell'HTML renderizzato (gia' vero dopo DCP-123: non regredire).
- [ ] `/it/mappa-sito` raggiunta dal footer.
- [ ] Le pagine legali ricadono su DCP-130 (privacy) e DCP-132 (accessibilita'); questa story non le scrive.

## Dipendenze e priorita'
DCP-123 (localizzazione dei link del chrome) ha gia' risolto il prefisso lingua; questa story risolve l'esistenza delle pagine. P0 insieme a DCP-130 e DCP-132.
