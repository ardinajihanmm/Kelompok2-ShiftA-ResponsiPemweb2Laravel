<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing & Authentication (publik)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'landing'])->name('home');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');

/*
|--------------------------------------------------------------------------
| Aplikasi (login dicek di sisi klien via token Sanctum, data lewat /api)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

Route::get('/reports', [PageController::class, 'reports'])->name('reports.index');
Route::get('/reports/create', [PageController::class, 'reportCreate'])->name('reports.create');
Route::get('/reports/{id}', [PageController::class, 'reportShow'])->whereNumber('id')->name('reports.show');

Route::get('/facilities', [PageController::class, 'facilities'])->name('facilities.index');
Route::get('/categories', [PageController::class, 'categories'])->name('categories.index');
Route::get('/users', [PageController::class, 'users'])->name('users.index');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

// Kompatibilitas: URL lama /app diarahkan ke dashboard
Route::redirect('/app', '/dashboard')->name('app');
