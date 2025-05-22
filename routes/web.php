<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function () 
{
    return view('auth.login');
} );
Route::middleware([
    'authLogin'
])->group(function () {
    Route::get('/home', function () {
        return view('blade.home');
    })->name('home');
    
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