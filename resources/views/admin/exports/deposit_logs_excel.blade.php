<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <thead>
        <tr style="background-color: #f4f4f4; font-weight: bold;">
            <th>ID</th>
            <th>Название вклада</th>
            <th>Размер вклада</th>
            <th>Ставка %</th>
            <th>Срок</th>
            <th>Финальная сумма</th>
            <th>Дата расчета</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->calculator->name ?? 'Удален' }}</td>
            <td>{{ $log->deposit_value }}</td>
            <td>{{ str_replace('.', ',', $log->interest_rate) }}</td>
            <td>{{ $log->term_months }}</td>
            <td>{{ $log->final_balance }}</td>
            <td>{{ $log->created_at->format('d.m.Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>