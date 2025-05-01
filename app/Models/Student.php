<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'courseId',
        'academicYear',
        'name',
        'redgNo',
        'contact',
        'address',
        'dob',
        'bloodGroup',
        'idMark',
        'currentSemester',
        'status',
    ];
}
