<?php

use App\Http\Controllers\Public\Cart\{AddCartItemController , DecrementCartItemController , IncrementCartItemController , ShowCartController ,RemoveCartItemController};
use App\Http\Controllers\Public\Category\CategoriesController;
use App\Http\Controllers\Public\ContactUs\ContactUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\Product\{CategoryProductsController , ProductsController ,ShowProductController};
use App\Http\Controllers\Auth\{CheckCode, CheckUser, LogoutUser, ProfileUser, SendCode,  UpdateProfile};
use App\Http\Controllers\Public\Feedback\{DestroyFeedbackController , SendFeedbackController};


Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/checkUser', CheckUser::class)->name('checkUser');
    Route::post('/sendCode', SendCode::class)->name('sendCode');
    Route::post('/checkCode', CheckCode::class)->name('checkCode');

    Route::middleware('auth:api')->prefix('profile')->name('profile.')->group(function () {
        Route::post('/logout', LogoutUser::class)->name('logout');
        Route::get('/profile', ProfileUser::class)->name('show');
        Route::put('/profileUpdate', UpdateProfile::class)->name('update');
    });
});


Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', ProductsController::class)->name('index');
    Route::get('/{slug}', ShowProductController::class)->name('show');
    Route::get('/category/{slug}', CategoryProductsController::class)->name('category');
});


Route::prefix('categories')->name('category.')->group(function () {
    Route::get('/', CategoriesController::class)->name('index');
});


Route::middleware('auth:api')->prefix('feedback')->name('feedback.')->group(function () {
    Route::post('/', SendFeedbackController::class)->name('store');
    Route::delete('/{id}', DestroyFeedbackController::class)->name('destroy');
});


Route::prefix('contactUs')->name('contactUs.')->group(function () {
    Route::post('/', ContactUsController::class)->name('store');
});


Route::middleware('auth:api')->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', ShowCartController::class)->name('index');
    Route::post('/', AddCartItemController::class)->name('store');
    Route::post('/{item}/increment', IncrementCartItemController::class)->name('increment');
    Route::post('/{item}/decrement', DecrementCartItemController::class)->name('decrement');
    Route::delete('/{item}', RemoveCartItemController::class)->name('destroy');
});


Route::middleware('auth:api')->post('/checkout', \App\Http\Controllers\Public\Checkout\CheckoutController::class)->name('checkout');


Route::post('/payment/webhook/{gateway}', \App\Http\Controllers\Public\Checkout\PaymentCallbackController::class)->name('payment.callback');
