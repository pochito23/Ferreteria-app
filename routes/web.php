<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/hola', function () {
    return ('hola mundo programacion wweb');
});



Route::resource('productos', ProductoController::class);
Route::get('/', function () {
    return redirect()->route('productos.index');
});

Route::resource('empleados', EmpleadoController::class);
