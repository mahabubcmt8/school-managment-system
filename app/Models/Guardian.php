<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'fathers_name',
        'fathers_phone',
        'fathers_email',
        'fathers_photo',
        'mothers_name',
        'mothers_phone',
        'mothers_email',
        'mothers_photo',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

}
