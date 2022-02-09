<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('transaction')->middleware('auth:api')->group(function () {
    Route::get('/', [TransactionController::class, 'transactions']);
    Route::post('/', [TransactionController::class, 'create']);
});
