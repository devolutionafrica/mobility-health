<?php

namespace App\Models;

use App\Models\Enums\Status;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property double $price
 * @property string $type
 * @property string $validity_period_type
 * @property string $validity_period_value
 */
class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory, HasUlids, softDeletes;

    protected $fillable = [
        "geographic_area_id",
        "insurance_policy_id",
        "status",
        "type",
        "price",
        "validity_period_type",
        "validity_period_value",
    ];

    public function geographicArea(): BelongsTo
    {
        return $this->belongsTo(GeographicArea::class, 'geographic_area_id');
    }

    public function insurancePolicy(): BelongsTo
    {
        return $this->belongsTo(InsurancePolicy::class);
    }
}
