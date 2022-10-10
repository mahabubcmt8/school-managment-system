<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_type_id',
        'amount',
        'date',
        'description',
    ];

    public function getExpenseType()
    {
        return $this->hasOne(ExpenseType::class, 'id', 'expense_type_id');
    }
}
