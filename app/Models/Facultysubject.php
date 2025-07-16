<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultysubject extends Model
{
    use HasFactory;
     protected $fillable = [
        'facultyId',
        'subjectId',
    ];
}
