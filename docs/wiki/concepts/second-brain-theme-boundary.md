# Second Brain Theme Boundary

## Source

- `../../../../docs/wiki/concepts/second-brain-llm-wiki-pattern.md`

## Theme meaning

Nel tema Sixteen il second brain deve accumulare soprattutto:

- regole di parity visuale
- ownership CSS / JS del tema
- confini con i moduli owner del comportamento
- regressioni reali tra frontoffice runtime e reference design

## What belongs in Sixteen wiki

- contratti visuali riusabili
- boundary theme vs module
- asset integration rules
- anti-pattern di styling per pagina o per fix spot

## Best practices

- documentare i confini di ownership, non solo i fix CSS
- recepire i contratti modulo quando hanno impatto visivo o d'integrazione
- tenere le pagine corte, backlinkate e orientate a decisioni riusabili

## Bad practices

- spostare nel tema logica di stato o persistenza applicativa
- usare il tema come contenitore di workaround runtime del modulo owner
- creare documenti theme-local che contraddicono il root wiki o il modulo owner

## False friends

- "se si vede male il tema puo' correggere tutto": falso, non se il bug e' nel contratto state/runtime
- "boundary docs sono opzionali": falso, evitano fix duplicati e ownership sbagliate
- "la parity visiva basta senza log operativi": falso, senza log si perde il perche' delle regole
