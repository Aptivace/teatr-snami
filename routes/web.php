<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AfishaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\SpectacleController;
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

        Route::post('/afishes', [AfishaController::class, 'store']);
        Route::get('/afishes/create', [AfishaController::class, 'create']);
        Route::get('/afishes/{afisha}/edit', [AfishaController::class, 'edit']);
        Route::patch('/afishes/{afisha}/edit', [AfishaController::class, 'update']);
        Route::delete('/afishes/{afisha}/remove', [AfishaController::class, 'destroy']);

        Route::get('/spectacles', [SpectacleController::class, 'admin']);
        Route::post('/spectacles', [SpectacleController::class, 'store']);
        Route::get('/spectacles/create', [SpectacleController::class, 'create']);
        Route::get('/spectacles/{spectacle}/edit', [SpectacleController::class, 'edit']);
        Route::patch('/spectacles/{spectacle}/edit', [SpectacleController::class, 'update']);
        Route::delete('/spectacles/{spectacle}/remove', [SpectacleController::class, 'destroy']);

        Route::get('/rewards', [RewardController::class, 'admin']);
        Route::post('/rewards', [RewardController::class, 'store']);
        Route::get('/rewards/create', [RewardController::class, 'create']);
        Route::get('/rewards/{reward}/edit', [RewardController::class, 'edit']);
        Route::patch('/rewards/{reward}/edit', [RewardController::class, 'update']);
        Route::delete('/rewards/{reward}/remove', [RewardController::class, 'destroy']);

        Route::get('/members', [MemberController::class, 'admin']);
        Route::post('/members', [MemberController::class, 'store']);
        Route::get('/members/create', [MemberController::class, 'create']);
        Route::get('/members/{member}/edit', [MemberController::class, 'edit']);
        Route::patch('/members/{member}/edit', [MemberController::class, 'update']);
        Route::delete('/members/{member}/remove', [MemberController::class, 'destroy']);


        Route::get('/reviews', function () {
            return view('admin-reviews');
        });
    });
});


