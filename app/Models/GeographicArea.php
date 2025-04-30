<?php

namespace App\Models;

use App\Models\Enums\GeographicAreaType;
use Carbon\Carbon;
use Database\Factories\GeographicAreaFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $name
 * @property string[] $countries
 * @property GeographicAreaType $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class GeographicArea extends Model
{
    /** @use HasFactory<GeographicAreaFactory> */
    use HasFactory, SoftDeletes, HasUlids;

    protected $fillable = [
        'name'
    ];

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'geographic_area_countries','geographic_area_id','country_id');
    }
}
