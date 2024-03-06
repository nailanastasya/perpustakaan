<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

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


Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
Route::get('/author/{id}/edit', [AuthorController::class, 'edit'])->name('author.edit');
Route::put('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');


Route::get('/publisher', [PublisherController::class, 'index'])->name('publisher.index');
Route::get('/publisher/create', [PublisherController::class, 'create'])->name('publisher.create');
Route::post('/publisher', [PublisherController::class, 'store'])->name('publisher.store');
Route::get('/publisher/{id}/edit', [PublisherController::class, 'edit'])->name('publisher.edit');
Route::put('/publisher/{id}', [PublisherController::class, 'update'])->name('publisher.update');
Route::delete('/publisher/{id}', [PublisherController::class, 'destroy'])->name('publisher.destroy');

Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
Route::post('/book', [BookController::class, 'store'])->name('book.store');
Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');

Route::get('/book/search', [SearchController::class, 'search'])->name('book.search');

Route::resource('author', AuthorController::class)->middleware('auth');
Route::resource('publisher', PublisherController::class)->middleware('auth');
Route::resource('book', BookController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
