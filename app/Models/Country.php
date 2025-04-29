<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $nationality
 * @property string $iso
 * @property string $unicode_pair
 * @property string $phone_prefix
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        "name",
        "nationality",
        "iso",
        "unicode_pair",
        "phone_prefix"
    ];
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class,"nationality_id","iso");
    }
}
