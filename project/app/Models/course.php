<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    public function tracks()
    {
        return $this->belongsToMany(Track::class);
    }

    public function instructors()
    {
        return $this->belongsToMany(instructor::class);
    }

    use HasFactory;
}
