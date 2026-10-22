<?php

declare(strict_types=1);

/**
 * Alias FO: path specifico nel tema vince sul jolly `[container0]/[slug0]`
 * (che restituiva 404 senza CMS `profile.edit`). Canon impostazioni cittadino:
 * `container0.view` area-personale/impostazioni (mai path localizzati a mano).
 */

use Illuminate\Http\RedirectResponse;

use function Laravel\Folio\middleware;
use function Laravel\Folio\render;

middleware(['web', 'auth']);

render(function (): RedirectResponse {
    return redirect()->to(route('container0.view', [
        'container0' => 'area-personale',
        'slug0' => 'impostazioni',
    ]));
});
