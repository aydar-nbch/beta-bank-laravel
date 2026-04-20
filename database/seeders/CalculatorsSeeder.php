<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CreditCalculator;
use App\Models\DepositCalculator;

class CalculatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CreditCalculator::create([
            'name' => 'Ипотека',
            'interest_rate' => 9.6
        ]);

        CreditCalculator::create([
            'name' => 'Автокредит',
            'interest_rate' => 3.5
        ]);

        CreditCalculator::create([
            'name' => 'Потребительский',
            'interest_rate' => 14.5
        ]);

        DepositCalculator::create([
            'name' => 'Выгодный',
            'interest_rate' => 12.5,
            'term_months' => 36
        ]);

        DepositCalculator::create([
            'name' => 'Быстрый',
            'interest_rate' => 8.5,
            'term_months' => 12
        ]);

        DepositCalculator::create([
            'name' => 'Долгий',
            'interest_rate' => 10.5,
            'term_months' => 60
        ]);
    }
}
