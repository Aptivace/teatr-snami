<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

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
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/login', [AdminController::class, 'login']);

    Route::middleware(CheckAdmin::class)->group(function () {
        Route::post("/logout", [AdminController::class, 'logout']);

        Route::get('/team', function () {
            return view('admin-members');
        });

        Route::get('/reviews', function () {
            return view('admin-reviews');
        });
    });
});


