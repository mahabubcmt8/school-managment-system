<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoutinePeriod extends Model
{
    use HasFactory;


    protected $fillable = [
        'routine_no',
        'subject_id',
        'class_room_id',
        'teacher_id',
        'start_time',
        'end_time',
    ];

    public function getRoutine(){
        return $this->belongsTo(ClassRoutine::class, 'routine_no', 'id');
    }

    public function subject(){
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function class_room(){
        return $this->hasOne(ClassRoom::class, 'id', 'class_room_id');
    }

    public function teacher(){
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
}
