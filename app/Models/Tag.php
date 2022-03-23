<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'tag_name',
    ];

    /**
     * The resources that belong to the tag.
     */
    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }
}
