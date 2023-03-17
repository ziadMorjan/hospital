<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    public function majors()
    {
        return $this->belongsToMany(Major::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
