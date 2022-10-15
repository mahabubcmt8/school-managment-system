<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendence extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'student_id',
        'class_id',
        'section_id',
        'attendence',
    ];

}
