@extends('admin.sidebar')
@section('adminContent')
<div class="admin-header">
    <h3>Расчеты вкладов</h3>
    <form action="{{ route('admin.deposit_log.export') }}" method="GET">
        @csrf
        @method('GET')
        <button type="submit" class="export-button" onclick="return confirm('Экспортировать данные?')">Экспорт
            таблицы</button>
    </form>
</div>
<div class="log-table">
    <div class="deposit-log-table credit-log-title">
        <p>ID</p>
        <p>Название</p>
        <p>Размер</p>
        <p>Ставка %</p>
        <p>Срок</p>
        <p>Финальная сумма</p>
        <p>Дата</p>
    </div>
    <hr>
    @foreach($depositLogs as $log)
    <div class="deposit-log-table">
        <p class="log-item">{{$log->id}}</p>
        <p class="log-item">{{$log->calculator->name ?? 'Калькулятор удален'}}</p>
        <p class="log-item">{{$log->deposit_value}}</p>
        <p class="log-item">{{$log->interest_rate}}</p>
        <p class="log-item">{{$log->term_months}}</p>
        <p class="log-item">{{$log->final_balance}}</p>
        <p class="log-item">{{ $log->created_at->format('d.m.Y H:i') }}</p>
    </div>
    @endforeach
    @endsection