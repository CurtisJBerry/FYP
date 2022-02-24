<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'module_name',
        'description',
    ];

    /**
     * Get the subject that owns the module.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the resources for the module.
     */
    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * Get the tests for the module.
     */
    public function test(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
