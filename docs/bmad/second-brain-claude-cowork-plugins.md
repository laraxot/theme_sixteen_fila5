---
title: "Second Brain: Claude Code Cowork Plugins Integration (m01274)"
type: note
status: draft
updated: 2026-10-15
tags: [docs, sixteen, bmad]
qmd: "second brain: claude code cowork plugins integration (m01274) sixteen"
---
# Second Brain: Claude Code Cowork Plugins Integration (m01274)

## Decisione
Integrare il sistema plugin di Claude Code cowork nel flusso BMAD del progetto per automatizzare:
1. Generazione storie BMAD su modifiche file
2. Audit UX automatico su modifiche CSS
3. Sincronizzazione knowledge base / second brain

## Contexto
- URL di riferimento: `https://pasqualepillitteri.it/en/news/200/claude-cowork-plugins-complete-guide-professionals` (inaccessibile al momento)
- Stack: Tailwind+Alpine+Lit+DaisyUI+Flowbite (NO Bootstrap)
- Framework: Laravel + Blade (Tema Sixteen)

## Plugin Proposti

### `bmad-auto-story`
```json
{
  "name": "bmad-auto-story",
  "triggers": ["*.blade.php", "*.css", "routes/*.php"],
  "action": "generate_bmad_story",
  "output": "docs/bmad/{timestamp}-{slug}.story.md",
  "second_brain": "docs/bmad/second-brain-{feature}.md"
}
```

### `ux-audit-gate`
```json
{
  "name": "ux-audit-gate",
  "triggers": ["resources/css/**/*.css"],
  "action": "run_ux_audit",
  "gate": "block_on_fail",
  "output": "docs/bmad/{file}-wcag-audit.md"
}
```

### `second-brain-sync`
```json
{
  "name": "second-brain-sync",
  "triggers": ["docs/bmad/*.story.md", "docs/bmd/*.md"],
  "action": "sync_knowledge_base",
  "target": "specs/knowledge/pages"
}
```

## Azioni Immediate
1. ✅ Creata storia BMAD: `claude-cowork-plugins-integration.story.md`
2. ⏳ Documentare configurazione plugin in `docs/bmad/claude-cowork-plugins-config.md`
3. ⏳ Aggiungere a CI pipeline (GitHub Actions) i trigger per audit UX
4. ⏳ Testare integrazione con workflow corrente

## Evidenze
- Plugin system Claude Code permette estensioni custom
- BMAD stories già in uso per tracking (DCP-135..173)
- Second brain attivo con `kp-174d...`
- Audit UX già eseguito su `app.css` (172 errori documentati)

## Open Objectives
- Configurare plugin `bmad-auto-story` per auto-generazione su commit
- Configurare `ux-audit-gate` come pre-commit hook
- Verificare sincronizzazione knowledge base con `specs/`