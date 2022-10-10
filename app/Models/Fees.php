<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;

    protected $fillable = [
        'fees_type_id',
        'class_id',
        'section_id',
        'student_id',
        'amount',
        'due_date',
        'status',
        'note',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function getFeesType()
    {
        return $this->hasOne(FeesType::class, 'id', 'fees_type_id');
    }

    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'id', 'section_id');
    }
}
