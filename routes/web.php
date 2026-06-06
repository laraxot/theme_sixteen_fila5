<?php

declare(strict_types=1);

Route::prefix('comune')->name('comune.')->group(function (): void {
    // Homepage
    Route::get('/', [ComuneController::class, 'homepage'])->name('homepage');

    // Servizi
    Route::get('/servizi', [ComuneController::class, 'servizi'])->name('servizi');
    Route::get('/anagrafe', [ComuneController::class, 'anagrafe'])->name('anagrafe');
    Route::get('/tributi', [ComuneController::class, 'tributi'])->name('tributi');
    Route::get('/urbanistica', [ComuneController::class, 'urbanistica'])->name('urbanistica');
    Route::get('/prenotazioni', [ComuneController::class, 'prenotazioni'])->name('prenotazioni');

    // Novità
    Route::get('/novita', [ComuneController::class, 'novita'])->name('novita');
    Route::get('/novita/{news}', [ComuneController::class, 'showNews'])->name('novita.show');

    // Contatti
    Route::get('/contatti', [ComuneController::class, 'contatti'])->name('contatti');
    Route::post('/contatti', [ComuneController::class, 'sendContact'])->name('contatti.send');

    // Documenti
    Route::get('/documenti', [ComuneController::class, 'documenti'])->name('documenti');

    // Eventi
    Route::get('/eventi', [ComuneController::class, 'eventi'])->name('eventi');
});
