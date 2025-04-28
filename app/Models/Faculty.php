<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fatherName',
        'motherName',
        'contact',
        'permanentAddress',
        'dob',
        'bloodGroup',
    ];

    /* public function course(){
        return $this->belongsTo(Course::class);
    } */
}
