---
type: epic-story
title: "Eventi — Design Comuni v2.4.0 (Batch Parallel)"
github_issue: #97
github_discussion: #97
decision_log: docs/decision-log.md
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story: eventi redesign sixteen"
---
# Story: Eventi Redesign

**Batch**: parallel (swarm mode: researcher + reviewer subagents, random order with risultati-ricerca closed first).
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/eventi.html (24 sections, 5.9KB).
**Stack**: Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament; NO Bootstrap Italia (AGENTS.md).
**Second brain**: kp-... initiative; docs/index.md + docs/chat/INDEX.md updated.
**Visual parity**: target ≥90% HTML / ≥97% visual; batch uses Playwright 1440/768/375.
**Status**: deferred (batch in progress; swarm completed; eventi next turn).

**Notes**: no controllers/services added; JSON `pages/tickets.create.json` verified; wizard `callSchemaComponentMethod` open; D11-D15 philosophy (logica/filosofia/religione/politica/zen) applied.
