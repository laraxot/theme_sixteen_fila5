---
name: "Claude Code Cowork Plugins Integration"
title: "Integrazione Claude Code Cowork Plugins nel Sistema di Sviluppo"
description: "Estende Claude Code con plugin per BMAD, UX audit e sincronizzazione second brain."
created: "2026-10-14"
updated: "2026-10-14"
github_issue: "#14"
discussion: "https://github.com/orgs/fixcity/discussions/claude-code-cowork-plugins"
tags:
  - bmad
  - second-brain
  - claude-code
  - automation
type: story
status: draft
qmd: "claude cowork plugins integration.story sixteen"
---

## Obiettivo
Integrare il sistema dei plugin di Claude Code cowork nel nostro flusso di sviluppo, legandolo a BMAD stories e second brain per automatizzare la generazione di documentazione, audit e aggiornamenti.

## Plugin Proposti

### 1. `bmad-auto-story`
- **Trigger**: modifica file `.blade.php`, `.css`, `routes/*.php`
- **Azione**: genera `.story.md` in `docs/bmad/`
- **Second Brain**: aggiorna `docs/second-brain-*.md`

### 2. `ux-audit-gate`
- **Trigger**: salvataggio file CSS in `resources/css/`
- **Azione**: lancia `ux_audit` e scrive risultato in `docs/bmad/*-wcag-audit.md`
- **Gate**: fallisce CI se errori non risolti

### 3. `second-brain-sync`
- **Trigger**: creazione o modifica file
- **Azione**: sincronizza knowledge base con `specs/`
- **Formato**: aggiorna pagine in `knowledge/pages`

## Integrazione con Stack Esistente
- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap)
- Framework: Laravel + Blade (Tema Sixteen)
- BMAD stories in `laravel/Themes/Sixteen/docs/bmad/`
- Second brain in `laravel/Themes/Sixteen/docs/bmad/second-brain-*.md`

## Criteri di Accettazione
- [ ] Plugin `bmad-auto-story` genera almeno una storia per ogni commit
- [ ] Plugin `ux-audit-gate` blocca merge se audit fallisce
- [ ] Second brain sincronizzato automaticamente
- [ ] Documentazione plugin disponibile in `docs/bmad/claude-cowork-plugins.md`

## Related
- `privacy-page-integration.story.md`
- `cookiebar-bootstrap-italia-integration.story.md`
- `quality-audit-cookiebar-disclaimer.md`