<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function tags()
    {
        return $this->belongsToMany(Tag::class, 'series_tag', 'series_id', 'tag_id');
    }

    function characters()
    {
        return $this->hasMany(Character::class);
    }
}
