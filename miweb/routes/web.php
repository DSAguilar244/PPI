<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HomeContentController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/nuestros-servicios', function () {
    $services = \App\Models\Service::all();
    return view('services.index', compact('services'));
})->name('nuestros-servicios');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('about', [\App\Http\Controllers\Admin\AboutController::class, 'edit'])->name('about.edit');
    Route::post('about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [HomeContentController::class, 'edit'])->name('admin.home');
    Route::post('/admin/home', [HomeContentController::class, 'update'])->name('admin.home.update');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
});

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/sobre-nosotros', [PageController::class, 'sobreNosotros'])->name('sobre-nosotros');
Route::get('/blog-informativo', [PageController::class, 'blogInformativo'])->name('blog-informativo');
Route::get('/contactanos', [PageController::class, 'contactanos'])->name('contactanos');
Route::post('/contactanos', [\App\Http\Controllers\PageController::class, 'enviarContacto'])->name('contactanos.enviar');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('blog', [\App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blog.index');
    Route::post('blog', [\App\Http\Controllers\Admin\BlogController::class, 'store'])->name('blog.store');
    Route::delete('blog/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('blog.destroy');
    Route::post('testimonial', [\App\Http\Controllers\Admin\BlogController::class, 'storeTestimonial'])->name('testimonial.store');
    Route::delete('testimonial/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'destroyTestimonial'])->name('testimonial.destroy');
    Route::delete('subscription/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'destroySubscription'])->name('subscription.destroy');
    Route::get('contact-section', [\App\Http\Controllers\Admin\ContactSectionController::class, 'edit'])->name('contact.edit');
    Route::post('contact-section', [\App\Http\Controllers\Admin\ContactSectionController::class, 'update'])->name('contact.update');
});
Route::post('/blog-informativo/suscribir', [PageController::class, 'subscribe'])->name('blog-informativo.subscribe');
