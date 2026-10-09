<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserController;
Route::prefix('auth')->group(function () {
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/me', [AuthController::class, 'me']);
});
});
Route::middleware('auth:sanctum')->group(function () {
// Laporan
Route::apiResource('reports', ReportController::class);
// Kategori dan fasilitas
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/facilities', [FacilityController::class, 'index']);
Route::get('/facilities/{facility}', [FacilityController::class, 'show']);
// Komentar laporan
Route::get('/reports/{report}/comments', [CommentController::class, 'index']);
Route::post('/reports/{report}/comments', [CommentController::class, 'store']);
Route::put('/comments/{comment}', [CommentController::class, 'update']);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});
// Khusus admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
Route::apiResource('users', UserController::class);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category}', [CategoryController::class, 'update']);
Route::patch('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::post('/facilities', [FacilityController::class, 'store']);
Route::put('/facilities/{facility}', [FacilityController::class, 'update']);
Route::patch('/facilities/{facility}', [FacilityController::class, 'update']);
Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy']);
});