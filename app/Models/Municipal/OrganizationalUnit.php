<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< .merge_file_M4TKSQ
=======
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
>>>>>>> .merge_file_13nviD
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Themes\Sixteen\Enums\OrganizationalUnitTypeEnum;

/**
 * Modello per le unità organizzative
 *
 * Rappresenta uffici, dipartimenti, settori e altre unità organizzative
 * dell'ente secondo l'ontologia AGID
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $short_description
 * @property string $type
 * @property int|null $parent_id
 * @property string|null $code
 * @property string|null $logo
 * @property string|null $image
 * @property string|null $website
 * @property string|null $email
 * @property string|null $pec
 * @property string|null $phone
 * @property string|null $address
<<<<<<< .merge_file_M4TKSQ
 * @property array|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array|null $competences
 * @property array|null $services_provided
 * @property array|null $accessibility_info
 * @property array|null $metadata
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
=======
 * @property array<array-key, mixed>|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array<array-key, mixed>|null $competences
 * @property array<array-key, mixed>|null $services_provided
 * @property array<array-key, mixed>|null $accessibility_info
 * @property array<array-key, mixed>|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
>>>>>>> .merge_file_13nviD
 * @property-read self|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $children
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $allChildren
 */
class OrganizationalUnit extends Model
{
    use HasFactory, SoftDeletes;

<<<<<<< .merge_file_M4TKSQ
    /**
     * Tipi di unità organizzative secondo AGID
     */
    public const TYPES = [
        'municipality' => 'Comune',
        'department' => 'Dipartimento',
        'sector' => 'Settore',
        'office' => 'Ufficio',
        'service' => 'Servizio',
        'area' => 'Area',
        'division' => 'Divisione',
        'unit' => 'Unità',
        'committee' => 'Commissione',
        'council' => 'Consiglio',
        'board' => 'Giunta',
        'authority' => 'Autorità',
        'agency' => 'Agenzia',
    ];

=======
>>>>>>> .merge_file_13nviD
    protected $table = 'sixteen_organizational_units';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'type',
        'parent_id',
        'code',
        'logo',
        'image',
        'website',
        'email',
        'pec',
        'phone',
        'address',
        'office_hours',
        'is_active',
        'is_public',
        'position',
        'competences',
        'services_provided',
        'accessibility_info',
        'metadata',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_public' => 'boolean',
        'position' => 'integer',
        'office_hours' => 'json',
        'competences' => 'json',
        'services_provided' => 'json',
        'accessibility_info' => 'json',
        'metadata' => 'json',
    ];

    /**
     * Relazione con l'unità parent
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return BelongsTo<static, $this>
>>>>>>> .merge_file_13nviD
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Relazione con le unità figlie
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return HasMany<static, $this>
>>>>>>> .merge_file_13nviD
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->ordered();
    }

    /**
     * Relazione con tutti i discendenti
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return HasMany<static, $this>
>>>>>>> .merge_file_13nviD
     */
    public function descendants(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->with('descendants');
    }

    /**
     * Relazione con i punti di contatto
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return MorphMany<ContactPoint, $this>
>>>>>>> .merge_file_13nviD
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
     * Relazione con le persone pubbliche
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return BelongsToMany<PublicPerson, $this, Pivot, 'pivot'>
>>>>>>> .merge_file_13nviD
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_person_unit')
            ->withPivot(['role', 'start_date', 'end_date', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Relazione con i responsabili attuali
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return BelongsToMany<PublicPerson, $this, Pivot, 'pivot'>
>>>>>>> .merge_file_13nviD
     */
    public function managers(): BelongsToMany
    {
        return $this->people()
            ->wherePivot('is_active', true)
            ->wherePivot('role', 'like', '%responsabile%')
            ->orWherePivot('role', 'like', '%dirigente%');
    }

    /**
     * Relazione con i servizi erogati
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return HasMany<MunicipalService, $this>
>>>>>>> .merge_file_13nviD
     */
    public function services(): HasMany
    {
        return $this->hasMany(MunicipalService::class, 'organizational_unit_id');
    }

    /**
     * Relazione con le location
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return BelongsToMany<MunicipalLocation, $this, Pivot, 'pivot'>
>>>>>>> .merge_file_13nviD
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalLocation::class, 'sixteen_unit_locations');
    }

    /**
     * Scope per unità attive
     */
<<<<<<< .merge_file_M4TKSQ
    public function scopeActive($query)
=======
    public function scopeActive(Builder $query): Builder
>>>>>>> .merge_file_13nviD
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope per unità pubbliche
     */
<<<<<<< .merge_file_M4TKSQ
    public function scopePublic($query)
=======
    public function scopePublic(Builder $query): Builder
>>>>>>> .merge_file_13nviD
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope per tipo di unità
     */
<<<<<<< .merge_file_M4TKSQ
    public function scopeOfType($query, string $type)
=======
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> .merge_file_13nviD
    {
        return $query->where('type', $type);
    }

    /**
     * Scope per unità radice (senza parent)
     */
<<<<<<< .merge_file_M4TKSQ
    public function scopeRoot($query)
=======
    public function scopeRoot(Builder $query): Builder
>>>>>>> .merge_file_13nviD
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope ordinato per posizione
     */
<<<<<<< .merge_file_M4TKSQ
    public function scopeOrdered($query)
=======
    public function scopeOrdered(Builder $query): Builder
>>>>>>> .merge_file_13nviD
    {
        return $query->orderBy('position')->orderBy('name');
    }

    /**
     * Ottiene le competenze formattate
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return array<array-key, mixed>
>>>>>>> .merge_file_13nviD
     */
    public function getFormattedCompetences(): array
    {
        if (! $this->competences || ! is_array($this->competences)) {
            return [];
        }

        return collect($this->competences)
            ->map(function ($competence) {
                if (is_string($competence)) {
                    return ['title' => $competence];
                }

                return $competence;
            })
            ->toArray();
    }

    /**
     * Ottiene i servizi forniti formattati
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return array<array-key, mixed>
>>>>>>> .merge_file_13nviD
     */
    public function getFormattedServices(): array
    {
        if (! $this->services_provided || ! is_array($this->services_provided)) {
            return [];
        }

        return collect($this->services_provided)
            ->map(function ($service) {
                if (is_string($service)) {
                    return ['name' => $service];
                }

                return $service;
            })
            ->toArray();
    }

    /**
     * Ottiene gli orari di apertura formattati
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return array<array-key, mixed>
>>>>>>> .merge_file_13nviD
     */
    public function getFormattedOfficeHours(): array
    {
        if (! $this->office_hours || ! is_array($this->office_hours)) {
            return [];
        }

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $dayNames = [
            'monday' => 'Lunedì',
            'tuesday' => 'Martedì',
            'wednesday' => 'Mercoledì',
            'thursday' => 'Giovedì',
            'friday' => 'Venerdì',
            'saturday' => 'Sabato',
            'sunday' => 'Domenica',
        ];

        return collect($days)
            ->mapWithKeys(function ($day) use ($dayNames) {
                $hours = $this->office_hours[$day] ?? null;

                return [$dayNames[$day] => $hours];
            })
            ->filter()
            ->toArray();
    }

    /**
     * Verifica se l'unità è aperta ora
     */
    public function isOpenNow(): bool
    {
        $now = now();
        $currentDay = strtolower($now->format('l'));
        $currentTime = $now->format('H:i');

        $todayHours = $this->office_hours[$currentDay] ?? null;

        if (! $todayHours || ! is_array($todayHours)) {
            return false;
        }

        foreach ($todayHours as $period) {
<<<<<<< .merge_file_M4TKSQ
            if (isset($period['open']) && isset($period['close'])) {
=======
            if (! is_array($period)) {
                continue;
            }

            if (isset($period['open'], $period['close'])) {
>>>>>>> .merge_file_13nviD
                if ($currentTime >= $period['open'] && $currentTime <= $period['close']) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Ottiene tutti gli antenati
     */
    public function getAncestors(): Collection
    {
<<<<<<< .merge_file_M4TKSQ
        $ancestors = collect();
=======
        $ancestors = [];
>>>>>>> .merge_file_13nviD
        $current = $this->parent;

        while ($current) {
            $ancestors->prepend($current);
            $current = $current->parent;
        }

        return $ancestors;
    }

    /**
     * Ottiene tutti i discendenti (recursivo)
     */
    public function getAllDescendants(): Collection
    {
<<<<<<< .merge_file_M4TKSQ
        $descendants = collect();
=======
        $descendants = [];
>>>>>>> .merge_file_13nviD

        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getAllDescendants());
        }

        return $descendants;
    }

    /**
     * Verifica se l'unità è antenata di un'altra
     */
    public function isAncestorOf(self $unit): bool
    {
        return $unit->getAncestors()->contains('id', $this->id);
    }

    /**
     * Verifica se l'unità è discendente di un'altra
     */
    public function isDescendantOf(self $unit): bool
    {
        return $this->getAncestors()->contains('id', $unit->id);
    }

    /**
     * Accessor per il nome del tipo
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_13nviD
     */
    protected function typeName(): Attribute
    {
        return Attribute::make(
            get: fn () => OrganizationalUnitTypeEnum::tryFrom($this->type)?->getLabel() ?? $this->type
        );
    }

    /**
     * Accessor per il percorso gerarchico
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_13nviD
     */
    protected function hierarchyPath(): Attribute
    {
        return Attribute::make(
            get: function () {
                $path = collect([$this->name]);
                $current = $this;

                while ($current->parent) {
                    $current = $current->parent;
                    $path->prepend($current->name);
                }

                return $path->implode(' › ');
            }
        );
    }

    /**
     * Accessor per verificare se ha figli
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return Attribute<bool, never>
>>>>>>> .merge_file_13nviD
     */
    protected function hasChildren(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->children()->exists()
        );
    }

    /**
     * Accessor per il livello gerarchico
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return Attribute<int, never>
>>>>>>> .merge_file_13nviD
     */
    protected function level(): Attribute
    {
        return Attribute::make(
            get: function () {
                $level = 0;
                $current = $this;

                while ($current->parent) {
                    $level++;
                    $current = $current->parent;
                }

                return $level;
            }
        );
    }

    /**
     * Accessor per l'URL dell'unità
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_13nviD
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('municipal.organizational-units.show', $this->slug)
        );
    }

    /**
     * Mutator per il nome (genera automaticamente lo slug)
<<<<<<< .merge_file_M4TKSQ
=======
     *
     * @return Attribute<string, string>
>>>>>>> .merge_file_13nviD
     */
    protected function name(): Attribute
    {
        return Attribute::make(
<<<<<<< .merge_file_M4TKSQ
            set: function ($value) {
=======
            set: function (string $value): string {
>>>>>>> .merge_file_13nviD
                $this->attributes['name'] = $value;
                if (empty($this->attributes['slug'])) {
                    $this->attributes['slug'] = Str::slug($value);
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

        // Auto-increment position nella stessa categoria
<<<<<<< .merge_file_M4TKSQ
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_13nviD
            if (is_null($model->position)) {
                $model->position = static::where('parent_id', $model->parent_id)
                    ->where('type', $model->type)
<<<<<<< .merge_file_M4TKSQ
                    ->max('position') + 1;
=======
                    ->max('position');
                $model->position = is_numeric($maxPosition) ? ((int) $maxPosition + 1) : 1;
>>>>>>> .merge_file_13nviD
            }
        });

        // Genera slug se mancante
<<<<<<< .merge_file_M4TKSQ
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_13nviD
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });

        // Assicura unicità dello slug
<<<<<<< .merge_file_M4TKSQ
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_13nviD
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });
    }
}
