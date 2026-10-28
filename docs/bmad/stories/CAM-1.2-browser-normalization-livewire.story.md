---
story_id: CAM-1.2
epic: CAM-1
title: "Normalizzazione browser collegata al temporary upload Livewire"
type: story
status: ready-for-dev
owner: Sixteen + Fixcity
priority: P1
---

# CAM-1.2: Normalizzazione browser collegata al temporary upload Livewire

## Story

Come cittadino mobile, voglio che la foto camera venga preparata prima
 dell’invio, così HEIC e foto ad alta risoluzione non falliscono nel trasporto.

## Acceptance Criteria (LOCKED)

1. Il campo usato dal wizard invoca realmente `prepare()` prima di
   `$wire.upload()` e invia il file risultante.
2. JPEG/PNG camera vengono ridimensionati e compressi entro il target; HEIC e
   HEIF vengono convertiti in JPEG quando il browser lo consente.
3. PDF non viene convertito e il picker galleria continua a funzionare.
4. Conversione fallita, file oltre limite e upload fallito rimuovono lo stato
   client incoerente e mostrano una chiave tradotta.
5. L’input camera usa `capture="environment"`, senza togliere percorso file,
   tastiera, cancel o replace.

## Tasks / Subtasks

- [ ] Collegare `normalizeCameraImage()` all’handler reale del campo. (AC: #1)
- [ ] Rendere bounded la normalizzazione JPEG/PNG/HEIC e preservare PDF.
  (AC: #2, #3)
- [ ] Gestire fallback, cleanup preview, cancel e replace. (AC: #4, #5)
- [ ] Verificare bundle Sixteen e asset import. (AC: #1, #2)

## Dev Notes (LOCKED)

- Il componente custom è `dc-file-upload`; il suo contratto di stato e
  `$wire.upload()` non va sostituito con un secondo uploader. [Source: ../../../../../Modules/Fixcity/resources/views/filament/forms/components/dc-file-upload.blade.php]
- L’adapter corrente è `camera-upload.js`; l’import sincrono non basta se il
  campo non invoca `prepare()`. [Source: ../../../resources/js/components/camera-upload.js]
- La cattura nativa con `capture` non richiede `getUserMedia` e resta disponibile
  anche quando il contesto non è HTTPS. [Source: ../../../../../Modules/Media/docs/bmad/mobile-camera-upload-investigation.md]
- Nessun testo visibile va scritto nel JavaScript; usare `texts` dal campo.
  [Source: ../../../../../Modules/Fixcity/docs/bmad/stories/mobile-camera-upload.story.md]

## Testing

- **Approach:** unit JS/Blade contract + browser Livewire integration.
- **Key scenarios:** JPEG 12 MP, PNG, HEIC/HEIF, PDF, cancel, replace,
  conversion failure, network failure.
- **Per-AC verification:** AC #1 spy su `prepare` e `$wire.upload`; AC #2
  dimensioni/MIME output; AC #3 PDF byte-identico; AC #4 state/error; AC #5
  keyboard and picker flow.
- **Fixtures / mocks:** JPEG alta risoluzione, HEIC reale, PDF, fake `$wire`.
- **Edge cases:** MIME vuoto, browser senza decoder HEIC, Safari canvas limit,
  object URL non revocato, doppio click.

## Dependency Maps

- **Blocked by:** CAM-1.1 per il target di trasporto.
- **Blocks:** CAM-1.5.
- **External:** browser File API, canvas, HEIC decoder, Livewire.

## Owned File/Module Scope

- `laravel/Modules/Fixcity/resources/views/filament/forms/components/dc-file-upload.blade.php`
- `laravel/Themes/Sixteen/resources/js/components/camera-upload.js`
- `laravel/Themes/Sixteen/resources/js/app.js`
- `laravel/Themes/Sixteen/tests/`

## Learnings from Previous Stories

- L’import del modulo senza una chiamata dal vero campo non prova il roundtrip.
  (from FIXCITY-MEDIA-001)
- La conversione HEIC da sola non copre JPEG/PNG camera ad alta risoluzione.
  (from FIXCITY-MEDIA-001)

## Dev Agent Record

_(empty — to be completed by the external dev tool)_
