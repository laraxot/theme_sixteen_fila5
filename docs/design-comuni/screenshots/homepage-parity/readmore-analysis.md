# Read More Analysis

Torna a: [homepage-parity-report.md](../../homepage-parity-report.md)

## Delta misurato

Riferimento vs locale sul primo `VAI ALLA PAGINA`:
- testo: verde nel riferimento, nero nel locale
- icona: `32x16` nel riferimento, `20x20` nel locale
- link height: `40px` nel riferimento, `46px` nel locale
- `gap`: assente nel riferimento, `8px` nel locale
- `padding-bottom`: `0` nel riferimento, `8px` nel locale

## Direzione fix

- forzare il colore verde su `.read-more .text`
- ridurre e riallineare verticalmente l'icona freccia
- rimuovere il padding-bottom extra e il gap che sposta la freccia

Ritorno: [homepage-parity-report.md](../../homepage-parity-report.md)


## Inspector usato

- [inspectors.md](../../../../../bashscripts/docs/homepage-visual-parity/inspectors.md)
- [inspect-readmore.mjs](../../../../../bashscripts/inspectors/homepage-visual-parity/inspect-readmore.mjs)

## Stato attuale dopo hotfix 4-5

Misura corrente del primo `VAI ALLA PAGINA`:
- riferimento: `172.5x40`, testo `116.5x21`, icona `32x16`
- locale: `159x40`, testo `103x21`, icona `32x16`
- colore, `14/21`, padding `16/0/0/16` e gap della freccia sono ora riallineati
- residuo principale: la resa tipografica del testo nel locale resta piu stretta del riferimento, quindi il CTA occupa ancora meno larghezza

## Tooling canonico

- [inspectors.md](../../../../../bashscripts/docs/homepage-visual-parity/inspectors.md)
- [inspect-readmore.mjs](../../../../../bashscripts/inspectors/homepage-visual-parity/inspect-readmore.mjs)
