@extends('layouts.app')

@section('content')
<div class="home-content normal-width">
    <h1 class="home-title">Простые финансовые решения для ваших целей</h1>
    <div class="banner-container">
        <div class="banner">
            <div class="banner-content">
                <p class="banner-title">РАСЧИТАТЬ <br> КРЕДИТ</p>
                <p class="banner-text">Расчитайте заявку <br> онлайн</p>
                <a href="{{'credit'}}" class="banner-button"> Расчитать кредит</a>
            </div>
            <div class="banner-image">
                <img src="credit.png" alt="Кредит">
            </div>
        </div>
        <div class="banner">
            <div class="banner-content">
                <p class="banner-title">РАСЧИТАТЬ <br> ВКЛАД</p>
                <p class="banner-text">Преумножьте ваши <br> сбережения</p>
                <a href="{{'deposit'}}" class="banner-button">Расчитать вклад</a>
            </div>
            <div class="banner-image">
                <img src="deposit.png" alt="Вклад">
            </div>
        </div>
    </div>
    <h1 class="advantages-title">Наши преимущества</h1>
    <div class="advantages">
        <div class="advantage">
            <img src="time.png" alt="Одобрение за 2 минуты" class="advantage-image">
            <p class="advantage-title">Одобрение за 2 минуты</p>
        </div>
        <div class="advantage">
            <img src="app.png" alt="Управление в мобильном приложении" class="advantage-image">
            <p class="advantage-title">Управление в мобильном приложении</p>
        </div>
        <div class="advantage">
            <img src="ruble.png" alt="Никаких скрытых комиссий" class="advantage-image">
            <p class="advantage-title">Никаких скрытых комиссий</p>
        </div>
    </div>
</div>
@endsection