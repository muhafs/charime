<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Character extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function series()
    {
        return $this->belongsTo(Series::class);
    }

    function getImageURL()
    {
        return $this->image ? url('storage/character/' . $this->image) : url('storage/default.png');
    }
}
