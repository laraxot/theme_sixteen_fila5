---
title: "Indice degli ADR — Sixteen"
type: index
theme: Sixteen
status: active
updated: 2026-11-27
---

# Indice degli ADR — Sixteen

| ADR | Stato | Perché | Conferma |
|---|---|---|---|
| [0001-data-attributes-named-by-role](0001-data-attributes-named-by-role.md) | accepted | Gli agganci `data-*` si chiamano col ruolo dell'elemento, mai col nome del tema: il markup resta confrontabile col riferimento Design Comuni. | Sì: `tests/Unit/DataAttributeParityContractTest.php` |
| [0002-design-comuni-html-parity](0002-design-comuni-html-parity.md) | accepted | L'HTML dentro `<body>` delle pagine front office è uguale al riferimento Design Comuni: conformità AgID leggibile dal markup. | Sì: test di parità HTML del tema |
| [0003-digital-identity-routes-off-by-default](0003-digital-identity-routes-off-by-default.md) | accepted | Le rotte SPID/CIE (`spid.*`, `cie.*`) si registrano solo con `SIXTEEN_SPID_ENABLED=true`: superficie d'attacco spenta di default. | Sì: `tests/Feature/Infrastructure/DigitalIdentityRoutesDisabledByDefaultTest.php` + group `SIXTEEN-SPID-INV-*` |
| [0004-theme-assets-via-public-symlink](0004-theme-assets-via-public-symlink.md) | accepted | Gli asset si servono dal symlink `public_html/themes/Sixteen`; le Action PHP restano solo come ripiego documentato. | Sì: `Modules/Xot/tests/Unit/ThemePublicSymlinkTest.php` + group `SIXTEEN-ASSET-INV-*` |

Formato e regole: [README](README.md). I contratti di comportamento citati dagli ADR stanno in [../contracts/](../contracts/README.md).
