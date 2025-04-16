<?php

use App\Enums\TicketStatus;
use Illuminate\Support\Facades\Route;
use App\Livewire\{
    HomePage,
    CategoriesPage,
    CategoriesCreate,
    CategoriesEdit,
    TicketsPage,
    UsersPage,
    PrioritiesPage,
    Replies,
    StatusesPage,
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
Route::get('/priorities',PrioritiesPage::class);
Route::get('/status',StatusesPage::class);
Route::get('/show/{id}',ShowPage::class)->name('show');
Route::get('/replies',Replies::class);

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