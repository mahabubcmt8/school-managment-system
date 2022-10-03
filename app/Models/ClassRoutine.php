<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'section_id',
        'day',
    ];


    public function class(){
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'id', 'section_id');
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

    public function ClassRoutinePeriod()
    {
        return $this->hasMany(ClassRoutinePeriod::class , 'routine_no' , 'id' );
    }
}
