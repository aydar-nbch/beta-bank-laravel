@extends('layouts.app')
@section('content')
<div class="admin-panel normal-width">
    <div class="sidebar">
        <a href="{{route('admin.credit')}}" class="sidebar-item">
            <p>Редактировать кредиты</p>
        </a>
        <a href="{{route('admin.deposit')}}" class="sidebar-item">
            <p>Редактировать вклады</p>
        </a>
        <a href="{{route('admin.credit_log')}}" class="sidebar-item">
            <p>Расчеты кредитов</p>
        </a>
        <a href="{{route('admin.deposit_log')}}" class="sidebar-item">
            <p>Расчеты вкладов</p>
        </a>
    </div>
    <hr>
    <div class="admin-panel-content">
        @yield('adminContent')
    </div>
</div>
@endsection