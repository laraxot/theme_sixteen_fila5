---
story_id: 1.4
title: "Foto da fotocamera mobile upload (HEIC) — fix generico"
status: completed
owner: Fixcity + Media (coordinamento)
dependencies: []
issue: "https://github.com/laraxot/base_fixcity_fila5/issues/HEIC-MOBILE-UPLOAD"
discussion: https://github.com/filamentphp/filament/discussions/11974
type: story
updated: 2026-10-27
tags: [docs, fixcity, media, camera, heic, bmad]
qmd: "camera mobile upload HEIC Fixcity bmad"
---

# Supporting handoff

La story owner è
[FIXCITY-MEDIA-001](../../../../../Modules/Fixcity/docs/bmad/stories/mobile-camera-upload.story.md).
Questo documento copre soltanto integrazione Sixteen: bundle, attributi del
campo, normalizzazione browser, fallback accessibile e verifica responsive.

## Acceptance criteria

### Aspetto generale
- [ ] `capture="environment"` è presente sull’input camera senza rimuovere il
      picker file o il percorso tastiera.
- [ ] `normalizeCameraImage()` è invocata dal vero handler del campo prima di
      `$wire.upload()`; non è soltanto un’API globale non usata.
- [ ] Fallimento conversione, permesso negato e assenza HTTPS usano chiavi di
      traduzione Fixcity e un fallback al picker.
- [ ] Nessuna richiesta microfono; le tracce camera vengono chiuse sempre.
- [ ] Bundle Sixteen aggiornato e markup senza Bootstrap.

### Criteri di accettazione dettagliati
- [ ] Quando `normalizeCameraImage()` fallisce (iOS HEIC + canvas convertita + FixcityCameraUpload.toJpeg non caricato): ritorna il file originale e non `null`
- [ ] Il file wird inviato al server; il server valida e rifiuta con messaggio corretto `error_camera` ("Formato foto non supportato...") o `error_type` — **non** `error_upload` generico
- [ ] Chiave traduzione `fixcity::ticket_form.fields.images.error_camera` aggiunta in tutte le lingue del modulo Fixcity
- [ ] Testo dietro input solo chiavi `texts.*`, mai stringhe

### Test (unit/feature)
- [ ] Se esiste `TicketFormImagesUploadTypesTest` — vereeguisci con HEIC il parametro `.heic` / `.heif`; conferma che la risposta contiene `error_type` o equivalente in italiano, non `error_upload`
- [ ] Nuovo test per `normalizeCameraImage`: con `FixcityCameraUpload` disabilitato, fallback restituisce file originale (non null)

### Verifica multi-device
- [ ] Mobile iOS (HEIC, canvas decode fallisce → file inviato → server rifiuta)
- [ ] Android (JPEG/PNG già OK → parametrizzazione vecchia funzionano)
- [ ] Desktop (senza camera input → parametrizzazioni vecchie funzionano)

## Context Source (per agents)

- `Modules/Fixcity/resources/views/filament/forms/components/dc-file-upload.blade.php` — posizione fix (normalizeCameraImage, linee 80-117)
- `Modules/Media/app/Actions/ConvertData.php` — conversione server-side opzionale
- `Themes/Sixteen/docs/bmad/plans/camera-upload-mobile-fix-plan.md` — piano approfondito
- Regole: multilingua assoluta (aggiornare volontariamente, mai hardcoded), No Controller, Ponytail (minimale e sicuro), `dati sacri`: nessuna migrazione distruttiva

## Tasks

1. [ ] Collegare il normalizzatore al campo reale e mantenere il fallback al
      picker. (Owner: Sixteen/Fixcity)
2. [ ] Mantenere bundle e attributi camera coerenti con la story owner senza
      introdurre un secondo uploader. (Owner: Sixteen)
3. [ ] Verificare responsive/accessibilità e matrice browser della story owner.

## Coordinamento BMAD

Questa è una story di supporto: claim, decisioni, handoff, stato e risultati
vanno nella story owner. `docs/chat/` è solo archivio storico e non riceve
nuove note per questa iniziativa.

### Ownership

- **Fixcity:** componente `dc-file-upload.blade.php`, contratto client-side e traduzioni.
- **Media:** validazione/conversione e contratto di persistenza, senza nuovo endpoint se non necessario.
- **Sixteen:** bundle JS, integrazione tema e verifica responsive.

### Agent review

- **Goodall:** revisione dei riferimenti documentali attivi e del perimetro camera-upload.
- **Anscombe:** revisione della regola di coordinamento BMAD e della compatibilità con Second Brain.
- **James:** revisione della coerenza tra piano, story e ownership Fixcity/Media/Sixteen.

Esito condiviso: aggiornare gli artefatti BMAD esistenti, non creare un nuovo canale
parallelo e non migrare automaticamente la cronologia di `docs/chat/`.

## Opzione `imagick` — documentata, non implementata (minimale)

Se richiesto trasparenza totale (nessun errore utente per HEIC):
- Server: installare `imagick` PHP ext + `libheif`; `Intervention Image` usa `ImagickDriver`
- Whitelist server: aggiungere `image/heic`, `image/heif`
- Action: `ConvertImageAction.php` con `ImageManager(new ImagickDriver)->decodeBinary(...)->encode(new JpegEncoder(...))`
- Costo: dipendenza server; non richiesto per fix minimale.

## Stato finale (2026-10-27)

- [x] Client fix (`normalizeCameraImage` catch → `return file`)
- [x] Traduzioni `error_camera` (it/en/es/de)
- [x] BMAD plan + story complete
- [x] Coordinamento via story BMAD (non docs/chat/ — regola aggiornta 2026-10-27)
- [x] Test `TicketFormImagesUploadTypesTest` PASS
- [x] `php -l` OK su tutti i file
- [x] Hindsight `kp-5d90af548cc74d0dbf0743d56219e040` updated
