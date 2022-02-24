<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'subject_name',
        'exam_board',
        'subject_level',
        'description',
    ];

    /**
     * Get the modules for the subject.
     */
    public function module(): HasMany
    {
        return $this->hasMany(Module::class);
    }
}
