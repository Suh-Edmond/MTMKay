<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/training', [ProgramController::class, 'index'])->name('training');
Route::get('/training-detail', [ProgramController::class, 'show'])->name('show-training');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/submit-inquiry', [ContactController::class, 'submitRequest'])->name('on-inquire');
Route::get('/blog-detail', [BlogController::class, 'show'])->name('show-blog');
Route::post('/blog/create', [BlogCommentController::class, 'createComment'])->name('create-comment');
Route::post('/programs/{id}/enroll', [UserController::class, 'enrollStudent'])->name('enroll-student');
