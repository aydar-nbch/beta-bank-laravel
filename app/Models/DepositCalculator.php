<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositCalculator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'interest_rate',
        'term_months'
    ];
}
