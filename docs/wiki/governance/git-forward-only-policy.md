# Politica Git: Forward-Only (Sempre in Avanti)

## Applicazione nel Tema Sixteen

In conformità con la disciplina globale di progetto (vedi [Git Forward-Only Discipline](../../../../docs/wiki/concepts/git-forward-only-discipline.md)), il Tema Sixteen adotta un workflow di sviluppo strettamente lineare.

### Regole per lo Sviluppo del Tema

1. **Roll-Forward sui Fix CSS/JS**: Se una modifica agli stili o ai componenti Lit del tema introduce un bug visivo, non si esegue il revert del commit. Si crea un nuovo commit di fix che corregge l'errore, preservando la storia dei tentativi precedenti.
2. **Tracciabilità dei Componenti**: Ogni componente Web (come `<map-lit>`) integrato nelle pagine del tema deve essere documentato nelle wiki del rispettivo modulo, ma il tema deve mantenere un registro delle integrazioni nel proprio `docs/wiki/log.md`.
3. **Studio vs Ripristino**: Le versioni precedenti del tema possono essere studiate (tramite `git checkout` o visualizzazione diff) per capire regressioni di stile, ma lo sviluppo prosegue sempre dal commit più recente (`HEAD`).

---
*Ultimo aggiornamento: Aprile 2026*
