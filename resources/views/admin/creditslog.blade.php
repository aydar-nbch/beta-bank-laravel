@extends('admin.sidebar')
@section('adminContent')
<div class="admin-header">
    <h3>Расчеты кредитов</h3>
    <form action="{{ route('admin.credit_log.export') }}" method="GET">
        @csrf
        @method('GET')
        <button type="submit" class="export-button" onclick="return confirm('Экспортировать данные?')">Экспорт таблицы</button>
    </form>
</div>
<div class="log-table">
    <div class="credit-log-table credit-log-title">
        <p>ID</p>
        <p>Название</p>
        <p>Стоимость</p>
        <p>Взнос</p>
        <p>Срок</p>
        <p>Платеж</p>
        <p>Доход</p>
        <p>Дата</p>
    </div>
    <hr>
    @foreach($creditLogs as $log)
    <div class="credit-log-table">
        <p class="log-item">{{$log->id}}</p>
        <p class="log-item">{{$log->calculator->name ?? 'Калькулятор удален'}}</p>
        <p class="log-item">{{$log->property_value}}</p>
        <p class="log-item">{{$log->down_payment}}</p>
        <p class="log-item">{{$log->term_months}}</p>
        <p class="log-item">{{$log->monthly_payment}}</p>
        <p class="log-item">{{$log->required_income}}</p>
        <p class="log-item">{{ $log->created_at->format('d.m.Y H:i') }}</p>
    </div>
    @endforeach
    @endsection