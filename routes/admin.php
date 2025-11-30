<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\{UsersController, UserController, DeleteUserController, UserStatusController};
use App\Http\Controllers\Admin\ContactUs\{IndexContactUsController, ContactUsController, DeleteContactUsController};
use App\Http\Controllers\Admin\Feedback\{FeedbacksController, FeedbackController, ApproveFeedbackController, DeleteFeedbackController};
use App\Http\Controllers\Admin\Media\{DeleteMediaController,StoreMediaController};
use App\Http\Controllers\Admin\Option\{DeleteOptionDetailController, OptionsController, OptionController, StoreOptionController, StoreOptionDetailController, UpdateOptionController, DeleteOptionController, UpdateOptionDetailController};
use App\Http\Controllers\Admin\Product\{DeleteProductController, ProductController, ProductsController, StoreProductController, UpdateProductController};
use App\Http\Controllers\Admin\Category\{CategoriesController, CategoryController, DeleteCategoryController, StoreCategoryController, UpdateCategoryController};
use App\Http\Controllers\Admin\Order\{OrdersController,OrderController , StoreOrderController  , DeleteOrderController , UpdateOrderStatusController};



Route::prefix('categories')->name('Category.')->group(function () {
    Route::get('/', CategoriesController::class);
    Route::get('/{id}', CategoryController::class);
    Route::post('/', StoreCategoryController::class);
    Route::put('/{id}', UpdateCategoryController::class);
    Route::delete('/{id}', DeleteCategoryController::class);
});

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', ProductsController::class);
    Route::get('/{id}', ProductController::class);
    Route::post('/', StoreProductController::class);
    Route::put('/{id}', UpdateProductController::class);
    Route::delete('/{id}', DeleteProductController::class);
});


Route::prefix('products/{product}/media')->name('product.media.')->group(function () {
    Route::post('/', StoreMediaController::class);
    Route::delete('/{media}', DeleteMediaController::class);
});


Route::prefix('options')->name('option.')->group(function () {
    Route::get('/', OptionsController::class);
    Route::get('/{id}', OptionController::class);
    Route::post('/', StoreOptionController::class);
    Route::put('/{id}', UpdateOptionController::class);
    Route::delete('/{id}', DeleteOptionController::class);

    //details
    Route::post('/detail' , StoreOptionDetailController::class);
    Route::put('/detail/{id}', UpdateOptionDetailController::class);
    Route::delete('/detail/{id}', DeleteOptionDetailController::class);
});


Route::prefix('feedbacks')->name('feedback.')->group(function () {
    Route::get('/', FeedbacksController::class);
    Route::get('/{id}', FeedbackController::class);
    Route::patch('/{id}/approve', ApproveFeedbackController::class);
    Route::delete('/{id}', DeleteFeedbackController::class);
});

Route::prefix('contactUs')->name('contactUs.')->group(function () {
    Route::get('/', IndexContactUsController::class);
    Route::get('/{id}', ContactUsController::class);
    Route::delete('/{id}', DeleteContactUsController::class);
});

Route::prefix('users')->name('user.')->group(function () {
    Route::get('/', UsersController::class);
    Route::get('/{id}', UserController::class);
    Route::delete('/{id}', DeleteUserController::class);
    Route::patch('/{id}/status', UserStatusController::class);
});


Route::prefix('orders')->name('order.')->group(function () {
    Route::get('/', OrdersController::class);
    Route::get('/{id}', OrderController::class);
    Route::post('/', StoreOrderController::class);
    Route::delete('/{id}', DeleteOrderController::class);
    Route::post('/{id}/status', UpdateOrderStatusController::class);
});


