<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
            'name',
            'email',
            'phone',
            'username',
            'class_id',
            'section_id',
            'roll_no',
            'registration_no',
            'gender',
            'address',
            'dob',
            'picture',
    ];

    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function section(){
        return $this->hasOne(Section::class, 'id', 'section_id');
    }

    public function guardian()
    {
        return $this->hasOne(guardian::class, 'student_id', 'id');
    }

}
