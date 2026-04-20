<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <thead>
        <tr style="background-color: #f4f4f4; font-weight: bold;">
            <th>ID</th>
            <th>Название кредита</th>
            <th>Размер кредита</th>
            <th>Первоначальный взнос</th>
            <th>Срок (мес)</th>
            <th>Ежемесячный платеж</th>
            <th>Требуемый доход</th>
            <th>Дата расчета</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->calculator->name ?? 'Удален' }}</td>
            <td>{{ $log->property_value }}</td>
            <td>{{ $log->down_payment }}</td>
            <td>{{ $log->term_months }}</td>
            <td>{{ $log->monthly_payment }}</td>
            <td>{{ $log->required_income }}</td>
            <td>{{ $log->created_at->format('d.m.Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>