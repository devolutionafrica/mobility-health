<?php

namespace App\Models;

use App\Models\Enums\QuestionType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionGroup extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionGroupFactory> */
    use HasFactory, HasUlids;

    protected $fillable = [
        "title",
        "page",
        "question_type",
    ];

  /*  protected $casts = [
        'question_type' => QuestionType::class
    ];*/


    public function questions(): HasMany{
        return $this->hasMany(Question::class);
    }
}
