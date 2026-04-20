<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Бета-Банк — Финансовые решения')</title>
    <meta name="description"
        content="Рассчитайте кредит или вклад онлайн в Бета-Банке. Удобные калькуляторы с мгновенным результатом.">
    @vite(['resources/css/app.css'])
</head>

<body>
    <header>
        <div class="header-container normal-width">
            <a href="{{route('home')}}"><img class="logo" src="/logo.png" alt="Логотип"></a>
            <ul class="nav-menu">
                <li><a href="{{ route('credit') }}">Кредиты</a></li>
                <li><a href="{{ route('deposit') }}">Вклады</a></li>
                @auth
                @if(auth()->user()->is_admin)
                <li><a href="{{ route('admin.dashboard') }}">Админ панель</a></li>
                @endif
                @endauth
            </ul>

            @auth
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Выйти</button>
            </form>
            @endauth

            @guest
            <a href="{{ route('login') }}">
                <button>Войти</button>
            </a>
            @endguest
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-container normal-width">
            <a href="{{route('home')}}"><img class="footer-logo" src="/logo.png" alt="Логотип"></a>
            <ul class="footer-nav-menu">
                <li><a href="{{ route('credit') }}">Кредиты</a></li>
                <li><a href="{{ route('deposit') }}">Вклады</a></li>
                @auth
                @if(auth()->user()->is_admin)
                <li><a href="{{ route('admin.dashboard') }}">Админ панель</a></li>
                @endif
                @endauth
            </ul>

            @auth
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Выйти</button>
            </form>
            @endauth

            @guest
            <a href="{{ route('login') }}">
                <button>Войти</button>
            </a>
            @endguest
        </div>
        <p class="copyright">&copy; 2026 АО «Бета-Банк». Все права защищены.</p>
    </footer>
</body>

</html>