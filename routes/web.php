<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\{
    HomePage,
    CategoriesPage,
    CategoriesEdit,
    Commentaries,
    CommentariesCreate,
    CommentariesEdit,
    Operations,
    OperationsCreate,
    OperationsEdit,
    TicketEdit,
    ShowPage,
    UsersPage,
    Replies,
};

Route::get('/home', HomePage::class)->name('home');
Route::get('/categories',CategoriesPage::class)->name('category');
Route::get('/categories.edit/{category}',CategoriesEdit::class)->name('category_show');
Route::get('/tickets.edit/{ticket}',TicketEdit::class)->name('ticket_edit');
Route::get('/tickets/{ticket}',HomePage::class)->name('ticket_status');
Route::get('/users/{user}',UsersPage::class);
Route::get('/show/{id}',ShowPage::class)->name('show');
Route::get('/replies',Replies::class);
Route::get('/operations/{ticket}',Operations::class)->name('operations');
Route::get('/operations.edit/{operation}',OperationsEdit::class)->name('operation_edit');
Route::get('/operations.create/{ticket}',OperationsCreate::class)->name('operation_create');
Route::get('/comments',Commentaries::class);
Route::get('/comments.edit/{comment}',CommentariesEdit::class)->name('comment_edit');
Route::get('/comments.create',CommentariesCreate::class);

Route::get('/',function () 
{
    return view('auth.login');
} );
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/categories', function () {
        return view('categories');
    })->name('categories');
});