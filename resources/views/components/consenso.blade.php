{{--
    Entry point piatto del blocco `consenso`.

    Convezione del tema: `components/blocks/<nome>/<variante>.blade.php` sono le
    varianti montate dal CMS, e `components/<nome>.blade.php` e' l'ingresso che
    risolve `<x-pub_theme::consenso>`.

    Serve perche' Blade, risolvendo un componente anonimo, cerca
    `components/<nome>.blade.php` oppure `components/<nome>/index.blade.php`. Con la
    sola cartella di varianti non trova nulla e la pagina va in 500 con
    "Unable to locate a class or view for component [pub_theme::blocks.consenso]".
--}}
@include('pub_theme::components.blocks.consenso.default')
