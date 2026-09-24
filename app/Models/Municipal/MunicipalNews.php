<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

use function Safe\parse_url;

use Illuminate\Database\Eloquent\Builder;
use Themes\Sixteen\Support\FrontofficeUrl;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Modello per le notizie comunali (Municipal News)
 *
 * Rappresenta notizie, comunicati stampa, avvisi pubblici
 * e altre comunicazioni dell'ente secondo l'ontologia AGID
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $subtitle
 * @property string|null $content
 * @property string|null $excerpt
 * @property string $news_type
 * @property string|null $category
 * @property string|null $subcategory
 * @property int|null $organizational_unit_id
 * @property int|null $author_id
 * @property int|null $editor_id
 * @property string|null $source
 * @property string $news_status
 * @property string $visibility
 * @property int $priority_level
 * @property int $urgency_level
 * @property array<string, mixed>|null $target_audience
 * @property array<string, mixed>|null $geographic_scope
 * @property string|null $language
 * @property string|null $featured_image
 * @property string|null $image_caption
 * @property string|null $image_alt_text
 * @property array<string, mixed>|null $gallery
 * @property array<string, mixed>|null $attachments
 * @property array<string, mixed>|null $related_services
 * @property array<string, mixed>|null $related_events
 * @property array<string, mixed>|null $related_people
 * @property array<string, mixed>|null $related_documents
 * @property array<string, mixed>|null $external_links
 * @property array<string, mixed>|null $tags
 * @property string|null $social_summary
 * @property string|null $meta_description
 * @property array<string, mixed>|null $seo_keywords
 * @property \Carbon\Carbon|null $publication_date
 * @property \Carbon\Carbon|null $expiry_date
 * @property \Carbon\Carbon|null $last_modified
 * @property int $revision_number
 * @property bool $is_published
 * @property bool $is_featured
 * @property bool $is_breaking
 * @property bool $is_archived
 * @property bool $show_on_homepage
 * @property bool $allow_comments
 * @property int $view_count
 * @property int $share_count
 * @property int $reading_time
 * @property array<string, mixed>|null $accessibility_notes
 * @property string|null $feedback_url
 * @property string|null $correction_notice
 * @property array<string, mixed>|null $translation_links
 * @property array<string, mixed>|null $structured_data
 * @property array<string, mixed>|null $metadata
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read PublicPerson|null $author
 * @property-read PublicPerson|null $editor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $categories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $tags
 */
class MunicipalNews extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Tipologie di notizia secondo AGID
     */
    public const NEWS_TYPES = [
        'news' => 'Notizia',
        'press_release' => 'Comunicato Stampa',
        'public_notice' => 'Avviso Pubblico',
        'announcement' => 'Annuncio',
        'alert' => 'Allerta',
        'service_update' => 'Aggiornamento Servizi',
        'regulation_update' => 'Aggiornamento Normativo',
        'event_announcement' => 'Annuncio Eventi',
        'tender_notice' => 'Bando/Gara',
        'job_posting' => 'Offerta Lavoro',
        'council_update' => 'Aggiornamento Consiglio',
        'mayor_message' => 'Messaggio del Sindaco',
        'citizen_info' => 'Informazione ai Cittadini',
        'emergency' => 'Emergenza',
        'other' => 'Altro',
    ];

    /**
     * Stati della notizia
     */
    public const NEWS_STATUSES = [
        'draft' => 'Bozza',
        'review' => 'In Revisione',
        'approved' => 'Approvata',
        'published' => 'Pubblicata',
        'archived' => 'Archiviata',
        'expired' => 'Scaduta',
        'retracted' => 'Ritirata',
    ];

    /**
     * Livelli di priorità
     */
    public const PRIORITY_LEVELS = [
        1 => 'Bassa',
        2 => 'Normale',
        3 => 'Alta',
        4 => 'Urgente',
        5 => 'Critica',
    ];

    /**
     * Livelli di urgenza
     */
    public const URGENCY_LEVELS = [
        1 => 'Non Urgente',
        2 => 'Normale',
        3 => 'Urgente',
        4 => 'Molto Urgente',
        5 => 'Emergenza',
    ];

    /**
     * Ambiti geografici
     */
    public const GEOGRAPHIC_SCOPES = [
        'municipal' => 'Comunale',
        'district' => 'Quartiere/Circoscrizione',
        'regional' => 'Regionale',
        'national' => 'Nazionale',
        'european' => 'Europeo',
        'international' => 'Internazionale',
    ];

    protected $table = 'sixteen_municipal_news';

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content',
        'excerpt',
        'news_type',
        'category',
        'subcategory',
        'organizational_unit_id',
        'author_id',
        'editor_id',
        'source',
        'news_status',
        'visibility',
        'priority_level',
        'urgency_level',
        'target_audience',
        'geographic_scope',
        'language',
        'featured_image',
        'image_caption',
        'image_alt_text',
        'gallery',
        'attachments',
        'related_services',
        'related_events',
        'related_people',
        'related_documents',
        'external_links',
        'tags',
        'social_summary',
        'meta_description',
        'seo_keywords',
        'publication_date',
        'expiry_date',
        'last_modified',
        'revision_number',
        'is_published',
        'is_featured',
        'is_breaking',
        'is_archived',
        'show_on_homepage',
        'allow_comments',
        'view_count',
        'share_count',
        'reading_time',
        'accessibility_notes',
        'feedback_url',
        'correction_notice',
        'translation_links',
        'structured_data',
        'metadata',
    ];

    protected $casts = [
        'publication_date' => 'datetime',
        'expiry_date' => 'datetime',
        'last_modified' => 'datetime',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
        'is_archived' => 'boolean',
        'show_on_homepage' => 'boolean',
        'allow_comments' => 'boolean',
        'priority_level' => 'integer',
        'urgency_level' => 'integer',
        'view_count' => 'integer',
        'share_count' => 'integer',
        'reading_time' => 'integer',
        'revision_number' => 'integer',
        'target_audience' => 'json',
        'geographic_scope' => 'json',
        'gallery' => 'json',
        'attachments' => 'json',
        'related_services' => 'json',
        'related_events' => 'json',
        'related_people' => 'json',
        'related_documents' => 'json',
        'external_links' => 'json',
        'tags' => 'json',
        'seo_keywords' => 'json',
        'accessibility_notes' => 'json',
        'translation_links' => 'json',
        'structured_data' => 'json',
        'metadata' => 'json',
    ];

    /**
     * @return BelongsTo<OrganizationalUnit, $this>
     */
    public function organizationalUnit(): BelongsTo
    {
        return $this->belongsTo(OrganizationalUnit::class);
    }

    /**
     * @return BelongsTo<PublicPerson, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(PublicPerson::class, 'author_id');
    }

    /**
     * @return BelongsTo<PublicPerson, $this>
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(PublicPerson::class, 'editor_id');
    }

    /**
     * @return MorphMany<ContactPoint, $this>
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
     * @return BelongsToMany<MunicipalService, $this>
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalService::class, 'sixteen_news_services');
    }

    /**
     * @return BelongsToMany<MunicipalEvent, $this>
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalEvent::class, 'sixteen_news_events');
    }

    /**
     * @return BelongsToMany<PublicPerson, $this>
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_news_people');
    }

    /**
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie pubblicate
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('news_status', 'published')
            ->where('publication_date', '<=', now())
            ->where(function ($q): void {
                $q->whereNull('expiry_date')
                    ->orWhere('expiry_date', '>', now());
            });
    }

    /**
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie in evidenza
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie breaking
     */
    public function scopeBreaking(Builder $query): Builder
    {
        return $query->where('is_breaking', true);
    }

    /**
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie da homepage
     */
    public function scopeHomepage(Builder $query): Builder
    {
        return $query->where('show_on_homepage', true);
    }

    /**
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per tipologia di notizia
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('news_type', $type);
    }

    /**
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per categoria
     */
    public function scopeInCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per priorità minima
     */
    public function scopeMinPriority(Builder $query, int $priority): Builder
    {
        return $query->where('priority_level', '>=', $priority);
    }

    /**
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie recenti
     */
    public function scopeRecent(Builder $query, int $days = 30): Builder
    {
        return $query->where('publication_date', '>=', now()->subDays($days));
    }

    /**
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope ordinati per pubblicazione
     */
    public function scopeOrdered(Builder $query, string $direction = 'desc'): Builder
    {
        $dir = in_array($direction, ['asc', 'desc'], true) ? $direction : 'desc';

        return $query->orderBy('publication_date', $dir)
            ->orderBy('priority_level', 'desc');
    }

    /**
     * Ottiene l'excerpt con fallback al contenuto
     */
    public function getExcerptFormatted(int $length = 200): string
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }

        return Str::limit(strip_tags((string) ($this->content ?? '')), $length);
    }

    /**
     * Ottiene i tag formattati
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedTags(): array
    {
        if (! is_array($this->tags) || $this->tags === []) {
            return [];
        }

        $formatted = [];
        foreach ($this->tags as $tag) {
            if (is_string($tag)) {
                $formatted[] = ['name' => $tag, 'slug' => Str::slug($tag)];
                continue;
            }

            if (is_array($tag)) {
                $formatted[] = $tag;
            }
        }

        return $formatted;
    }

    /**
     * Ottiene i link esterni formattati
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedExternalLinks(): array
    {
        if (! $this->external_links || ! is_array($this->external_links)) {
            return [];
        }

        $formatted = collect($this->external_links)
            ->map(function ($link) {
                if (is_string($link)) {
                    return ['url' => $link, 'title' => parse_url($link, PHP_URL_HOST)];
                }

                return $link;
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
    }

    /**
     * Ottiene gli allegati formattati
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedAttachments(): array
    {
        if (! $this->attachments || ! is_array($this->attachments)) {
            return [];
        }

        $formatted = collect($this->attachments)
            ->map(function ($attachment) {
                if (is_string($attachment)) {
                    return [
                        'path' => $attachment,
                        'name' => basename($attachment),
                        'url' => asset('storage/'.$attachment),
                        'size' => null,
                        'type' => pathinfo($attachment, PATHINFO_EXTENSION),
                    ];
                }

                return is_array($attachment)
                    ? array_merge([
                        'url' => isset($attachment['path']) && is_string($attachment['path'])
                            ? asset('storage/'.$attachment['path'])
                            : null,
                    ], $attachment)
                    : [];
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
    }

    /**
     * Ottiene la galleria immagini formattata
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedGallery(): array
    {
        if (! $this->gallery || ! is_array($this->gallery)) {
            return [];
        }

        $formatted = collect($this->gallery)
            ->map(function ($image) {
                if (is_string($image)) {
                    return [
                        'path' => $image,
                        'url' => asset('storage/'.$image),
                        'caption' => null,
                        'alt' => null,
                    ];
                }

                return is_array($image)
                    ? array_merge([
                        'url' => isset($image['path']) && is_string($image['path'])
                            ? asset('storage/'.$image['path'])
                            : null,
                    ], $image)
                    : [];
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
    }

    /**
     * Incrementa il contatore di visualizzazioni
     */
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    /**
     * Incrementa il contatore di condivisioni
     */
    public function incrementShareCount(): void
    {
        $this->increment('share_count');
    }

    /**
     * Verifica se può essere pubblicata
     */
    public function canBePublished(): bool
    {
        return in_array($this->news_status, ['approved']) &&
               $this->publication_date <= now();
    }

    /**
     * Verifica se deve essere archiviata
     */
    public function shouldBeArchived(): bool
    {
        return $this->is_expired ||
               ($this->expiry_date && $this->expiry_date->isPast());
    }

    /**
     * Ottiene i dati strutturati per SEO
     *
     * @return array<string, mixed>
     */
    public function getStructuredData(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $this->title,
            'description' => $this->getExcerptFormatted(),
            'image' => $this->featured_image_url,
            'datePublished' => $this->publication_date?->toISOString(),
            'dateModified' => $this->last_modified?->toISOString(),
            'author' => [
                '@type' => 'Person',
                'name' => $this->author?->full_name,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $this->organizationalUnit->name ?? 'Comune',
            ],
            'mainEntityOfPage' => $this->url,
            'articleSection' => $this->category,
            'keywords' => is_array($this->seo_keywords)
                ? implode(', ', array_map(static fn (mixed $keyword): string => (string) $keyword, $this->seo_keywords))
                : null,
            'wordCount' => str_word_count(strip_tags((string) ($this->content ?? ''))),
            'timeRequired' => 'PT'.$this->estimated_reading_time.'M',
        ];
    }

    /**
     * Ottiene le informazioni complete della notizia
     *
     * @return array<string, mixed>
     */
    public function getNewsDetails(): array
    {
        return [
            'basic_info' => [
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'type' => $this->news_type_name,
                'category' => $this->category,
                'status' => $this->news_status_name,
                'priority' => $this->priority_name,
                'urgency' => $this->urgency_name,
            ],
            'content' => [
                'excerpt' => $this->getExcerptFormatted(),
                'content' => $this->content,
                'reading_time' => $this->estimated_reading_time,
                'featured_image' => $this->featured_image_url,
                'gallery' => $this->getFormattedGallery(),
                'attachments' => $this->getFormattedAttachments(),
            ],
            'publication' => [
                'publication_date' => $this->publication_date,
                'expiry_date' => $this->expiry_date,
                'last_modified' => $this->last_modified,
                'is_current' => $this->is_current,
                'is_fresh' => $this->is_fresh,
                'age_in_days' => $this->age_in_days,
            ],
            'metadata' => [
                'author' => $this->author?->full_name,
                'source' => $this->source,
                'tags' => $this->getFormattedTags(),
                'external_links' => $this->getFormattedExternalLinks(),
                'view_count' => $this->view_count,
                'share_count' => $this->share_count,
            ],
        ];
    }

    /**
     * Accessor per il nome del tipo di notizia
     *
     * @return Attribute<string, never>
     */
    protected function newsTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::NEWS_TYPES[$this->news_type] ?? $this->news_type
        );
    }

    /**
     * Accessor per il nome dello stato
     *
     * @return Attribute<string, never>
     */
    protected function newsStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::NEWS_STATUSES[$this->news_status] ?? $this->news_status
        );
    }

    /**
     * Accessor per il nome della priorità
     *
     * @return Attribute<string, never>
     */
    protected function priorityName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::PRIORITY_LEVELS[$this->priority_level] ?? 'Normale'
        );
    }

    /**
     * Accessor per il nome dell'urgenza
     *
     * @return Attribute<string, never>
     */
    protected function urgencyName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::URGENCY_LEVELS[$this->urgency_level] ?? 'Normale'
        );
    }

    /**
     * Accessor per verificare se è scaduta
     *
     * @return Attribute<bool, never>
     */
    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->expiry_date && $this->expiry_date->isPast()
        );
    }

    /**
     * Accessor per verificare se è attuale
     *
     * @return Attribute<bool, never>
     */
    protected function isCurrent(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->is_expired) {
                    return false;
                }

                return $this->publication_date <= now();
            }
        );
    }

    /**
     * Accessor per l'età della notizia in giorni
     *
     * @return Attribute<int, never>
     */
    protected function ageInDays(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->publication_date?->diffInDays(now())
        );
    }

    /**
     * Accessor per verificare se è una notizia fresca
     *
     * @return Attribute<bool, never>
     */
    protected function isFresh(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->age_in_days <= 7
        );
    }

    /**
     * Accessor per il tempo di lettura stimato
     *
     * @return Attribute<int, never>
     */
    protected function estimatedReadingTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->reading_time) {
                    return $this->reading_time;
                }

                // Stima basata su 200 parole al minuto
                $wordCount = str_word_count(strip_tags((string) ($this->content ?? '')));

                return max(1, ceil($wordCount / 200));
            }
        );
    }

    /**
     * Accessor per l'URL della notizia
     *
     * @return Attribute<string, never>
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => FrontofficeUrl::path('/novita/'.$this->slug)
        );
    }

    /**
     * Accessor per l'URL dell'immagine in evidenza
     *
     * @return Attribute<string|null, never>
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image ? asset('storage/'.$this->featured_image) : null
        );
    }

    /**
     * Mutator per il titolo (genera automaticamente lo slug)
     *
     * @return Attribute<mixed, mixed>
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = (string) $value;
                $this->attributes['title'] = $value;
                if (empty($this->attributes['slug'])) {
                    $this->attributes['slug'] = Str::slug($value);
                }

                return $value;
            }
        );
    }

    /**
     * Mutator per il contenuto (aggiorna reading_time)
     *
     * @return Attribute<mixed, mixed>
     */
    protected function content(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = (string) $value;
                $this->attributes['content'] = $value;

                // Auto-calcola reading time se non impostato
                if (! isset($this->attributes['reading_time'])) {
                    $wordCount = str_word_count(strip_tags((string) $value));
                    $this->attributes['reading_time'] = max(1, ceil($wordCount / 200));
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
        static::creating(function (MunicipalNews $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug((string) $model->title);
            }
        });

        // Assicura unicità dello slug
        static::creating(function (MunicipalNews $model): void {
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });

        // Set default values
        static::creating(function (MunicipalNews $model): void {
            if (is_null($model->news_status)) {
                $model->news_status = 'draft';
            }

            if (is_null($model->priority_level)) {
                $model->priority_level = 2; // Normale
            }

            if (is_null($model->urgency_level)) {
                $model->urgency_level = 2; // Normale
            }

            if (is_null($model->language)) {
                $model->language = 'it';
            }

            if (is_null($model->revision_number)) {
                $model->revision_number = 1;
            }
        });

        // Auto-publish se la data è raggiunta
        static::updating(function (MunicipalNews $model): void {
            if ($model->news_status === 'approved' &&
                $model->publication_date <= now() &&
                ! $model->is_published) {
                $model->is_published = true;
                $model->news_status = 'published';
            }
        });

        // Increment revision number on updates
        static::updating(function (MunicipalNews $model): void {
            if ($model->isDirty(['title', 'content', 'excerpt'])) {
                $model->revision_number++;
                $model->last_modified = now();
            }
        });
    }
}
