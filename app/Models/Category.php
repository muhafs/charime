<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function series()
    {
        return $this->hasMany(Series::class);
    }

    function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
