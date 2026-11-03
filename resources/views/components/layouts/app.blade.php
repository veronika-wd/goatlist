<!DOCTYPE html>
<html lang="ru" x-data="{ theme: localStorage.getItem('goatlist-theme') || 'light', toggleTheme(){this.theme=this.theme==='light'?'dark':'light';localStorage.setItem('goatlist-theme',this.theme);document.documentElement.classList.toggle('dark',this.theme==='dark')} }" x-init="document.documentElement.classList.toggle('dark',theme==='dark')">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Goatlist — список желаний')</title>
    <script>try{if(localStorage.getItem('goatlist-theme')==='dark')document.documentElement.classList.add('dark')}catch(e){}</script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
<header class="site-header"><div class="header-inner">
    <a href="{{ route('wishes.index') }}" class="brand"><span class="brand-mark">g.</span><span>GOATLIST</span></a>
    <div class="header-actions">
        <a href="{{ route('wishes.index') }}" class="header-link {{ request()->routeIs('wishes.*') ? 'active' : '' }}">Желания</a>
        @auth
            <a href="{{ route('admin.wishes.index') }}" class="header-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">Управление</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="header-link" type="submit">Выйти</button></form>
        @else
            <a href="{{ route('login') }}" class="header-link">Войти</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Создать аккаунт</a>
        @endauth
        <button type="button" class="theme-button" @click="toggleTheme()" :aria-label="theme==='light'?'Включить тёмную тему':'Включить светлую тему'" title="Сменить тему"><span x-text="theme==='light'?'☾':'☀'"></span></button>
    </div>
</div></header>
<main class="page-shell">@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif{{ $slot }}</main>
<footer class="site-footer">GOATLIST <span aria-hidden="true">·</span> ТВОИ ЖЕЛАНИЯ — ТВОИ ПРАВИЛА</footer>
</body></html>
