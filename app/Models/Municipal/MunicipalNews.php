<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property array|null $target_audience
 * @property array|null $geographic_scope
 * @property string|null $language
 * @property string|null $featured_image
 * @property string|null $image_caption
 * @property string|null $image_alt_text
 * @property array|null $gallery
 * @property array|null $attachments
 * @property array|null $related_services
 * @property array|null $related_events
 * @property array|null $related_people
 * @property array|null $related_documents
 * @property array|null $external_links
 * @property array|null $tags
 * @property string|null $social_summary
 * @property string|null $meta_description
 * @property array|null $seo_keywords
 * @property Carbon|null $publication_date
 * @property Carbon|null $expiry_date
 * @property Carbon|null $last_modified
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
 * @property array|null $accessibility_notes
 * @property string|null $feedback_url
 * @property string|null $correction_notice
 * @property array|null $translation_links
 * @property array|null $structured_data
 * @property array|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read PublicPerson|null $author
 * @property-read PublicPerson|null $editor
 * @property-read Collection<int, ContactPoint> $contacts
 * @property-read Collection<int, self> $categories
 * @property-read Collection<int, self> $tags
 */
class MunicipalNews extends Model
{
    use HasFactory, SoftDeletes;

    /**
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
->where(function ($q): void {
                $q->whereNull('expiry_date')
                    ->orWhere('expiry_date', '>', now());
            });
    }

    /**
     * Scope per notizie in evidenza
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope per notizie breaking
     */
    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    /**
     * Scope per notizie da homepage
     */
    public function scopeHomepage($query)
    {
        return $query->where('show_on_homepage', true);
    }

    /**
     * Scope per tipologia di notizia
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('news_type', $type);
    }

    /**
     * Scope per categoria
     */
    public function scopeInCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope per priorità minima
     */
    public function scopeMinPriority($query, int $priority)
    {
        return $query->where('priority_level', '>=', $priority);
    }

    /**
     * Scope per notizie recenti
     */
    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('publication_date', '>=', now()->subDays($days));
    }

    /**
     * Scope ordinati per pubblicazione
     */
    public function scopeOrdered($query, string $direction = 'desc')
    {
        return $query->orderBy('publication_date', $direction)
            ->orderBy('priority_level', 'desc');
    }

    /**
* Accessor per il nome del tipo di notizia
     */
    protected function newsTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::NEWS_TYPES[$this->news_type] ?? $this->news_type
        );
    }

    /**
     * Accessor per il nome dello stato
     */
    protected function newsStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::NEWS_STATUSES[$this->news_status] ?? $this->news_status
        );
    }

    /**
     * Accessor per il nome della priorità
     */
    protected function priorityName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::PRIORITY_LEVELS[$this->priority_level] ?? 'Normale'
        );
    }

    /**
     * Accessor per il nome dell'urgenza
     */
    protected function urgencyName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::URGENCY_LEVELS[$this->urgency_level] ?? 'Normale'
        );
    }

    /**
     * Accessor per verificare se è scaduta
     */
    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->expiry_date && $this->expiry_date->isPast()
        );
    }

    /**
     * Accessor per verificare se è attuale
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
     */
    protected function ageInDays(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->publication_date?->diffInDays(now())
        );
    }

    /**
     * Accessor per verificare se è una notizia fresca
     */
    protected function isFresh(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->age_in_days <= 7
        );
    }

    /**
     * Accessor per il tempo di lettura stimato
     */
    protected function estimatedReadingTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->reading_time) {
                    return $this->reading_time;
                }

                // Stima basata su 200 parole al minuto
                $wordCount = str_word_count(strip_tags($this->content));

                return max(1, ceil($wordCount / 200));
            }
        );
    }

    /**
     * Accessor per l'URL della notizia
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('municipal.news.show', $this->slug)
        );
    }

    /**
     * Accessor per l'URL dell'immagine in evidenza
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image ? asset('storage/'.$this->featured_image) : null
        );
    }

    /**
     * Mutator per il titolo (genera automaticamente lo slug)
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
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
     */
    protected function content(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $this->attributes['content'] = $value;

                // Auto-calcola reading time se non impostato
                if (! isset($this->attributes['reading_time'])) {
                    $wordCount = str_word_count(strip_tags($value));
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
static::creating(function ($model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
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

        // Set default values
static::creating(function ($model): void {
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
static::updating(function ($model): void {
            if ($model->news_status === 'approved' &&
                $model->publication_date <= now() &&
                ! $model->is_published) {
                $model->is_published = true;
                $model->news_status = 'published';
            }
        });

        // Increment revision number on updates
static::updating(function ($model): void {
            if ($model->isDirty(['title', 'content', 'excerpt'])) {
                $model->revision_number++;
                $model->last_modified = now();
            }
        });
    }
}
