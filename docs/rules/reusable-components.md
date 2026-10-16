# Regola: Componenti Riutilizzabili

## Principio (Ponytail — minimo necessario)
Ogni componente `components/blocks/` deve essere un pezzo riutilizzabile. Non deve avere logica specifica a una pagina singola.

## Regole
1. Usa `@props` per parametri esterni.
2. Non hard-codare URL o slug specifici.
3. Usa `ThemeComposer` per dati, Blade solo per presentazione.
4. Aggiorna `docs/stories/` per ogni componente nuovo o modificato.

## Riferimento BMAD
- Story: STORY-BLOG003-reusable-components.md
- Second Brain: docs/wiki/concepts/design-comuni-reusable-components.md
