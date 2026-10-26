---
title: "Configurazione Plugin Claude Code Cowork"
type: note
status: draft
updated: 2026-10-15
tags: [docs, sixteen, bmad]
qmd: "configurazione plugin claude code cowork sixteen"
---
# Configurazione Plugin Claude Code Cowork

## Installazione (concettuale - per implementazione futura)

```bash
# Quando i plugin saranno disponibili come pacchetto
npm install -g @claude-code/cowork-plugins
# oppure
claude plugins install cowork
```

## Plugin BMAD Auto-Story

### Configurazione `.claude/plugins/bmad-auto-story.json`
```json
{
  "name": "bmad-auto-story",
  "version": "1.0.0",
  "triggers": {
    "files": ["**/*.blade.php", "**/*.css", "**/routes/*.php"],
    "events": ["write", "edit"]
  },
  "action": {
    "type": "generate_story",
    "template": "docs/bmad/templates/story-template.md",
    "output": "docs/bmad/{timestamp}-{slug}.story.md",
    "frontmatter": {
      "github_issue": "#{{issue_number}}",
      "discussion": "https://github.com/orgs/fixcity/discussions/{{discussion}}",
      "tags": ["bmad", "second-brain", "auto-generated"]
    }
  },
  "second_brain": {
    "update": "docs/bmad/second-brain-{feature}.md",
    "format": "markdown"
  }
}
```

## Plugin UX Audit Gate

### Configurazione `.claude/plugins/ux-audit-gate.json`
```json
{
  "name": "ux-audit-gate",
  "version": "1.0.0",
  "triggers": {
    "files": ["resources/css/**/*.css"],
    "events": ["write", "edit"]
  },
  "action": {
    "type": "run_ux_audit",
    "command": "ux_audit --path {file}",
    "gate": "block_on_fail",
    "output": "docs/bmad/{file}-wcag-audit.md"
  }
}
```

## Plugin Second Brain Sync

### Configurazione `.claude/plugins/second-brain-sync.json`
```json
{
  "name": "second-brain-sync",
  "version": "1.0.0",
  "triggers": {
    "files": ["docs/bmad/*.story.md", "docs/bmd/*.md"],
    "events": ["write", "edit"]
  },
  "action": {
    "type": "sync_knowledge_base",
    "target": "specs/knowledge/pages",
    "format": "hindsight"
  }
}
```

## Integrazione CI/CD (GitHub Actions)

### `.github/workflows/claude-cowork.yml`
```yaml
name: Claude Cowork Plugins

on:
  push:
    paths:
      - 'resources/**/*.blade.php'
      - 'resources/css/**/*.css'
      - 'routes/web.php'
      - 'docs/bmad/**/*.md'

jobs:
  bmad-auto-story:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Run BMAD Auto-Story Plugin
        run: |
          claude plugin run bmad-auto-story --files "${{ github.event.head_commit.modified }}"

  ux-audit:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Run UX Audit Gate
        run: |
          npx ux_audit@latest resources/css/app.css

  second-brain-sync:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Sync Second Brain
        run: |
          claude plugin run second-brain-sync
```

## Status Attuale
- [x] Storia BMAD creata: `claude-cowork-plugins-integration.story.md`
- [x] Second brain documentato: `second-brain-claude-cowork-plugins.md`
- [x] Configurazione plugin documentata: `claude-cowork-plugins-config.md`
- [ ] Implementazione reale plugin (attesa disponibilità)
- [ ] CI/CD pipeline configurata