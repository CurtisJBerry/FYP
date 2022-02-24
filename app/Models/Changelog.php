<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Changelog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'resource_id',
        'user_id',
    ];

    /**
     * Get the user that owns the changelog.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
