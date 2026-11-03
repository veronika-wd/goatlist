<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;

// Публичные маршруты
Route::get('/', [WishController::class, 'index'])->name('wishes.index');
Route::get('/wishes/{wish}', [WishController::class, 'show'])->name('wishes.show');

// !!! ВОТ ЭТОТ КУСОК ИСПРАВЛЯЕТ ОШИБКУ !!!
// Создаем маршрут dashboard, который просто перенаправляет в админку желаний
Route::get('/dashboard', function () {
    return redirect()->route('admin.wishes.index');
})->middleware(['auth'])->name('dashboard');
// ----------------------------------------

// Админка (только для авторизованных)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Дашборд админки (если нужен отдельный, или можно оставить редирект выше)
    Route::get('/', function () {
        return redirect()->route('admin.wishes.index');
    })->name('dashboard'); // Можно назвать иначе, например admin.home

    // Желания
    Route::get('/wishes', [WishController::class, 'adminIndex'])->name('wishes.index');
    Route::get('/wishes/create', [WishController::class, 'create'])->name('wishes.create');
    Route::post('/wishes', [WishController::class, 'store'])->name('wishes.store');
    Route::get('/wishes/{wish}/edit', [WishController::class, 'edit'])->name('wishes.edit');
    Route::put('/wishes/{wish}', [WishController::class, 'update'])->name('wishes.update');
    Route::delete('/wishes/{wish}', [WishController::class, 'destroy'])->name('wishes.destroy');

    // Категории
    Route::resource('categories', CategoryController::class);

    // Статусы
    Route::resource('statuses', StatusController::class);
});

require __DIR__.'/auth.php';
