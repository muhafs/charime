<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function series()
    {
        return $this->belongsToMany(Series::class, 'series_tag', 'tag_id', 'series_id');
    }
}
