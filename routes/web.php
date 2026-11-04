<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/profile', function () {
    return view('Profile');
});
Route::get('/attendance-history', function () {
    return view('attendance-history');
});
Route::get('/leave-requests', function () {
    return view('leave-requests');
});
