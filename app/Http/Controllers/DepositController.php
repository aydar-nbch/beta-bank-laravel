<?php

namespace App\Http\Controllers;

use App\Models\DepositCalculator;
use App\Models\DepositLog;
use Illuminate\Http\Request;
use App\Mail\CalculationResultMail;
use Illuminate\Support\Facades\Mail;

class DepositController extends Controller
{
    public function deposit()
    {
        $calculators = DepositCalculator::all();
        return view('pages.deposit', compact('calculators'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'deposit_calculator_id' => 'required|exists:deposit_calculators,id',
            'deposit_value' => 'required|numeric|min:0',
        ]);

        $calculator = DepositCalculator::find($request->deposit_calculator_id);

        $depositValue = $request->deposit_value;
        $interestRate = $calculator->interest_rate; 
        $termMonths = $calculator->term_months; 

        $termYears = $termMonths / 12;

        $finalBalance = $depositValue * pow(1 + $interestRate / 100, $termYears);

        $finalBalance = round($finalBalance, 2);

        $log = DepositLog::create([
            'deposit_calculator_id' => $calculator->id,
            'deposit_value' => $request->deposit_value,
            'term_months' => $termMonths,
            'interest_rate' => $interestRate,
            'final_balance' => $finalBalance
        ]);

        return back()->with([
            'result' => [
                'deposit_value' => $request->deposit_value,
                'interest_rate' => $interestRate,
                'term_months' => $termMonths,
                'final_balance' => $finalBalance
            ],
            'last_log_id' => $log->id
        ]);
    }

    public function sendMail(Request $request, $id)
    {
        $request->validate(['email' => 'required|email']);
        $log = DepositLog::findOrFail($id);
        
        Mail::to($request->email)->send(new CalculationResultMail($log));
        return back()->with('success', 'Результаты успешно отправлены на почту!');
    }
}
