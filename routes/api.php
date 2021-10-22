<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AutoController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::resource('trabajador', TrabajadorController::class);
    Route::resource('usuario', UsuarioController::class);
    Route::resource('marca', MarcaController::class);
    Route::resource('auto', AutoController::class);
});