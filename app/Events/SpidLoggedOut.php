<?php

declare(strict_types=1);

namespace Themes\Sixteen\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
<<<<<<< HEAD
use Modules\Xot\Contracts\UserContract;
=======
use Modules\User\Models\User;
>>>>>>> laraxot/dev

/**
 * Evento lanciato quando un utente effettua il logout da SPID
 *
 * Questo evento permette di reagire al logout SPID per cleanup,
 * logging, sincronizzazione con sistemi esterni, etc.
 */
class SpidLoggedOut
{
    use Dispatchable, SerializesModels;

<<<<<<< HEAD
    /**
     * @param  array<array-key, mixed>  $spidAttributes
     */
    public function __construct(
        public UserContract $user,
=======
<<<<<<< HEAD
=======
    /**
     * @param  array<string, mixed>  $spidAttributes
     */
>>>>>>> edd328a (.)
    public function __construct(
        public User $user,
>>>>>>> laraxot/dev
        public array $spidAttributes
    ) {}

    /**
     * Ottiene il provider SPID utilizzato
     */
    public function getProvider(): ?string
    {
        $value = $this->spidAttributes['provider'] ?? null;

        return is_string($value) ? $value : null;
    }

    /**
     * Ottiene il codice fiscale dall'autenticazione SPID
     */
    public function getFiscalCode(): ?string
    {
        $value = $this->spidAttributes['fiscal_code'] ?? null;

        return is_string($value) ? $value : null;
    }

    /**
     * Ottiene attributi specifici per logging sicuro
     */
<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
=======
<<<<<<< HEAD
=======
    /**
     * @return array<string, mixed>
     */
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    public function getLoggingData(): array
    {
        return [
            'user_id' => $this->user->id,
            'provider' => $this->getProvider(),
            'fiscal_code' => $this->getFiscalCode(),
            'logout_timestamp' => now()->toISOString(),
        ];
    }
}
