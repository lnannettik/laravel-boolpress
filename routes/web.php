<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//ROTTE PER AUTENTICAZIONE
Auth::routes();


//ROTTE PER AREA ADMIN
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {

        //Admin homepage
        Route::get('/', 'HomeController@index')->name('home'); // Admin

        // Posts resource routes
        Route::resource('/posts', 'PostController');

    });



// FRONT OFFICE - MESSA COME ULTIMA ROUTE !!!!!!!!!!!!!!!!
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
