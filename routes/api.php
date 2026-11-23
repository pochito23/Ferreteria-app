<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\RRHHController;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class,'login']);
Route::middleware('Auth:sanctum')->group(function () {
    Route::apiResource('producto', ProductoController::class);
    Route::apiResource('empleado', RRHHController::class);
});
