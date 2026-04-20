@extends('admin.sidebar')
@section('adminContent')
<h3>Управление калькуляторами вклада</h3>

<div class="add-container">
    <h4>Добавить новый калькулятор</h4>
    <form action="{{ route('admin.deposit.add') }}" method="POST" class="add-form">
        @csrf
        <input class="add-item" type="text" name="name" placeholder="Название (напр. Ипотека)" required>
        <input class="add-item" type="number" step="0.01" name="interest_rate" placeholder="Ставка (%)" required>
        <input class="add-item" type="number" step="1" name="term_months" placeholder="Срок (мес)" required>
        <button class="add-button" type="submit">Добавить</button>
    </form>
</div>

<hr>

<div class="content-table">
    <div class="admin-grid admin-grid-title deposit-grid">
        <p>ID</p>
        <p>Название</p>
        <p>Ставка %</p>
        <p>Срок мес.</p>
        <p>✓</p>
        <p>X</p>
    </div>
    @foreach($depositCalculators as $calc)
    <div class="admin-grid admin-grid-table deposit-grid">

        <div class="grid-cell">{{ $calc->id }}</div>

        <form class="edit-form" action="{{ route('admin.deposit.update', $calc->id) }}" method="POST"">
        @csrf
        @method('PATCH')

        <div class=" grid-cell">
            <input type="text" name="name" value="{{ $calc->name }}">
    </div>

    <div class="grid-cell">
        <input type="number" step="0.1" name="interest_rate" value="{{ $calc->interest_rate }}">
    </div>

    <div class="grid-cell">
        <input type="number" step="1" name="term_months" value="{{ $calc->term_months }}">
    </div>

    <div class="grid-cell">
        <button type="submit" class="btn-save">✓</button>
    </div>
    </form>

    <form action="{{ route('admin.deposit.delete', $calc->id) }}" method="POST" style="display: contents;">
        @csrf
        @method('DELETE')
        <div class="grid-cell">
            <button type="submit" class="btn-delete" onclick="return confirm('Удалить?')">X</button>
        </div>
    </form>

</div>
@endforeach

@endsection