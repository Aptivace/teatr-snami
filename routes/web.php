<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/afisha', function () {
    return view('afisha');
});

Route::get('/members', function () {
    return view('members');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/repertuar', function () {
    return view('repertoire');
});

Route::prefix("/admin")->group(function () {
    Route::get('login', function () {
        return view('admin-login');
    });

    Route::middleware(CheckAdmin::class)->group(function () {
        Route::get('/team', function () {
            return view('admin-members');
        });

        Route::get('/reviews', function () {
            return view('admin-reviews');
        });

        Route::get('/afisha', function () {
            return view('admin-afisha');
        });
    });
});


