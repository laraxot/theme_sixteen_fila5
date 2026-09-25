<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< HEAD
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Database\Eloquent\Builder;
use Themes\Sixteen\Actions\Url\BuildLocalizedFrontofficePathAction;

use Illuminate\Database\Eloquent\Casts\Attribute;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\Pivot;
=======
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
<<<<<<< HEAD
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
=======
<<<<<<< HEAD
 * @property array|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array|null $competences
 * @property array|null $services_provided
 * @property array|null $accessibility_info
 * @property array|null $metadata
=======
 * @property array<string, mixed>|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array<string, mixed>|null $competences
 * @property array<string, mixed>|null $services_provided
 * @property array<string, mixed>|null $accessibility_info
 * @property array<string, mixed>|null $metadata
>>>>>>> edd328a (.)
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
>>>>>>> laraxot/dev
 * @property-read self|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $children
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $allChildren
<<<<<<< HEAD
 * @property-read string $type_name
 * @property-read string $hierarchy_path
 * @property-read bool $has_children
 * @property-read int $level
 * @property-read string $url
 */
class OrganizationalUnit extends Model
{
    /** @use HasFactory<Factory<static>> */
    use HasFactory, SoftDeletes;

    /**
=======
 */
<<<<<<< HEAD
class OrganizationalUnit extends Model
{
    use HasFactory, SoftDeletes;

    /**
=======
class OrganizationalUnit extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
     * Relazione con l'unità parent
     *
     * @return BelongsTo<static, $this>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * Relazione con le unità figlie
     *
     * @return HasMany<static, $this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id')->ordered();
    }

    /**
     * Relazione con tutti i discendenti
     *
     * @return HasMany<static, $this>
     */
    public function descendants(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id')->with('descendants');
    }

    /**
     * Relazione con i punti di contatto
     *
     * @return MorphMany<ContactPoint, $this>
=======
<<<<<<< HEAD
     * Relazione con l'unità parent
=======
     * @return BelongsTo<self, $this>
>>>>>>> edd328a (.)
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
<<<<<<< HEAD
     * Relazione con le unità figlie
=======
     * @return HasMany<self, $this>
>>>>>>> edd328a (.)
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->ordered();
    }

    /**
<<<<<<< HEAD
     * Relazione con tutti i discendenti
=======
     * @return HasMany<self, $this>
>>>>>>> edd328a (.)
     */
    public function descendants(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->with('descendants');
    }

    /**
<<<<<<< HEAD
     * Relazione con i punti di contatto
=======
     * @return MorphMany<ContactPoint, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
<<<<<<< HEAD
     * Relazione con le persone pubbliche
     *
     * @return BelongsToMany<PublicPerson, $this, Pivot, 'pivot'>
=======
<<<<<<< HEAD
     * Relazione con le persone pubbliche
=======
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_person_unit')
            ->withPivot(['role', 'start_date', 'end_date', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Relazione con i responsabili attuali
<<<<<<< HEAD
     *
     * @return BelongsToMany<PublicPerson, $this, Pivot, 'pivot'>
=======
<<<<<<< HEAD
=======
     *
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function managers(): BelongsToMany
    {
        return $this->people()
            ->wherePivot('is_active', true)
            ->wherePivot('role', 'like', '%responsabile%')
            ->orWherePivot('role', 'like', '%dirigente%');
    }

    /**
<<<<<<< HEAD
     * Relazione con i servizi erogati
     *
     * @return HasMany<MunicipalService, $this>
=======
<<<<<<< HEAD
     * Relazione con i servizi erogati
=======
     * @return HasMany<MunicipalService, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function services(): HasMany
    {
        return $this->hasMany(MunicipalService::class, 'organizational_unit_id');
    }

    /**
<<<<<<< HEAD
     * Relazione con le location
     *
     * @return BelongsToMany<MunicipalLocation, $this, Pivot, 'pivot'>
=======
<<<<<<< HEAD
     * Relazione con le location
=======
     * @return BelongsToMany<MunicipalLocation, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalLocation::class, 'sixteen_unit_locations');
    }

    /**
<<<<<<< HEAD
     * Scope per unità attive
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeActive(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope per unità attive
     */
    public function scopeActive($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità attive
     */
    public function scopeActive(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('is_active', true);
    }

    /**
<<<<<<< HEAD
     * Scope per unità pubbliche
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopePublic(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope per unità pubbliche
     */
    public function scopePublic($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità pubbliche
     */
    public function scopePublic(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('is_public', true);
    }

    /**
<<<<<<< HEAD
     * Scope per tipo di unità
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeOfType(Builder $query, string $type): Builder
=======
<<<<<<< HEAD
     * Scope per tipo di unità
     */
    public function scopeOfType($query, string $type)
=======
     *
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per tipo di unità
     */
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('type', $type);
    }

    /**
<<<<<<< HEAD
     * Scope per unità radice (senza parent)
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeRoot(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope per unità radice (senza parent)
     */
    public function scopeRoot($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità radice (senza parent)
     */
    public function scopeRoot(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->whereNull('parent_id');
    }

    /**
<<<<<<< HEAD
     * Scope ordinato per posizione
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeOrdered(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope ordinato per posizione
     */
    public function scopeOrdered($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope ordinato per posizione
     */
    public function scopeOrdered(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->orderBy('position')->orderBy('name');
    }

    /**
     * Ottiene le competenze formattate
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function getFormattedCompetences(): array
    {
        if (! $this->competences || ! is_array($this->competences)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->competences)
=======
<<<<<<< HEAD
        return collect($this->competences)
=======
        $formatted = collect($this->competences)
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            ->map(function ($competence) {
                if (is_string($competence)) {
                    return ['title' => $competence];
                }

                return $competence;
            })
<<<<<<< HEAD
            ->toArray();
=======
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene i servizi forniti formattati
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function getFormattedServices(): array
    {
        if (! $this->services_provided || ! is_array($this->services_provided)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->services_provided)
=======
<<<<<<< HEAD
        return collect($this->services_provided)
=======
        $formatted = collect($this->services_provided)
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            ->map(function ($service) {
                if (is_string($service)) {
                    return ['name' => $service];
                }

                return $service;
            })
<<<<<<< HEAD
            ->toArray();
=======
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene gli orari di apertura formattati
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
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

<<<<<<< HEAD
        return collect($days)
=======
<<<<<<< HEAD
        return collect($days)
=======
        $formatted = collect($days)
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            ->mapWithKeys(function ($day) use ($dayNames) {
                $hours = $this->office_hours[$day] ?? null;

                return [$dayNames[$day] => $hours];
            })
            ->filter()
<<<<<<< HEAD
            ->toArray();
=======
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
            if (! is_array($period)) {
                continue;
            }

            if (isset($period['open'], $period['close'])) {
=======
<<<<<<< HEAD
=======
            if (! is_array($period)) {
                continue;
            }
>>>>>>> edd328a (.)
            if (isset($period['open']) && isset($period['close'])) {
>>>>>>> laraxot/dev
                if ($currentTime >= $period['open'] && $currentTime <= $period['close']) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Ottiene tutti gli antenati
<<<<<<< HEAD
     *
     * @return Collection<int, self>
     */
    public function getAncestors(): Collection
    {
        $ancestors = [];
        $current = $this->parent;

        while ($current) {
            array_unshift($ancestors, $current);
            $current = $current->parent;
        }

        return new Collection($ancestors);
=======
     */
<<<<<<< HEAD
    public function getAncestors(): Collection
    {
=======
    /** @return Collection<int, self> */
    public function getAncestors(): Collection
    {
        /** @var Collection<int, self> $ancestors */
>>>>>>> edd328a (.)
        $ancestors = collect();
        $current = $this->parent;

        while ($current) {
            $ancestors->prepend($current);
            $current = $current->parent;
        }

        return $ancestors;
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene tutti i discendenti (recursivo)
<<<<<<< HEAD
     *
     * @return Collection<int, self>
     */
    public function getAllDescendants(): Collection
    {
        $descendants = [];

        foreach ($this->children as $child) {
            $descendants[] = $child;
            $descendants = array_merge($descendants, $child->getAllDescendants()->all());
        }

        return new Collection($descendants);
=======
     */
<<<<<<< HEAD
    public function getAllDescendants(): Collection
    {
=======
    /** @return Collection<int, self> */
    public function getAllDescendants(): Collection
    {
        /** @var Collection<int, self> $descendants */
>>>>>>> edd328a (.)
        $descendants = collect();

        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getAllDescendants());
        }

        return $descendants;
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function typeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::TYPES[$this->type] ?? $this->type
        );
    }

    /**
     * Accessor per il percorso gerarchico
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
     *
     * @return Attribute<bool, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function hasChildren(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->children()->exists()
        );
    }

    /**
     * Accessor per il livello gerarchico
<<<<<<< HEAD
     *
     * @return Attribute<int, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<int, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function url(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => route('municipal.organizational-units.show', $this->slug)
=======
<<<<<<< HEAD
            get: fn () => route('municipal.organizational-units.show', $this->slug)
=======
            get: fn () => app(BuildLocalizedFrontofficePathAction::class)->execute('/amministrazione/organizzazione/'.$this->slug)
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        );
    }

    /**
     * Mutator per il nome (genera automaticamente lo slug)
<<<<<<< HEAD
     *
     * @return Attribute<string, string>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<mixed, mixed>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function name(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            set: function (string $value): string {
=======
            set: function ($value) {
<<<<<<< HEAD
=======
                $value = (string) $value;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
        static::creating(function (self $model): void {
            if (is_null($model->position)) {
                $maxPosition = static::where('parent_id', $model->parent_id)
                    ->where('type', $model->type)
                    ->max('position');
                $model->position = is_numeric($maxPosition) ? ((int) $maxPosition + 1) : 1;
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
            if (is_null($model->position)) {
                $model->position = static::where('parent_id', $model->parent_id)
                    ->where('type', $model->type)
                    ->max('position') + 1;
=======
        static::creating(function (OrganizationalUnit $model): void {
            if (is_null($model->position)) {
                $model->position = (int) (static::where('parent_id', $model->parent_id)
                    ->where('type', $model->type)->max('position') ?? 0) + 1;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            }
        });

        // Genera slug se mancante
<<<<<<< HEAD
        static::creating(function (self $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
=======
        static::creating(function (OrganizationalUnit $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug((string) $model->name);
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            }
        });

        // Assicura unicità dello slug
<<<<<<< HEAD
        static::creating(function (self $model): void {
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (OrganizationalUnit $model): void {
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });
    }
}
