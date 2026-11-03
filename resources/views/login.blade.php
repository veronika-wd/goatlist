<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
    <title>Авторизация</title>
</head>
<body>
<main class="d-flex flex-grow-1 vh-100 justify-content-center align-baseline">
    <form action="{{ route('login.login') }}" method="post" class="align-content-center">
        <div class="form-group">
            <label for="login" class="form-label">Логин</label>
            <input type="text" name="login" id="login" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" id="password"  class="form-control" required>
        </div>

        <button type="submit" class="btn-subtle theme-primary w-100 mt-3">Войти</button>
        @error('auth')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </form>
</main>
</body>
</html>
