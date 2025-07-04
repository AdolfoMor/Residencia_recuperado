<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\EstructuraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

*/


Route::get('/', function () {
    return Inertia::render('home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ])->rootView("web");
});
Route::get('/home', function () {
    return Inertia::render('home')->rootView("web");
});
Route::get('/acerca', function () {
    return Inertia::render('acerca')->rootView("web");
});

Route::get('/email', [App\Http\Controllers\EmailController::class, 'create']);
Route::post('/email', [App\Http\Controllers\EmailController::class, 'sendEmail'])->name('send.email');

Route::get('/Directorio', function () {
    return Inertia::render('Directorio')->rootView("web");
});
Route::get('/Usuario', function () {
    return Inertia::render('users')->rootView("layout");
});

Route::get('/Estructura', function () {
    return Inertia::render('estructuraO')->rootView("layout");
});
Route::get('/DireccionesV/{DireccionesID}', function ($DireccionesID) {
    return Inertia::render('DireccionesV')->with(['DireccionesID'=>$DireccionesID])->rootView('layout');
});
Route::get('/Redes/{RedesID}', function ($RedesID) {
    return Inertia::render('redes')->with(['RedesID'=>$RedesID])->rootView('layout');
});
Route::prefix('admin')->group(function(){
    Route::get('/dashboard', function () {
        return Inertia::render('')->rootView('layout');
    });
});
Route::get('/dashboard', function () {
    return Inertia::render('Sakai/layout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Afiliados', function () {
    return Inertia::render('demo')->rootView("layout");
})->middleware(['auth', 'verified'])->name('afiliado');

Route::resource('afiliado', AfiliadoController::class)
    ->middleware(['auth:sanctum', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
