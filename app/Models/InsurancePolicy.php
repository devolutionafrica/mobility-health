<?php

namespace App\Models;

use App\Models\Enums\QuestionType;
use App\Models\Enums\Status;
use App\Models\Enums\UserType;
use Carbon\Carbon;
use Database\Factories\InsurancePolicyFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $summary
 * @property Status $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class InsurancePolicy extends Model
{
    /** @use HasFactory<InsurancePolicyFactory> */
    use HasFactory, SoftDeletes, HasUlids;

    protected $fillable = [
        "description",
        "summary",
        "name",
        "status",
    ];

    protected $casts = [
        'status' => Status::class
    ];

    public function miniature(): MorphOne
    {
        return $this->morphOne(FileAttach::class, 'fileable')
            ->whereNull('name');
    }

    public function fileAttach(): MorphMany
    {
        return $this->morphMany(FileAttach::class, 'fileable')
            ->whereNotNull('name');
    }
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}
