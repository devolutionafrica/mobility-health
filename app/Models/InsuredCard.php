<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuredCard extends Model
{
    /** @use HasFactory<\Database\Factories\InsuredCardFactory> */
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        "insured_number",
        "card_number",
        "issue_date",
        "expiration_date",
        "status",
    ];

    protected $casts = [
        "issue_date" => "datetime",
        "expiration_date" => "datetime"
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
