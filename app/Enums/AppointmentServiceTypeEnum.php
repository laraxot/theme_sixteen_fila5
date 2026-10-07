<?php

declare(strict_types=1);

namespace Themes\Sixteen\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Tipi di servizio comunale prenotabile.
 *
 * Sostituisce le costanti Appointment::SERVICE_*. Le label vivono in
 * lang/<locale>/appointment_service_type_enum.php (namespace `sixteen::`).
 */
enum AppointmentServiceTypeEnum: string implements HasLabel
{
    case ANAGRAFE = 'anagrafe';
    case TRIBUTI = 'tributi';
    case SUAP = 'suap';
    case URP = 'urp';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return trans('sixteen::appointment_service_type_enum.values.'.$this->value.'.label');
    }
}
