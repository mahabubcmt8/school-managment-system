<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
            'student_id',
            'class_id',
            'section_id',
            'exams_id',
            'subject_id',
            'marks',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'id', 'section_id');
    }
}
