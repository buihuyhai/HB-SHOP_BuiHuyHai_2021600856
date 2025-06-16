<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
})->name("home.index");
Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name("logout");



