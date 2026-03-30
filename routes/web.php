<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowedBooksController;

Route::get('/', function () {
    return redirect()->route('borrowed-books.index');
});

Route::resource('borrowed-books', BorrowedBooksController::class);

Route::get('borrowed-books/trashed/all', [BorrowedBooksController::class, 'trashed'])->name('borrowed-books.trashed');
Route::patch('borrowed-books/{id}/restore', [BorrowedBooksController::class, 'restore'])->name('borrowed-books.restore');
Route::delete('borrowed-books/{id}/force-delete', [BorrowedBooksController::class, 'forceDelete'])->name('borrowed-books.forceDelete');
