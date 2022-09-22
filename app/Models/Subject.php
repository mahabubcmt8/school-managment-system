<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'code',
        'type',
        'optional',
        'total_mark',
        'pass_mark'
    ];

    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }
}
