@extends('admin.sidebar')
@section('adminContent')
<h3>Управление кредитными калькуляторами</h3>

<div class="add-container">
    <h4>Добавить новый калькулятор</h4>
    <form action="{{ route('admin.credit.add') }}" method="POST" class="add-form">
        @csrf
        <input class="add-item" type="text" name="name" placeholder="Название (напр. Ипотека)" required>
        <input class="add-item" type="number" step="0.01" name="interest_rate" placeholder="Ставка (%)" required>
        <button class="add-button" type="submit">Добавить</button>
    </form>
</div>

<hr>

<div class="content-table">
    <div class="admin-grid admin-grid-title">
        <p>ID</p>
        <p>Название</p>
        <p>Ставка %</p>
        <p>✓</p>
        <p>X</p>
    </div>
    @foreach($creditCalculators as $calc)
    <div class="admin-grid admin-grid-table">

        <div class="grid-cell">{{ $calc->id }}</div>

        <form class="edit-form" action="{{ route('admin.credit.update', $calc->id) }}" method="POST"">
        @csrf
        @method('PATCH')

        <div class=" grid-cell">
            <input type="text" name="name" value="{{ $calc->name }}">
    </div>

    <div class="grid-cell">
        <input type="number" step="0.1" name="interest_rate" value="{{ $calc->interest_rate }}">
    </div>

    <div class="grid-cell">
        <button type="submit" class="btn-save">✓</button>
    </div>
    </form>

    <form action="{{ route('admin.credit.delete', $calc->id) }}" method="POST" style="display: contents;">
        @csrf
        @method('DELETE')
        <div class="grid-cell">
            <button type="submit" class="btn-delete" onclick="return confirm('Удалить?')">X</button>
        </div>
    </form>

</div>
@endforeach

@endsection