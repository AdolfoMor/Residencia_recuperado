<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RedesController;
use App\Http\Controllers\EstructuraController;
use App\Http\Controllers\ContactController;

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
Route::resource('/redes', RedesController::class);
Route::post('/contact', ContactController::class)->name('contact');
Route::resource('/estructura', EstructuraController::class);
Route::get('/afiliado/show/{busqueda}', [AfiliadoController::class, 'show'])->name('afiliado.busqueda');
