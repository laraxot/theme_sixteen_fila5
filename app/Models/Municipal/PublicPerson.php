<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Modello per le persone pubbliche (Public Person)
 *
 * Rappresenta amministratori, dirigenti, dipendenti e altre figure
 * pubbliche dell'ente secondo l'ontologia AGID
*
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $slug
 * @property string|null $title
 * @property string|null $bio
 * @property string|null $qualification
 * @property string|null $role
 * @property string $category
 * @property Carbon|null $birth_date
 * @property string|null $birth_place
 * @property string|null $fiscal_code
 * @property string|null $email
 * @property string|null $pec
 * @property string|null $phone
 * @property string|null $mobile
 * @property string|null $photo
 * @property string|null $curriculum_vitae
 * @property string|null $cv_file_path
 * @property float|null $compensation
 * @property float|null $travel_expenses
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property bool $is_active
 * @property bool $is_public
 * @property Carbon|null $publication_date
 * @property array|null $privacy_settings
 * @property array|null $social_profiles
 * @property array|null $education
 * @property array|null $work_experience
 * @property array|null $skills
 * @property array|null $languages
 * @property array|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, ContactPoint> $contacts
 * @property-read Collection<int, MunicipalEvent> $eventsAsSpeaker
 * @property-read Collection<int, MunicipalEvent> $eventsAsParticipant
 */
class PublicPerson extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Categorie di persone pubbliche secondo AGID
     */
    public const CATEGORIES = [
        'politician' => 'Politico/Amministratore',
        'manager' => 'Dirigente',
        'employee' => 'Dipendente',
        'consultant' => 'Consulente/Collaboratore',
        'commission_member' => 'Componente Commissione',
        'board_member' => 'Componente Organo',
        'authority_member' => 'Componente Autorità',
        'other' => 'Altro',
    ];

    /**
     * Ruoli principali secondo AGID
     */
    public const ROLES = [
        'mayor' => 'Sindaco',
        'deputy_mayor' => 'Vicesindaco',
        'councillor' => 'Assessore',
        'president' => 'Presidente',
        'vice_president' => 'Vicepresidente',
        'secretary' => 'Segretario',
        'general_manager' => 'Direttore Generale',
        'manager' => 'Dirigente',
        'supervisor' => 'Responsabile',
        'employee' => 'Dipendente',
        'consultant' => 'Consulente',
        'collaborator' => 'Collaboratore',
    ];

    protected $table = 'sixteen_public_people';

    protected $fillable = [
        'first_name',
        'last_name',
        'slug',
        'title',
        'bio',
        'qualification',
        'role',
        'category',
        'birth_date',
        'birth_place',
        'fiscal_code',
        'email',
        'pec',
        'phone',
        'mobile',
        'photo',
        'curriculum_vitae',
        'cv_file_path',
        'compensation',
        'travel_expenses',
        'start_date',
        'end_date',
        'is_active',
        'is_public',
        'publication_date',
        'privacy_settings',
        'social_profiles',
        'education',
        'work_experience',
        'skills',
        'languages',
        'metadata',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'publication_date' => 'datetime',
        'is_active' => 'boolean',
        'is_public' => 'boolean',
        'compensation' => 'decimal:2',
        'travel_expenses' => 'decimal:2',
        'privacy_settings' => 'json',
        'social_profiles' => 'json',
        'education' => 'json',
        'work_experience' => 'json',
        'skills' => 'json',
        'languages' => 'json',
        'metadata' => 'json',
    ];

    /**
->where(function ($q): void {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>', now());
            });
    }

    /**
     * Scope ordinati per cognome e nome
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('last_name')->orderBy('first_name');
    }

    /**
* Accessor per il nome completo
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim($this->first_name.' '.$this->last_name)
        );
    }

    /**
     * Accessor per il nome invertito (Cognome, Nome)
     */
    protected function displayName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim($this->last_name.', '.$this->first_name)
        );
    }

    /**
     * Accessor per il nome della categoria
     */
    protected function categoryName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::CATEGORIES[$this->category] ?? $this->category
        );
    }

    /**
     * Accessor per il nome del ruolo
     */
    protected function roleName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::ROLES[$this->role] ?? $this->role
        );
    }

    /**
     * Accessor per l'età
     */
    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->birth_date?->age
        );
    }

    /**
     * Accessor per verificare se è in carica
     */
    protected function isInOffice(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->start_date || $this->start_date->isFuture()) {
                    return false;
                }

                return ! $this->end_date || $this->end_date->isFuture();
            }
        );
    }

    /**
     * Accessor per i giorni rimanenti in carica
     */
    protected function daysInOffice(): Attribute
    {
        return Attribute::make(
            get: function (): void {
                if (! $this->is_in_office) {
                    return;
                }

                return $this->end_date?->diffInDays(now()) ?? null;
            }
        );
    }

    /**
     * Accessor per l'URL della persona
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('municipal.public-people.show', $this->slug)
        );
    }

    /**
     * Mutator per nome (genera automaticamente lo slug)
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $this->attributes['last_name'] = $value;
                if (empty($this->attributes['slug']) && ! empty($this->attributes['first_name'])) {
                    $this->attributes['slug'] = Str::slug($this->attributes['first_name'].' '.$value);
                }

                return $value;
            }
        );
    }

    /**
     * Boot del modello
     */
    protected static function boot(): void
    {
        parent::boot();

        // Genera slug se mancante
static::creating(function ($model): void {
            if (empty($model->slug) && ! empty($model->first_name) && ! empty($model->last_name)) {
                $model->slug = Str::slug($model->first_name.' '.$model->last_name);
            }
        });

        // Assicura unicità dello slug
static::creating(function ($model): void {
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });

        // Set default privacy settings
static::creating(function ($model): void {
            if (empty($model->privacy_settings)) {
                $model->privacy_settings = [
                    'show_birth_info' => true,
                    'show_education' => true,
                    'show_experience' => true,
                    'show_social_profiles' => false,
                    'show_contact_info' => true,
                ];
            }
        });
    }
}
