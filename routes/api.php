<?php

use App\Http\Controllers\Public\Cart\{AddCartItemController , DecrementCartItemController , IncrementCartItemController , ShowCartController ,RemoveCartItemController};
use App\Http\Controllers\Public\Category\CategoriesController;
use App\Http\Controllers\Public\ContactUs\ContactUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\Product\{CategoryProductsController , ProductsController ,ShowProductController};
use App\Http\Controllers\Auth\{CheckCode, CheckUser, LogoutUser, ProfileUser, SendCode,  UpdateProfile};
use App\Http\Controllers\Public\Feedback\{DestroyFeedbackController , SendFeedbackController};



Route::name('Auth')->group(function () {
    Route::post('/checkUser', CheckUser::class );
    Route::post('/sendCode', SendCode::class );
    Route::post('/checkCode', CheckCode::class );

    Route::name('Profile')->middleware('auth:api')->group(function () {
        Route::post('/logout', LogoutUser::class);
        Route::get('/profile', ProfileUser::class);
        Route::put('/profileUpdate', UpdateProfile::class);
    });


});

Route::name('Product')->prefix('products')->group(function () {
    Route::get('/', ProductsController::class);
    Route::get('/{slug}', ShowProductController::class);
    Route::get('/category/{slug}', CategoryProductsController::class);

});

Route::name('Category')->prefix('categories')->group(function () {
    Route::get('/' , CategoriesController::class);
});

Route::name('Feedback')->middleware('auth:api')->prefix('feedback')->group(function () {
    Route::post('/' , SendFeedbackController::class);
    Route::delete('/{id}' , DestroyFeedbackController::class);
});

Route::name('ContactUs')->prefix('contactUs')->group(function () {
    Route::post('/' , ContactUsController::class);
});

Route::name('Cart')->middleware('auth:api')->prefix('cart')->group(function () {
    Route::get('/', ShowCartController::class);
    Route::post('/', AddCartItemController::class);
    Route::post('/{item}/increment', IncrementCartItemController::class);
    Route::post('/{item}/decrement', DecrementCartItemController::class);
    Route::delete('/{item}', RemoveCartItemController::class);
});



