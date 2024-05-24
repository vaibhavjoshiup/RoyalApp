<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth.api')->group(function () {
    Route::resource('authors', AuthorController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
    Route::resource('authors', AuthorController::class);
    Route::delete('books/{id}', [AuthorController::class, 'destroyBook'])->name('books.destroy');
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
});



