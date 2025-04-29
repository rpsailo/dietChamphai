<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'courseId',
        'name',
        'fatherName',
        'motherName',
        'qualification',
        'contact',
        'permanentAddress',
        'email',
        'category',
        'dob',
        'currentSemester',
        'status',
    ];
}
