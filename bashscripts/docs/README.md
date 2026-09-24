# HTML Body Comparison - Documentazione

## Panoramica

Tool agnostico per confrontare il contenuto del tag `<body>` di due file HTML, escludendo i tag `<script>`.

## Posizione Script

```
laravel/Themes/Sixteen/bashscripts/
└── html-comparison/
    └── compare_body.sh    # Script principale
```

## Utilizzo

```bash
# Confronto base
./compare_body.sh reference.html local.html

# Output dettagliato
./compare_body.sh reference.html local.html --verbose

# Mostra statistiche
./compare_body.sh reference.html local.html --stats
```

## Opzioni

| Opzione | Descrizione |
|---------|-------------|
| `-v, --verbose` | Output dettagliato con differenze |
| `-s, --stats` | Mostra statistiche confronto (righe, bytes, similarità %) |
| `-h, --help` | Mostra help |

## Funzionalità

1. **Estrazione Body**: Estrae solo il contenuto tra `<body>` e `</body>`
2. **Rimozione Script**: Esclude tutti i tag `<script>` (inline e con src)
3. **Normalizzazione**: Rimuove spazi multipli per confronto accurato
4. **Similarità**: Calcola percentuale similarità tra i due file

## Output

- **Exit 0**: Body identici
- **Exit 1**: Body diversi (con differenze)

## Esempio Output

```
=== CONFRONTO BODY HTML (script esclusi) ===
✓ I contenuti del body sono IDENTICI
```

oppure

```
=== CONFRONTO BODY HTML (script esclusi) ===
✗ I contenuti del body sono DIVERSI
Differenze rilevate: 45 linee
Usa --verbose per vedere le differenze dettagliate
```

## Integrazione Homepage

Usato per confrontare:
- **Reference**: `https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html`
- **Locale**: `http://127.0.0.1:8001/it/tests/homepage`

Vedi anche: [blocks/INDEX.md](../docs/prompts/homepage/blocks/INDEX.md)

## Ultimo Confronto (2026-04-08)

| Metrica | Reference | Locale |
|---------|-----------|--------|
| Bytes HTML body | 73,715 | 999,109 |
| ID Semantici presenti | 33 | 0 |
| Differenze linee | — | 1,329 |

**Blocchi identificati nella reference** (6 principali):
- Block 00: Header/Navigation (skiplink → slim → center → navbar)
- Block 01: Hero/Contenuti in Evidenza (`#head-section`)
- Block 02: Calendario Eventi + Organi di Governo (`#calendario`)
- Block 03: Argomenti in Evidenza
- Block 04: Ricerca + Link Utili (`#search-modal`)
- Block 05: Feedback Widget (`#rating`)
- Block 06: Footer (`#footer`)

**Problema critico**: La pagina locale NON ha nessun ID semantico sui blocchi.
**Prossimo passo**: Aggiungere ID semantici ai componenti Blade.