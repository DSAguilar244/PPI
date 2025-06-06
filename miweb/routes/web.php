<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/nuestros-servicios', [PageController::class, 'nuestrosServicios'])->name('nuestros-servicios');
Route::get('/sobre-nosotros', [PageController::class, 'sobreNosotros'])->name('sobre-nosotros');
Route::get('/blog-informativo', [PageController::class, 'blogInformativo'])->name('blog-informativo');
Route::get('/contactanos', [PageController::class, 'contactanos'])->name('contactanos');
Route::get('/login', [PageController::class, 'login'])->name('login');