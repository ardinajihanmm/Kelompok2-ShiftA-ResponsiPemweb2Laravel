<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/laporan', function () {
    return view('reports.index');
})->name('reports.index');

Route::get('/laporan/buat', function () {
    return view('reports.create');
})->name('reports.create');

Route::get('/laporan/{id}', function ($id) {
    return view('reports.show', ['id' => $id]);
})->name('reports.show');