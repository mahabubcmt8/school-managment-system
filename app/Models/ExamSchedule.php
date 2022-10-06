<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'class_id',
        'section_id',
        'class_room_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
    ];

    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }

    public function class_room(){
        return $this->hasOne(ClassRoom::class, 'id', 'class_room_id');
    }

    public function subject(){
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'id', 'section_id');
    }

    public function class(){
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

}
