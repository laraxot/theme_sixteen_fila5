# Logo Residual Analysis

Torna a: [homepage-parity-report.md](../../homepage-parity-report.md)

Screenshot usati:
- [reference-header-issues.png](./reference-header-issues.png)
- [local-header-fixed.png](./local-header-fixed.png)

## Delta residuo

Dopo i fix su centratura, social e cerca, il residuo piu evidente nell'header e il logo istituzionale:
- riferimento: scudo del Comune bianco su verde
- locale: forma bianca non coerente con lo scudo del riferimento

## Ipotesi tecnica

Il markup locale usa ancora un `svg > image` con asset non allineato al logo del design-comuni. Il tema ha gia l'asset corretto copiato in:
- `/themes/Sixteen/design-comuni/assets/images/logo-comune.svg`

## Direzione fix

- nascondere il logo errato nel layer CSS attivo
- reintrodurre il logo corretto come background controllato dal CSS attivo del tema

Ritorno: [homepage-parity-report.md](../../homepage-parity-report.md)
