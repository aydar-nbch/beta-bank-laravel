@extends('layouts.app')

@section('title', 'Бета-Банк — Рассчитать кредит')
@section('description', 'Удобный калькулятор кредита в Бета-Банке. Узнайте ежемесячный платеж за 1 минуту.')

@section('content')
<div class="normal-width credit-container">
    <h1 class="credit-title">Кредитный калькулятор</h1>
    <div>
        <form action="{{ route('credit.calculate') }}" method="POST">
            @csrf
            <div class="form-container">
                <div class="form-item">
                    <label class="form-label">Тип кредита</label>
                    <select name="credit_calculator_id" class="form-select" required>
                        @foreach($calculators as $calc)
                        <option value="{{ $calc->id }}">{{ $calc->name }} ({{ $calc->interest_rate }}%)
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label class="form-label">Стоимость (руб.)</label>
                    <input type="number" name="property_value" class="form-input" placeholder="2000000" required>
                </div>
                <div class="form-item">
                    <label class="form-label">Первоначальный взнос (руб.)</label>
                    <input type="number" name="down_payment" class="form-input" placeholder="500000" required>
                </div>
                <div class="form-item">
                    <label class="form-label">Срок кредита (лет)</label>
                    <input type="range" name="term_years" class="form-input-range w-100" min="0" max="30" step="1"
                        id="termRange" oninput="this.nextElementSibling.value = this.value">
                    <output>15</output> лет
                </div>

                <div class="form-button-contaner">
                    <button type="submit" class="form-button">Рассчитать</button>
                </div>
            </div>
        </form>
    </div>

    @if(session('result'))
    <div class="result-box">
        <hr>
        <h3 class="result-title">Результаты расчета:</h3>
        <div class="result-items">
            <div class="result-item">
                <p>Ежемесячный платеж</p>
                <h5>{{ number_format(session('result')['monthly_payment'], 0, ',', ' ') }} ₽</h5>
            </div>
            <div class="result-item">
                <p>Сумма кредита</p>
                <h5>{{ number_format(session('result')['loan_amount'], 0, ',', ' ') }} ₽</h5>
            </div>
            <div class="result-item">
                <p>Необходимый доход</p>
                <h5>{{ number_format(session('result')['required_income'], 0, ',', ' ') }} ₽</h5>
            </div>
        </div>

        <hr>
        <form action="{{ route('credit.send_mail', session('last_log_id')) }}" method="POST">
            @csrf
            <div class="send-input">
                <input type="email" name="email" class="form-input" placeholder="Ваш Email" required>
                <button class="form-button" type="submit">Отправить результаты</button>
            </div>
        </form>
    </div>
    @endif

</div>
@endsection