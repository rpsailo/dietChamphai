<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'courseId',
        'facultyId',
        'name',
        'semester',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}

