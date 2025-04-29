<?php

namespace App\Models;

use App\Models\Enums\UserType;
use Carbon\Carbon;
use Database\Factories\FileAttachFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $path
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class FileAttach extends Model
{
    /** @use HasFactory<FileAttachFactory> */
    use HasFactory, HasUlids;

    protected $fillable = [
        "path",
        "name",
        "type_ref",
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
