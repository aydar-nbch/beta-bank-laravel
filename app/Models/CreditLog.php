<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'credit_calculator_id',
        'property_value',
        'down_payment',
        'term_months',
        'monthly_payment',
        'required_income',
    ];

    public function calculator()
    {
        return $this->belongsTo(CreditCalculator::class, 'credit_calculator_id');
    }
}
