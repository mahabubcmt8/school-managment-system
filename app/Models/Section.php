<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'class_id',
    ];
    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }
}
