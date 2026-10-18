@php
/**
 * BMAD + Second Brain + EEC + Filament Blueprint
 * Google OAuth2 Login — Folio route: auth.google.index
 * Stack: Folio + Volt + Filament — NO web.php / api.php / controllers
 * URL: https://laravel.com/framework/docs/13.x/folio → Folio path → route name convention
 * 
 * Route name: auth.google.index (con Folio, la pagina index generate automaticamente)
 * Pagina: /it/auth/google
 * Redirect a Google Socialite via Laravel Socialite (stateless/redirect)
 */

use Modules\Xot\Datas\XotData;

return redirect()->away(
    \Laravel\Socialite\Facades\Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
);
@endphp

<div class="p-6 text-center">
    <p class="text-red-600">Google OAuth non configurato.</p>
    <p class="text-sm text-gray-500 mt-2">Aggiungi GOOGLE_CLIENT_ID e GOOGLE_CLIENT_SECRET in .env.</p>
</div>
