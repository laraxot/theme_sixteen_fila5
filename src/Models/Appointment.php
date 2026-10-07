<?php

namespace Themes\Sixteen\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Themes\Sixteen\Enums\AppointmentServiceTypeEnum;
use Themes\Sixteen\Enums\AppointmentStatusEnum;

/**
 * Modello Appuntamento - Gestione prenotazioni servizi comunali
 * Conforme alle specifiche AGID per servizi di prenotazione
 */
class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sixteen_appointments';

    protected $fillable = [
        'user_id',
        'service_id',
        'office_id',
        'citizen_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'purpose',
        'notes',
        'required_documents',
        'confirmation_code',
        'reminder_sent',
        'cancellation_reason',
        'metadata',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => AppointmentStatusEnum::class,
        'required_documents' => 'array',
        'reminder_sent' => 'boolean',
        'metadata' => 'array',
    ];

    /**
     * Relazione con l'utente che ha prenotato
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relazione con il cittadino (se diverso dall'utente)
     */
    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }

    /**
     * Relazione con l'ufficio
     */
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Relazione con il servizio
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope per appuntamenti futuri
     */
    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>=', now()->toDateString())
            ->where('status', AppointmentStatusEnum::CONFIRMED->value);
    }

    /**
     * Scope per appuntamenti di un utente
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope per appuntamenti di un ufficio
     */
    public function scopeForOffice($query, $officeId)
    {
        return $query->where('office_id', $officeId);
    }

    /**
     * Verifica se l'appuntamento è cancellabile
     */
    public function getIsCancellableAttribute(): bool
    {
        return ($this->status?->isOpen() ?? false)
            && $this->appointment_date > now()->addHours(24); // Cancellabile fino a 24h prima
    }

    /**
     * Verifica se l'appuntamento è modificabile
     */
    public function getIsModifiableAttribute(): bool
    {
        return ($this->status?->isOpen() ?? false)
            && $this->appointment_date > now()->addHours(48); // Modificabile fino a 48h prima
    }

    /**
     * Genera codice di conferma univoco
     */
    public static function generateConfirmationCode(): string
    {
        return strtoupper(substr(md5(uniqid()), 0, 8));
    }

    /**
     * Formatta l'orario per display
     */
    protected function timeSlot(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->start_time->format('H:i').' - '.$this->end_time->format('H:i')
        );
    }

    /**
     * Durata appuntamento in minuti
     */
    protected function duration(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->start_time->diffInMinutes($this->end_time)
        );
    }

    /**
     * Verifica se è necessario inviare promemoria
     */
    public function needsReminder(): bool
    {
        return ! $this->reminder_sent
            && $this->status === AppointmentStatusEnum::CONFIRMED
            && $this->appointment_date->isTomorrow()
            && now()->hour < 18; // Invio solo prima delle 18
    }

    /**
     * Eventi del modello
     */
    protected static function booted()
    {
        static::creating(function ($appointment) {
            if (empty($appointment->confirmation_code)) {
                $appointment->confirmation_code = self::generateConfirmationCode();
            }
        });

        static::updating(function ($appointment) {
            if ($appointment->isDirty('status') && $appointment->status === AppointmentStatusEnum::CANCELLED) {
                $appointment->cancelled_at = now();
            }
        });
    }

    /**
     * Stati validi come [valore => label tradotta].
     *
     * @return array<string, string>
     */
    public static function getStatuses(): array
    {
        $statuses = [];
        foreach (AppointmentStatusEnum::cases() as $status) {
            $statuses[$status->value] = $status->getLabel();
        }

        return $statuses;
    }

    /**
     * Tipi di servizio come [valore => label tradotta].
     *
     * @return array<string, string>
     */
    public static function getServiceTypes(): array
    {
        $types = [];
        foreach (AppointmentServiceTypeEnum::cases() as $type) {
            $types[$type->value] = $type->getLabel();
        }

        return $types;
    }
}
