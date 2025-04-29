<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthRecord extends Model
{
    /** @use HasFactory<\Database\Factories\HealthRecordFactory> */
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        "response",
        "type",
        "status",
    ];

    protected $casts = [
        "response" => "array",
    ];

    public function targetable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, "targetable");
    }
}
