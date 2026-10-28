---
id: dcp-97
title: "DCP-97: registro del flusso tickets/create: numerazione duplicata e coordinamento tra sessioni"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "registro numerazione dcp duplicati 32 33 34 35 tickets create wizard coordinamento sessioni story bmad claim"
tags: [docs, sixteen, bmad]
---

# DCP-97: un solo posto per sapere chi fa cosa sul wizard dei ticket

## Perche'
Nella stessa giornata piu' sessioni (la sessione tema, un'altra sessione sul wizard, sottoagenti) hanno aperto story con gli stessi numeri e argomenti vicini. Regola esplicita dell'utente: collaborare e coordinarsi tramite le story BMAD, lavorare in parallelo, in ordine casuale (swarm + subagent + BMAD + second brain). Regola di casa: non cancellare ne' rinumerare story esistenti, solo collegarle o marcarle `superseded`.

## Mappa dei numeri duplicati (non rinumerati)
| Numero | Story A (sessione tema, orchestratore) | Story B (altra sessione) | Relazione |
|---|---|---|---|
| DCP-32 | [scope `data-dc`](dcp-32-scope-data-dc-pagine-reali.story.md): attributo di scope CSS e layout dal JSON | [wizard passo 1 privacy](dcp-32-wizard-step1-privacy.story.md) | argomenti diversi: la B dipende dalla A |
| DCP-33 | [riepilogo + mappa, modulo Fixcity](../../../../../Modules/Fixcity/docs/stories/dcp-33-tickets-create-riepilogo-design-comuni-mappa.story.md) | [wizard passo 2 dati](dcp-33-wizard-step2-dati.story.md) | diversi (passo 3 contro passo 2) |
| DCP-34 | [conferma dopo il salvataggio, modulo Fixcity](../../../../../Modules/Fixcity/docs/stories/dcp-34-tickets-confirmation-design-comuni.story.md) | [wizard passo 3 riepilogo](dcp-34-wizard-step3-riepilogo.story.md) | la B (todo) duplica l'argomento della DCP-33 modulo: vale la DCP-33 modulo |
| DCP-35 | [passi 1-2 e coordinamento, modulo Fixcity](../../../../../Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md) | [conferma parity](dcp-35-conferma-parity.story.md) | la B (ready-for-dev) duplica la DCP-34 modulo: vale la DCP-34 modulo |
Per le pagine reali del flusso fanno fede, per argomento: **passo 1** DCP-35 modulo (S1) + DCP-32 wizard-step1; **passo 2** DCP-35 modulo (P2-*) + DCP-33 wizard-step2; **passo 3** DCP-33 modulo; **conferma** DCP-34 modulo. Le story B del tema che duplicano un argomento restano come storico e vanno lette come `superseded` dalla corrispondente del modulo (nota aggiunta in testa a ciascuna).
Altre numerazioni parallele dello stesso giorno: `dcp-78..83-*.story.md` (pagine homepage, argomenti, catalog, servizi, eventi, novita': altra serie, non sovrapposta ai numeri 20-31); `catalog/DC-00N-*` (marcata `superseded` dove coincide con DCP-31).
Numeri riservati per le story nuove della sessione tema: **DCP-90 .. DCP-99** (nessun conflitto con 78-83).

## Protocollo (da DCP-12, DCP-35)
1. Prima di scrivere: `find <dir> -mmin -10 -type f` e `git diff <file>`; modifiche ancorate e idempotenti; backup nello scratchpad.
2. Ogni agente dichiara file e ambito nella tabella claim della sua story e la chiude a fine lavoro (DCP-35 modulo, DCP-32 tema).
3. Build, `regenerate-design-comuni-css.sh` e `npm run build`: solo l'orchestratore, uno alla volta con `flock /tmp/design-comuni-build.lock`.
4. Test: mai `pest` nudo (la config cache fa ignorare `.env.testing`): `APP_ENV=testing DB_CONNECTION=sqlite APP_CONFIG_CACHE=/tmp/<file inesistente> ./vendor/bin/pest <file>`.
5. Numeri: `ls` delle cartelle `stories` prima di creare; i duplicati si collegano qui.

## Story aperte dalla sessione tema il 2026-10-13 (stato)
DCP-26..31 done con riserva; [DCP-32](dcp-32-scope-data-dc-pagine-reali.story.md), DCP-33, DCP-34 modulo in corso; nuove: [DCP-90](../../../../../Modules/Fixcity/docs/stories/dcp-90-test-rossi-preesistenti-flusso-tickets.story.md) (test rossi), [DCP-91](dcp-91-wizard-css-legacy-e-passi-su-data-dc.story.md) (CSS legacy e passi 1-2), [DCP-92](dcp-92-header-voce-servizi-attiva-e-menu-pagine-reali.story.md) (header), [DCP-93](../../../../../Modules/Geo/docs/stories/dcp-93-geo-namespace-blade-e-mappa-sola-lettura-follow-up.story.md) (Geo), [DCP-94](dcp-94-decisione-metrica-html-rigorosa.story.md) (decisione sulla metrica HTML), [DCP-95](dcp-95-strumenti-misura-filtri-hide-exclude-prepare.story.md) (strumenti di misura).

## Altre story dell'altra sessione sul flusso (modulo Fixcity, serie 41-46) e relazioni
| Story | Argomento | Relazione con la sessione tema |
|---|---|---|
| [DCP-42](../../../../../Modules/Fixcity/docs/stories/dcp-42-tickets-create-auth-regressione.story.md) | `tickets/create` solo da autenticati (`middleware` nel JSON) | eseguita e verificata dalla sessione tema il 14:00 (valore `["auth"]`, NON `web`); AC5: misure da autenticato |
| [DCP-43](../../../../../Modules/Fixcity/docs/stories/dcp-43-wizard-passo2-viste-design-comuni.story.md) | passo 2: viste Design Comuni non cablate | dipende dal cablaggio gia' fatto di shell/stepper/footer (DCP-33 > Cablaggio) e dalla regola dei passi inattivi (DCP-91) |
| DCP-44 | audit dei doc su tickets/create (44 file) | done, altra sessione |
| [DCP-46](../../../../../Modules/Fixcity/docs/stories/dcp-46-wizard-passo1-privacy-markup.story.md) | passo 1 privacy: markup e un solo h1 | stesso perimetro di DCP-35 S1 e DCP-32 wizard-step1 |
Nota di metodo: `fil-tickets-guest-access-why` (serie `fil-*`, altro agente) conteneva prove false ed e' `superseded` da DCP-42 (nota in testa).

## Aggiunte del lead DCP-35 (2026-10-13 14:33 UTC, nota di verifica)
| Story | Cosa | Stato |
|---|---|---|
| [DCP-47](../../../../../Modules/Fixcity/docs/stories/dcp-47-fixture-autenticata-misure-wizard.story.md) | fixture autenticata ISOLATA (istanza scratch, DB usa-e-getta); complementare a DCP-98 che usa il DB di sviluppo | in corso (subagent FIXTURE-AUTH) |
| [DCP-48](../../../../../Modules/Fixcity/docs/stories/dcp-48-codice-fiscale-autore-decisione.story.md) | codice fiscale dell'autore: analisi fatta, raccomandazione (c) riga omessa; decisione dell'utente | needs-decision |
| [DCP-49](../../../../../Modules/Fixcity/docs/stories/dcp-49-audit-sicurezza-viste-wizard.story.md) | audit di sicurezza e accessibilita': SEC-01 (status/priority dal client) e SEC-10 (`#[Locked]`) corretti con test; resto in backlog | in corso |
| [DCP-50](dcp-50-guardia-compilazione-template-blade.story.md) | guardia di compilazione dei template Blade + hardening `PageSlugMiddleware` (`web` ignorato, nome non risolvibile = errore chiaro) dopo gli incidenti 13:56 e 14:14 UTC | done |
Numerazione: nuove story del lead oltre DCP-50 a partire da 51; D17 e' `tickets-create-richiede-auth`, D18 libero.

## Aggiunte del lead 2026-10-14 (DCP-145..152, owner per cartella)
Elenco completo e raggiungibile di tutte le story del tema: [00-REGISTRO-COMPLETO.md](00-registro-completo.md). Qui solo i numeri che mancavano a questo registro.
| Story | Owner | Cosa |
|---|---|---|
| [DCP-145](dcp-145-licenze-e-attribuzioni-bsd3-font-icone-e-licenza-del-codice.story.md) | Sixteen | licenze e attribuzioni (BSD-3, font, icone, licenza del codice) |
| [DCP-146](../../../../../Modules/Fixcity/docs/stories/dcp-146-wizard-passo-dati-mappa-sempre-funzionante.story.md) | Fixcity | passo dati del wizard: mappa sempre funzionante (anche su HTTP) |
| [DCP-147](dcp-147-meta-description-pagine-cms-per-lingua.story.md) | Sixteen | meta description delle pagine CMS per lingua |
| [DCP-148](dcp-148-dettaglio-pubblico-segnalazione-e-segui.story.md) | Sixteen | dettaglio pubblico `/{lang}/tickets/{id}` e Segui |
| [DCP-149](../../../../../Modules/Fixcity/docs/stories/dcp-149-ricerca-per-codice-senza-limite-di-tentativi.story.md) | Fixcity | ricerca per codice di tracciamento senza freno ai tentativi |
| [DCP-150](../../../../../Modules/Fixcity/docs/stories/dcp-150-ricerca-elenco-per-indirizzo-sensibile-alle-maiuscole.story.md) | Fixcity | ricerca nell'elenco per indirizzo sensibile alle maiuscole |
| [DCP-151](../../../../../Modules/Fixcity/docs/stories/dcp-151-pagina-404-del-front-office-con-il-layout-del-tema.story.md) | Fixcity | pagina 404 del front office con il layout del tema |
| [DCP-152](../../../../../Modules/Geo/docs/stories/dcp-152-marker-dettaglio-ticket-e-pulsanti-mappa-su-pagine-dc.story.md) | Geo | marker del dettaglio con tipo e stato, pulsanti della mappa opachi nelle pagine DC |
Numerazione: prossimo numero libero DCP-153 (controllare `ls` delle tre cartelle prima di prenderlo). Non rinumerare nulla.
