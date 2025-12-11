<?php

use App\Http\Controllers\Public\Cart\{AddCartItemController , DecrementCartItemController , IncrementCartItemController , ShowCartController ,RemoveCartItemController};
use App\Http\Controllers\Public\Cities\IndexCitiesController;
use App\Http\Controllers\Public\Category\CategoriesController;
use App\Http\Controllers\Public\Checkout\CheckoutController;
use App\Http\Controllers\Public\Checkout\PaymentCallbackController;
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
        Route::get('/', ProfileUser::class)->name('show');
        Route::put('/update', UpdateProfile::class)->name('update');
    });
});

Route::prefix('cities')->name('City.')->group(function () {
    Route::get('/', IndexCitiesController::class);
});


Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', ProductsController::class)->name('index');
    Route::get('/{slug}', ShowProductController::class)->name('show');
    Route::get('/Category/{slug}', CategoryProductsController::class)->name('Category');
});


Route::prefix('categories')->name('Category.')->group(function () {
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
    Route::post('/increment/{item}', IncrementCartItemController::class)->name('increment');
    Route::post('/decrement/{item}', DecrementCartItemController::class)->name('decrement');
    Route::delete('/{item}', RemoveCartItemController::class)->name('destroy');
});


Route::middleware('auth:api')->post('/checkout', CheckoutController::class)->name('checkout');


Route::post('/payment/webhook/{gateway}', PaymentCallbackController::class)->name('payment.callback');
