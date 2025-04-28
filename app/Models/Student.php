<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
