<h1>Результаты вашего расчёта</h1>

@if($log instanceof \App\Models\CreditLog)
<p>Тип кредита: {{ $log->calculator->name }}</p>
<p>Необходимая сумма: {{ number_format($log->property_value, 0, ',', ' ') }} ₽</p>
<p>Первоначальный взнос: {{ number_format($log->down_payment, 0, ',', ' ') }} ₽</p>
<p>Сумма кредита: {{ number_format($log->property_value - $log->down_payment, 0, ',', ' ') }} ₽</p>
<p>Ежемесячный платёж: {{ number_format($log->monthly_payment, 2, ',', ' ') }} ₽</p>
<p>Срок: {{ $log->term_months / 12 }} лет</p>
<p>Необходимый доход: {{ number_format($log->required_income, 2, ',', ' ') }} ₽</p>

@elseif($log instanceof \App\Models\DepositLog)
<p>Тип вклада: {{ $log->calculator->name }}</p>
<p>Размер вклада: {{ number_format($log->deposit_value, 0, ',', ' ') }} ₽</p>
<p>Процентная ставка: {{ $log->interest_rate }} %</p>
<p>Срок вклада: {{ $log->term_months }} месяцев</p>
<p>Итоговая сумма: {{ number_format($log->final_balance, 2, ',', ' ') }} ₽</p>
<p>Доход по вкладу: {{ number_format($log->final_balance - $log->deposit_value, 2, ',', ' ') }} ₽</p>
@else
<p>Неизвестный тип расчёта.</p>
@endif