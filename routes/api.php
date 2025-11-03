<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{CheckCode, CheckUser, LogoutUser, ProfileUser, SendCode,  UpdateProfile};



Route::name('Auth')->group(function () {
    Route::post('/checkUser', CheckUser::class );
    Route::post('/sendCode', SendCode::class );
    Route::post('/checkCode', CheckCode::class );

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', LogoutUser::class);
        Route::get('/profile', ProfileUser::class);
        Route::put('/profileUpdate', UpdateProfile::class);
    });
});





