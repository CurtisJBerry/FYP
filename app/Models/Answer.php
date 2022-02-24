<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'question_id',
        'answer_text',
        'correct',
    ];

    /**
     * Get the test that owns the question.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
