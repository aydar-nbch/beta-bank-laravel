<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexConroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DepositController;

// Доступны всем посетителям
Route::get('/', [IndexConroller::class, 'home'])->name('home');

// Кредиты
Route::get('/credit', [CreditController::class, 'credit'])->name('credit');
Route::post('/credit', [CreditController::class, 'calculate'])->name('credit.calculate');
Route::post('/credit/send-mail/{id}', [CreditController::class, 'sendMail'])->name('credit.send_mail');

// Вклады
Route::get('/deposit', [DepositController::class, 'deposit'])->name('deposit');
Route::post('/deposit', [DepositController::class, 'calculate'])->name('deposit.calculate');
Route::post('/deposit/send-mail/{id}', [DepositController::class, 'sendMail'])->name('deposit.send_mail');


// Для гостей
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// Для авторизованных пользователей
Route::middleware('auth')->group(function () {

    // Выход из системы
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // С правами администратора
    Route::middleware('admin')->prefix('admin')->group(function () {

        // Главная страница админки
        Route::get('', [AdminController::class, 'index'])->name('admin.dashboard');

        // Страница кредитов
        Route::get('/credit', [AdminController::class, 'creditEdit'])->name('admin.credit');
        Route::post('/credit/add', [AdminController::class, 'creditAdd'])->name('admin.credit.add');
        Route::patch('/credit/update/{calculator}', [AdminController::class, 'creditUpdate'])->name('admin.credit.update');
        Route::delete('/credit/delete/{calculator}', [AdminController::class, 'creditDestroy'])->name('admin.credit.delete');

        //Страница вкладов
        Route::get('/deposit', [AdminController::class, 'depositEdit'])->name('admin.deposit');
        Route::post('/deposit/add', [AdminController::class, 'depositAdd'])->name('admin.deposit.add');
        Route::patch('/deposit/update/{calculator}', [AdminController::class, 'depositUpdate'])->name('admin.deposit.update');
        Route::delete('/deposit/delete/{calculator}', [AdminController::class, 'depositDestroy'])->name('admin.deposit.delete');

        // Страница расчетов кредита
        Route::get('/credit-log', [AdminController::class, 'creditLog'])->name('admin.credit_log');
        Route::get('/credit-log/export-credits', [AdminController::class, 'exportCreditLogs'])->name('admin.credit_log.export');

        // Страница расчетов вклада
        Route::get('/deposit-log', [AdminController::class, 'depositLog'])->name('admin.deposit_log');
        Route::get('/deposit-log/export-deposits', [AdminController::class, 'exportDepositLogs'])->name('admin.deposit_log.export');
    });
});
