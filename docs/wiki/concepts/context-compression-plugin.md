---
name: context-compression-plugin
description: How the Context Compression plugin (context-mode) is used in the Sixteen theme for efficient token usage.
type: concept
---

# Context Compression Plugin (context-mode) in Sixteen Theme

The Sixteen theme follows the project‑wide **Context Compression** discipline.  This short guide explains why the plugin is required and how to keep it operational.

## Why the Theme Needs It
- The theme contains many Blade templates and asset manifests. Indexing them with **context‑mode** prevents large markdown outputs from flooding Claude’s prompt when we search for component usages or style guidelines.
- Token savings (≈98 %) speed up AI‑assisted design reviews and documentation generation.

## Installation
The plugin is installed globally and locally for the whole repository (see the AI module documentation).  No theme‑specific steps are required beyond ensuring the global install succeeded.

## Usage
- Run `ctx_batch_execute` for any command that returns >20 lines (e.g., `git diff`, `grep -R "header" resources/views`).
- Afterwards you can query the indexed output with `ctx_search`.

## Reference
- Full plugin documentation lives in the AI module wiki: `Modules/AI/docs/wiki/concepts/context-compression-plugin.md`.
