---
title: "Sixteen — matrice copertura front office auth e responsive"
type: bmad-coverage-matrix
status: active
updated: 2026-11-12
---

# Scopo

Questa matrice impedisce che una pagina Folio del modulo User bypassi il guscio
Design Comuni del tema Sixteen. La logica resta nel modulo; la presentazione
appartiene al tema attivo.

## Route auth localizzate

| Route | Runtime | Presentazione Sixteen | Stato |
|---|---|---|---|
| `/{locale}/auth/login` | User | `pages/auth/login.blade.php` | coperta |
| `/{locale}/auth/register` | User | `pages/auth/register.blade.php` | coperta |
| `/{locale}/auth/verify` | User | `pages/auth/verify.blade.php` | coperta e testata |
| `/{locale}/auth/password/confirm` | User | `pages/auth/password/confirm.blade.php` | coperta |
| `/{locale}/auth/password/{token}` | User | `components/pages/auth/password-token.blade.php` via alias compatibile | coperta e testata |
| `/{locale}/auth/password/reset` | User | `components/pages/auth/password-reset.blade.php` via alias compatibile | coperta |
| `/{locale}/auth/logout` | User/Folio | `pages/auth/logout.blade.php` | azione/uscita |
| `/email/verify/{id}/{hash}` | User | endpoint firmato, non pagina notice | non visuale |

## Regola di verifica

Per ogni nuova pagina auth:

1. eseguire `php artisan folio:list --json` da `laravel`;
2. verificare il file view effettivamente risolto per `it`, `en`, `de`, `es`;
3. verificare `x-layouts.app`, `x-auth.shell`, `data-dc`, header, main e footer;
4. verificare 375px, 768px e 1440px con tastiera e focus visibile;
5. mantenere un test Pest di contratto per la route e il comportamento Livewire.

## Perché `/auth/verify` era sfuggita

L'inventario precedente proteggeva login, registrazione e test pages, ma non includeva
la notice di verifica perché la route era montata dal modulo User e non aveva un
file Sixteen omonimo. Il fallback usava `x-layouts.main`, quindi era funzionale ma
fuori dal guscio Design Comuni. L'override Sixteen ora conserva middleware, nome
Folio, throttle e resend action, ma usa il guscio condiviso del tema.

La stessa omissione avrebbe lasciato scoperti anche `password/confirm` e le pagine di
recupero se si fosse controllato solo l'albero CMS. Il contratto ora considera l'intero
cluster auth: ogni pagina deve passare da `x-layouts.app`, avere un frammento
`data-dc` e riusare `x-auth.shell`; la verifica Pest copre guest login/register/reset
e le pagine autenticate verify/confirm.

## Gap residui classificati

Le pagine CMS dinamiche devono usare il guscio `[container0]`/`[slug0]`; le pagine
private User (dashboard, area personale, profilo, notifiche) sono percorsi autenticati
da auditare con sessione reale. Le pagine legacy `learn`, `genesis/*` e `prova` sono
candidate da rimuovere o isolare, non da trattare come pagine di produzione finché
non hanno una route/caso d'uso documentato.
