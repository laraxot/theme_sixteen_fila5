{{--
/**
 * Status Badge Component
 * 
 * Displays ticket status with appropriate styling
 * Works with Modules\Fixcity\Enums\TicketStatusEnum
 * 
 * @param TicketStatusEnum $status The ticket status enum instance
 */
--}}

@props([
    'status'
])

@php
    use Modules\Fixcity\Enums\TicketStatusEnum;
    
    // Ensure status is an enum instance
    if (is_string($status)) {
        $status = TicketStatusEnum::from($status);
    }
    
    // Get color and label from enum (values.{value}.color / .label in lang files)
    $color = $status->getColor();
    $label = $status->getLabel();

    // Map enum color keys to Bootstrap Italia badge variants
    $variant = match($color) {
        'success' => 'success',
        'danger' => 'danger',
        'warning', 'orange' => 'warning',
        'info' => 'info',
        default => 'secondary',
    };
@endphp

<x-pub_theme::badge :variant="$variant" {{ $attributes }}>
    {{ $label }}
</x-pub_theme::badge>

