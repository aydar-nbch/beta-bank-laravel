<?php

namespace App\Http\Controllers;

use App\Models\CreditCalculator;
use App\Models\CreditLog;
use App\Models\DepositCalculator;
use App\Models\DepositLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    /////////////////////////////////////////////////////////////////////////////////

    // Редактирование кредитов
    public function creditEdit()
    {
        $creditCalculators = CreditCalculator::all();
        return view('admin.credits', compact('creditCalculators'));
    }
    // Добавление калькулятора
    public function creditAdd(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'interest_rate' => 'required|numeric',
        ]);
        CreditCalculator::create($data);
        return back()->with('success', 'Калькулятор добавлен!');
    }
    // Обновление существующего
    public function creditUpdate(Request $request, CreditCalculator $calculator)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'interest_rate' => 'required|numeric',
        ]);
        $calculator->update($data);
        return back()->with('success', 'Данные обновлены!');
    }
    // Удаление
    public function creditDestroy(CreditCalculator $calculator)
    {
        $calculator->delete();
        return back()->with('success', 'Калькулятор удален!');
    }

    ////////////////////////////////////////////////////////////////////////////

    //Редактирование вкладов
    public function depositEdit()
    {
        $depositCalculators = DepositCalculator::all();
        return view('admin.deposits', compact('depositCalculators'));
    }
    // Добавление калькулятора
    public function depositAdd(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'interest_rate' => 'required|numeric',
            'term_months' => 'required|integer'
        ]);
        DepositCalculator::create($data);
        return back()->with('success', 'Калькулятор добавлен!');
    }
    // Обновление существующего
    public function depositUpdate(Request $request, DepositCalculator $calculator)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'interest_rate' => 'required|numeric',
            'term_months' => 'required|integer'
        ]);
        $calculator->update($data);
        return back()->with('success', 'Данные обновлены!');
    }
    // Удаление
    public function depositDestroy(DepositCalculator $calculator)
    {
        $calculator->delete();
        return back()->with('success', 'Калькулятор удален!');
    }

    ///////////////////////////////////////////////////////////////////////////////

    // Расчеты кредитов

    public function creditLog()
    {
        $creditLogs = CreditLog::with('calculator')->latest()->get();
        return view('admin.creditslog', compact('creditLogs'));
    }

    // Экспорт расчетов кредитов

    public function exportCreditLogs()
    {
        $logs = CreditLog::with('calculator')->latest()->get();

        $fileName = "credit_logs_" . date('d-m-y') . ".xls";

        return response()->view('admin.exports.credit_logs_excel', compact('logs'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    //Расчеты вкладов

    public function depositLog()
    {
        $depositLogs = DepositLog::with('calculator')->latest()->get();
        return view('admin.depositslog', compact('depositLogs'));
    }

    // Экспорт расчетов вкладов

    public function exportDepositLogs()
    {
        $logs = DepositLog::with('calculator')->latest()->get();

        $fileName = "deposit_logs_" . date('d-m-y') . ".xls";

        return response()->view('admin.exports.deposit_logs_excel', compact('logs'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', "attachment; filename=\"$fileName\"");
    }
}
