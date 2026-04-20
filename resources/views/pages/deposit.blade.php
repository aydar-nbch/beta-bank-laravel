@extends('layouts.app')

@section('title', 'Бета-Банк — Рассчитать вклад')
@section('description', 'Удобный калькулятор вкладов в Бета-Банке.')

@section('content')
<div class="normal-width credit-container">
    <h1 class="credit-title">Калькулятор вклада</h1>
    <div>
        <form action="{{ route('deposit.calculate') }}" method="POST">
            @csrf
            <div class="form-container">
                <div class="form-item">
                    <label class="form-label">Тип вклада</label>
                    <select name="deposit_calculator_id" class="form-select" id="calculator-select" required>
                        @foreach($calculators as $calc)
                        <option value="{{ $calc->id }}">{{ $calc->name }} ({{ $calc->interest_rate }}%)
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-item">
                    <label class="form-label">Размер вклада (руб.)</label>
                    <input type="number" name="deposit_value" class="form-input" placeholder="2000000" required>
                </div>
                <div class="form-item">
                    <p class="form-label">Срок кредита (лет)</p>
                    <p id="term-years-display"> лет</p>
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
                <p>Размер вклада</p>
                <h5>{{ number_format(session('result')['deposit_value'], 0, ',', ' ') }} ₽</h5>
            </div>
            <div class="result-item">
                <p>Срок вклада (лет)</p>
                <h5>{{ number_format((float)session('result')['term_months'] / 12, 1, ',', ' ') }}</h5>
            </div>
            <div class="result-item">
                <p>Процентная ставка</p>
                <h5>{{ number_format(session('result')['interest_rate'], 0, ',', ' ') }} %</h5>
            </div>
            <div class="result-item">
                <p>Итоговая сумма</p>
                <h5>{{ number_format(session('result')['final_balance'], 0, ',', ' ') }} ₽</h5>
            </div>
        </div>

        <hr>
        <form action="{{ route('deposit.send_mail', session('last_log_id')) }}" method="POST">
            @csrf
            <div class="send-input">
                <input type="email" name="email" class="form-input" placeholder="Ваш Email" required>
                <button class="form-button" type="submit">Отправить результаты</button>
            </div>
        </form>
    </div>
    @endif

</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calculators = @json($calculators);
    
        const select = document.getElementById('calculator-select');
        const display = document.getElementById('term-years-display');
    
        function getYearsText(years) {
            const lastDigit = years % 10;
            const lastTwoDigits = years % 100;
        
            if (lastTwoDigits >= 11 && lastTwoDigits <= 14) return years + ' лет' ;
            if (lastDigit===0 || lastDigit>= 5) return years + ' лет';
            if (lastDigit === 1) return years + ' год';
            return years + ' года';
        }

        function updateTerm() {
            const selectedId = select.value;
    
            // Ищем калькулятор по id в массиве
            const calculator = calculators.find(calc => calc.id == selectedId);
    
            if (calculator && calculator.term_months) {
                const termMonths = parseInt(calculator.term_months);
                const years = termMonths / 12;
    
                display.textContent = getYearsText(years);
            } else {
                display.textContent = 'Выберите вклад';
            }
        }
    
        // Инициализация при загрузке
        updateTerm();
    
        // Обновление при смене выбора
        select.addEventListener('change', updateTerm);
    });
</script>
@endsection