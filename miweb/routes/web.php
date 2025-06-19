<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/home', function () {
    return view('admin.home');
})->middleware('auth')->name('admin.home');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nuestros-servicios', [PageController::class, 'nuestrosServicios'])->name('nuestros-servicios');
Route::get('/sobre-nosotros', [PageController::class, 'sobreNosotros'])->name('sobre-nosotros');
Route::get('/blog-informativo', [PageController::class, 'blogInformativo'])->name('blog-informativo');
Route::get('/contactanos', [PageController::class, 'contactanos'])->name('contactanos');
Route::get('/login', [PageController::class, 'login'])->name('login');