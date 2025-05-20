<?php

use Illuminate\Support\Facades\Route;

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
        return view('blade.dashboard');
    })->name('dashboard');
    
    Route::get('/categories', function () {
        return view('blade.categories');
    })->name('categories');

    Route::get('/commentaries/ticket/{ticket}', function () {
        return view('blade.commentaries');
    })->name('commentaries');

    Route::get('/replies/ticket/{ticket}', function () {
        return view('blade.replies');
    })->name('replies');
});

Route::middleware([
    'isAdmin',
])->group(function () {
    Route::get('/operations/ticket/{ticket}', function () {
        return view('blade.operations');
    })->name('operations');
});