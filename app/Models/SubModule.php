<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubModule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'submodule_name',
        'description',
    ];

    /**
     * Get the module that owns the submodule.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
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
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
