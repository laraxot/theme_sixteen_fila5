# Header Sixteen: componenti Design Comuni

## Scopo

Il renderer pubblico del CMS resta `components/sections/header/v1.blade.php`. Il
renderer prepara i dati (CMS, tenant, autenticazione, URL interne e stato della
voce attiva), poi compone tre partial riusabili che corrispondono alle bande
Bootstrap Italia / Design Comuni:

- `partials/slim.blade.php`: regione, selettore lingua e area personale;
- `partials/center.blade.php`: logo/brand, social e ricerca;
- `partials/navbar.blade.php`: menu desktop, menu mobile e navigazione secondaria.

La scomposizione è strutturale: non cambia l'ordine `slim > center > navbar`,
gli hook CSS, gli identificatori `#header-nav-wrapper` / `#nav4`, né gli hook JS
`data-bs-toggle="dropdown"` e `data-bs-toggle="navbarcollapsible"`.

## Contratti runtime

`v1.blade.php` è l'unico punto che interpreta il payload CMS della sezione
`header`. I partial non leggono direttamente il JSON e non introducono fallback
testuali: ricevono dati già risolti e possono quindi essere riutilizzati da un
altro skin del tema senza duplicare la logica di autenticazione o localizzazione.

La fascia slim continua a usare `language-switcher`, `user-dropdown` e
`personal-area-login-cta`. Quest'ultimo mantiene la rotta di login locale; il
componente Google del login (`components/utilities/google-button.blade.php`) non
è coinvolto da questa estrazione.

Il menu mobile conserva il contratto condiviso con
`resources/js/theme/header-mobile-nav.js`: toggle, pannello, overlay, chiusura,
focus keyboard e `aria-expanded` restano invariati.

## Verifica

I contratti PHP owner sono in `tests/Unit/HeaderV1SlimDropdownContractTest.php`
e i test runtime della fascia slim in
`tests/Feature/Components/HeaderSlimBarContractTest.php`. Per una verifica
locale:

```bash
cd laravel
vendor/bin/pest Themes/Sixteen/tests/Unit/HeaderV1SlimDropdownContractTest.php
vendor/bin/pest Themes/Sixteen/tests/Feature/Components/HeaderSlimBarContractTest.php
```
