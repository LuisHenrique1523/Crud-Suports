<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\{
    HomePage,
    TicketsPage,
    UsersPage,
    CategoriesPage
};

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
// Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::resource('/users', UserController::class);

Route::get('/', HomePage::class);
Route::get('/tickets',TicketsPage::class);
Route::get('/users/{user}',UsersPage::class);
Route::get('/categories',CategoriesPage::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


