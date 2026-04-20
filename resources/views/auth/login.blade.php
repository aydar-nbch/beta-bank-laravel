@extends('layouts.app')

@section('content')
<div class="login-form">
    <h2>Вход для администратора</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="login-container">
            <div class="login-item">
                <label class="login-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="login-input" value="{{ old('email') }}" required
                    autocomplete="email" autofocus>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="login-item">
                <label class="login-label" for="password">Пароль</label>
                <input type="password" name="password" id="password" class="login-input" required
                    autocomplete="current-password">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="login-button-container">
                <button type="submit" class="login-button">Войти</button>
            </div>
        </div>
    </form>
</div>
@endsection