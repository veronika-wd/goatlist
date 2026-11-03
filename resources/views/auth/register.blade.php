<x-layouts.app><div class="auth-wrap"><div class="card auth-card"><div class="auth-brand"><a href="{{ route('wishes.index') }}" class="brand"><span class="brand-mark">g.</span><span>GOATLIST</span></a></div><h1>Создать аккаунт</h1><p class="auth-hint">Сохраняй идеи и возвращайся к ним в любое время.</p>@if($errors->any())<div class="alert alert-error">Проверь введённые данные.</div>@endif<form method="POST" action="{{ route('register') }}">@csrf
            <x-input label="Имя" name="name" required autofocus autocomplete="name" />
            <x-input label="Электронная почта" name="email" type="email" required autocomplete="username" />
            <x-input label="Пароль" name="password" type="password" required autocomplete="new-password" />
            <x-input label="Повтори пароль" name="password_confirmation" type="password" required autocomplete="new-password" />
            <button class="btn btn-primary" style="width:100%" type="submit">Создать аккаунт</button>
        </form><p class="auth-foot">Уже есть аккаунт? <a class="text-link" href="{{ route('login') }}">Войти</a></p></div></div></x-layouts.app>