<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

use Illuminate\Database\Eloquent\Builder;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\Factory;
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Base model per l'ontologia AGID del tema Sixteen.
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 */
abstract class MunicipalBaseModel extends Model
{
<<<<<<< HEAD
    /** @use HasFactory<\Illuminate\Database\Eloquent\Factories\Factory<static>> */
=======
    /** @use HasFactory<Factory<static>> */
>>>>>>> laraxot/dev
    use HasFactory;
}
