<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Modules\User\Models\User;

/**
 * Modello Appuntamento - Gestione prenotazioni servizi comunali
 * Conforme alle specifiche AGID per servizi di prenotazione
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $service_id
 * @property int|null $office_id
 * @property int|null $citizen_id
 * @property Carbon|null $appointment_date
 * @property Carbon|null $start_time
 * @property Carbon|null $end_time
 * @property string $status
 * @property string|null $purpose
 * @property string|null $notes
 * @property array<int, string>|null $required_documents
 * @property string|null $confirmation_code
 * @property bool $reminder_sent
 * @property string|null $cancellation_reason
 * @property array<string, mixed>|null $metadata
 * @property Carbon|null $cancelled_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @property-read User|null $user
 * @property-read Citizen|null $citizen
 * @property-read Office|null $office
 * @property-read Service|null $service
 */
class Appointment extends Model
{
    /** @use HasFactory<\Illuminate\Database\Eloquent\Factories\Factory<Appointment>> */
    use HasFactory, SoftDeletes;

    public const STATUS_PENDING = 'pending';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_NO_SHOW = 'no_show';

    public const SERVICE_ANAGRAFE = 'anagrafe';

    public const SERVICE_TRIBUTI = 'tributi';

    public const SERVICE_SUAP = 'suap';

    public const SERVICE_URP = 'urp';

    public const SERVICE_OTHER = 'other';

    protected $table = 'sixteen_appointments';

    /** @var list<string> */
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

    /** @var array<string, string> */
    protected $casts = [
        'appointment_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'required_documents' => 'array',
        'reminder_sent' => 'boolean',
        'metadata' => 'array',
        'cancelled_at' => 'datetime',
    ];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<Citizen, $this> */
    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }

    /** @return BelongsTo<Office, $this> */
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    /** @return BelongsTo<Service, $this> */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @param  Builder<Appointment>  $query
     * @return Builder<Appointment>
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('appointment_date', '>=', now()->toDateString())
            ->where('status', self::STATUS_CONFIRMED);
    }

    /**
     * @param  Builder<Appointment>  $query
     * @return Builder<Appointment>
     */
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * @param  Builder<Appointment>  $query
     * @return Builder<Appointment>
     */
    public function scopeForOffice(Builder $query, int $officeId): Builder
    {
        return $query->where('office_id', $officeId);
    }

    public function getIsCancellableAttribute(): bool
    {
        $appointmentDate = $this->appointment_date;

        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED], true)
            && $appointmentDate instanceof Carbon
            && $appointmentDate->greaterThan(now()->addHours(24));
    }

    public function getIsModifiableAttribute(): bool
    {
        $appointmentDate = $this->appointment_date;

        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED], true)
            && $appointmentDate instanceof Carbon
            && $appointmentDate->greaterThan(now()->addHours(48));
    }

    public static function generateConfirmationCode(): string
    {
        return strtoupper(substr(md5(uniqid('', true)), 0, 8));
    }

    public function needsReminder(): bool
    {
        $appointmentDate = $this->appointment_date;

        return ! $this->reminder_sent
            && $this->status === self::STATUS_CONFIRMED
            && $appointmentDate instanceof Carbon
            && $appointmentDate->isTomorrow()
            && now()->hour < 18;
    }

    /**
     * @return array<string, string>
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'In attesa',
            self::STATUS_CONFIRMED => 'Confermato',
            self::STATUS_COMPLETED => 'Completato',
            self::STATUS_CANCELLED => 'Cancellato',
            self::STATUS_NO_SHOW => 'Non presentato',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function getServiceTypes(): array
    {
        return [
            self::SERVICE_ANAGRAFE => 'Anagrafe',
            self::SERVICE_TRIBUTI => 'Tributi',
            self::SERVICE_SUAP => 'SUAP',
            self::SERVICE_URP => 'URP',
            self::SERVICE_OTHER => 'Altro',
        ];
    }

    public function sendConfirmationNotification(): void
    {
        // Notifica email/SMS orchestrata da modulo owner (future Action).
    }

    /** @return Attribute<string, never> */
    protected function timeSlot(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $start = $this->start_time;
                $end = $this->end_time;

                if (! $start instanceof Carbon || ! $end instanceof Carbon) {
                    return '';
                }

                return $start->format('H:i').' - '.$end->format('H:i');
            }
        );
    }

    /** @return Attribute<int, never> */
    protected function duration(): Attribute
    {
        return Attribute::make(
            get: function (): int {
                $start = $this->start_time;
                $end = $this->end_time;

                if (! $start instanceof Carbon || ! $end instanceof Carbon) {
                    return 0;
                }

                return (int) $start->diffInMinutes($end);
            }
        );
    }

    protected static function booted(): void
    {
        static::creating(function (Appointment $appointment): void {
            if ($appointment->confirmation_code === null || $appointment->confirmation_code === '') {
                $appointment->confirmation_code = self::generateConfirmationCode();
            }
        });

        static::updating(function (Appointment $appointment): void {
            if ($appointment->isDirty('status') && $appointment->status === self::STATUS_CANCELLED) {
                $appointment->cancelled_at = now();
            }
        });
    }
}
