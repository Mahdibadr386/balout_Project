<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Payment\{IndexPaymentsController, ShowPaymentController};
use App\Http\Controllers\Admin\User\{IndexUsersController, ShowUserController, DeleteUserController, UserStatusController};
use App\Http\Controllers\Admin\ContactUs\{IndexContactUsController, ShowContactUsController, DeleteContactUsController};
use App\Http\Controllers\Admin\Feedback\{IndexFeedbacksController, ShowFeedbackController, ApproveFeedbackController, DeleteFeedbackController};
use App\Http\Controllers\Admin\Media\{DeleteMediaController,StoreMediaController};
use App\Http\Controllers\Admin\Option\{DeleteOptionDetailController, IndexOptionsController, ShowOptionController, StoreOptionController, StoreOptionDetailController, UpdateOptionController, DeleteOptionController, UpdateOptionDetailController};
use App\Http\Controllers\Admin\Product\{DeleteProductController, ShowProductController, IndexProductsController, StoreProductController, UpdateProductController};
use App\Http\Controllers\Admin\Category\{IndexCategoriesController, ShowCategoryController, DeleteCategoryController, StoreCategoryController, UpdateCategoryController};
use App\Http\Controllers\Admin\Order\{IndexOrdersController,ShowOrderController , StoreOrderController  , DeleteOrderController , UpdateOrderStatusController};



Route::prefix('categories')->name('Category.')->group(function () {
    Route::get('/', IndexCategoriesController::class);
    Route::get('/{id}', ShowCategoryController::class);
    Route::post('/', StoreCategoryController::class);
    Route::put('/{id}', UpdateCategoryController::class);
    Route::delete('/{id}', DeleteCategoryController::class);
});

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', IndexProductsController::class);
    Route::get('/{id}', ShowProductController::class);
    Route::post('/', StoreProductController::class);
    Route::put('/{id}', UpdateProductController::class);
    Route::delete('/{id}', DeleteProductController::class);
});


Route::prefix('products/{product}/media')->name('product.media.')->group(function () {
    Route::post('/', StoreMediaController::class);
    Route::delete('/{media}', DeleteMediaController::class);
});


Route::prefix('options')->name('option.')->group(function () {
    Route::get('/', IndexOptionsController::class);
    Route::get('/{id}', ShowOptionController::class);
    Route::post('/', StoreOptionController::class);
    Route::put('/{id}', UpdateOptionController::class);
    Route::delete('/{id}', DeleteOptionController::class);

    //details
    Route::post('/detail' , StoreOptionDetailController::class);
    Route::put('/detail/{id}', UpdateOptionDetailController::class);
    Route::delete('/detail/{id}', DeleteOptionDetailController::class);
});


Route::prefix('feedbacks')->name('feedback.')->group(function () {
    Route::get('/', IndexFeedbacksController::class);
    Route::get('/{id}', ShowFeedbackController::class);
    Route::patch('/{id}/approve', ApproveFeedbackController::class);
    Route::delete('/{id}', DeleteFeedbackController::class);
});

Route::prefix('contactUs')->name('contactUs.')->group(function () {
    Route::get('/', IndexContactUsController::class);
    Route::get('/{id}', ShowContactUsController::class);
    Route::delete('/{id}', DeleteContactUsController::class);
});

Route::prefix('users')->name('user.')->group(function () {
    Route::get('/', IndexUsersController::class);
    Route::get('/{id}', ShowUserController::class);
    Route::delete('/{id}', DeleteUserController::class);
    Route::patch('/{id}/status', UserStatusController::class);
});


Route::prefix('orders')->name('order.')->group(function () {
    Route::get('/', IndexOrdersController::class);
    Route::get('/{id}', ShowOrderController::class);
    Route::post('/', StoreOrderController::class);
    Route::delete('/{id}', DeleteOrderController::class);
    Route::post('/{id}/status', UpdateOrderStatusController::class);
});



Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', IndexPaymentsController::class)->name('index');
    Route::get('/{id}', ShowPaymentController::class)->name('show');
});
