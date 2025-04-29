<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $color
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class CardType extends Model
{
    /** @use HasFactory<\Database\Factories\CardTypeFactory> */
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'color',
        'name',
        'id'
    ];
    public $incrementing = false;
    protected $keyType = 'string';

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class,'card_type_question','card_type_id','question_id');
    }
}
