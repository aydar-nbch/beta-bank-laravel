<?php

namespace App\Http\Controllers;

use App\Models\CreditCalculator;
use App\Models\CreditLog;
use Illuminate\Http\Request;
use App\Mail\CalculationResultMail;
use Illuminate\Support\Facades\Mail;

class CreditController extends Controller
{
    public function credit()
    {
        $calculators = CreditCalculator::all();
        return view('pages.credit', compact('calculators'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'credit_calculator_id' => 'required|exists:credit_calculators,id',
            'property_value' => 'required|numeric|min:0',
            'down_payment' => 'required|numeric|min:0',
            'term_years' => 'required|integer|min:1|max:50',
        ]);

        $calculator = CreditCalculator::find($request->credit_calculator_id);

        // Сумма кредита 
        $loanAmount = $request->property_value - $request->down_payment;

        // Ежемесячная ставка 
        $monthlyRate = $calculator->interest_rate / 12 / 100;

        // Общая ставка 
        $termMonths = $request->term_years * 12;
        $totalRate = pow(1 + $monthlyRate, $termMonths);

        // Ежемесячный платеж 
        $monthlyPayment = $loanAmount * $monthlyRate * $totalRate / ($totalRate - 1);

        // Необходимый доход 
        $requiredIncome = $monthlyPayment * 2.5;

        $log = CreditLog::create([
            'credit_calculator_id' => $calculator->id,
            'property_value' => $request->property_value,
            'down_payment' => $request->down_payment,
            'term_months' => $termMonths,
            'monthly_payment' => $monthlyPayment,
            'required_income' => $requiredIncome,
        ]);

        return back()->with([
            'result' => [
                'monthly_payment' => round($monthlyPayment, 2),
                'required_income' => round($requiredIncome, 2),
                'loan_amount' => $loanAmount
            ],
            'last_log_id' => $log->id
        ]);
    }

    public function sendMail(Request $request, $id)
    {
        $request->validate(['email' => 'required|email']);
        $log = CreditLog::findOrFail($id);

        Mail::to($request->email)->send(new CalculationResultMail($log));
        return back()->with('success', 'Результаты успешно отправлены на почту!');
    }
}
