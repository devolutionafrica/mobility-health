<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string[] $period
 * @property string[] $questions
 * @property float $price
 * @property Customer $customer
 * @property InsurancePolicy $insurancePolicy
 * @property CardType $cardType
 * @property Carbon $date_start
 * @property Carbon $date_end
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory, softDeletes, HasUlids;

    protected $fillable = [
        "emit_date",
        "period",
        "price",
        "date_start",
        "date_end",
        "customer_id",
        "insurance_policy_ref",
        "destination_option",
        "zone_ref",
        "package_ref",
        "residence_id",
        "departure_code",
        "destination_code",
        "payment_method",
        "status",
        "status_message",
        "whatsapp",
        "phone",
    ];

    protected $casts = [
        "period" => "array",
        "whatsapp" => "array",
        "phone" => "array",
        "price" => "float",
        "emit_date" => "datetime",
        "date_start" => "datetime",
        "date_end" => "datetime",
    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function geographicArea(): BelongsTo
    {
        return $this->belongsTo(GeographicArea::class,"zone_ref","id");
    }
    public function residence(): BelongsTo
    {
        return $this->belongsTo(Country::class,"residence_id");
    }

    public function departure(): BelongsTo
    {
        return $this->belongsTo(Country::class,"departure_code");
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Country::class,"destination_code");
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, "package_ref","id");
    }

    public function insurancePolicy(): BelongsTo
    {
        return $this->belongsTo(InsurancePolicy::class,"insurance_policy_ref","id");
    }


}
