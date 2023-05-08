<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
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

Route::get('/projects', function () {
    return View('projects');
});

Route::get('/test', function () {
    return Inertia::render('test');
});

Route::get('/Directorio', function () {
    return Inertia::render('Directorio')->rootView("web");
});
Route::get('/Usuario', function () {
    return Inertia::render('users')->rootView("layout");
});
Route::prefix('admin')->group(function(){
    Route::get('/dashboard', function () {
        return Inertia::render('Sakai/layout')->rootView('layout');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('demo');
    })->name('dashboard');
});

