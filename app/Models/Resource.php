<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'resource_name',
        'resource_path',
        'description',
        'user_id',
        'question_id',
        'module_id',
    ];

    /**
     * Get the module that owns the resource.
     */
    public function submodule(): BelongsTo
    {
        return $this->belongsTo(SubModule::class);
    }

    /**
     * Get the question that owns the resource.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the changelog associated with the resource.
     */
    public function log()
    {
        return $this->hasOne(Changelog::class);
    }

    /**
     * The tags that belong to the resource.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
