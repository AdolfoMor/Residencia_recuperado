<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\UserController;

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

Route::resource('/afiliado', AfiliadoController::class);
Route::resource('/direcciones', DireccionesController::class);
Route::resource('/users', UserController::class);
Route::get('/afiliado/show/{busqueda}', [AfiliadoController::class, 'show'])->name('afiliado.busqueda');
