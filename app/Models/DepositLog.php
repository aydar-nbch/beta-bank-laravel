<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'deposit_calculator_id',
        'deposit_value',
        'interest_rate',
        'term_months',
        'final_balance',
    ];

    public function calculator()
    {
        return $this->belongsTo(DepositCalculator::class, 'deposit_calculator_id');
    }
}
