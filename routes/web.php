<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('dashboard');
});
