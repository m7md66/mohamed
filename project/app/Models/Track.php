<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{

    public function courses()
    {
        return $this->belongsToMany(course::class);
    }
    use HasFactory;
}


