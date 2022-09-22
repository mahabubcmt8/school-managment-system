<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'department_id',
        'gender',
        'dob',
        'profile_picture',
        'resume',
        'joining_letter'
    ];

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
