<?php

use App\Enums\TicketStatus;
use Illuminate\Support\Facades\Route;
use App\Livewire\{
    HomePage,
    CategoriesPage,
    CategoriesCreate,
    CategoriesEdit,
    Commentaries,
    CommentariesCreate,
    Operations,
    TicketsPage,
    UsersPage,
    Replies,
    ShowPage,
    TicketEdit,
};

Route::get('/home', HomePage::class)->name('home');
Route::get('/categories',CategoriesPage::class);
Route::get('/categories.edit/{category}',CategoriesEdit::class)->name('category_show');
Route::get('/categories.create',CategoriesCreate::class)->name('category_create');
Route::get('/tickets',TicketsPage::class);
Route::get('/tickets.edit/{ticket}',TicketEdit::class)->name('ticket_edit');
Route::get('/tickets/{ticket}',HomePage::class)->name('ticket_status');
Route::get('/users/{user}',UsersPage::class);
Route::get('/show/{id}',ShowPage::class)->name('show');
Route::get('/replies',Replies::class);
Route::get('/operations',Operations::class);
Route::get('/operations.edit/{operation}',Operations::class);
Route::get('/operations.create',Operations::class);
Route::get('/comments',Commentaries::class);
Route::get('/comments.edit/{coment}',Commentaries::class);
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
});