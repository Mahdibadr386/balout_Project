<?php

use App\Http\Controllers\Admin\Customer\{DeleteCustomerController,IndexCustomerController,SendSmsCustomerController, UpdateCustomerController ,StoreCustomerController ,StatusCustomerController ,ShowCustomerController};
use App\Http\Controllers\Admin\Permission\{ IndexPermissionController, ShowPermissionController};
use App\Http\Controllers\Admin\Role\{AssignRoleToUserController, DeleteRoleController, IndexRoleController, ShowRoleController, StoreRoleController, UpdateRoleController};
use App\Http\Controllers\Admin\Payment\{IndexPaymentsController, ShowPaymentController};
use App\Http\Controllers\Admin\User\{IndexUsersController, SendSmsUserController, ShowUserController, DeleteUserController, StoreUserController, UpdateUserController, UserStatusController};
use App\Http\Controllers\Admin\ContactUs\{IndexContactUsController, ShowContactUsController, DeleteContactUsController};
use App\Http\Controllers\Admin\Feedback\{IndexFeedbacksController, ShowFeedbackController, ApproveFeedbackController, DeleteFeedbackController};
use App\Http\Controllers\Admin\Option\{DeleteOptionDetailController, IndexOptionsController, ShowOptionController, StoreOptionController, StoreOptionDetailController, UpdateOptionController, DeleteOptionController, UpdateOptionDetailController};
use App\Http\Controllers\Admin\Product\{ActiveStatusProductController, DeleteProductController, PinProductController, ShowProductController, IndexProductsController, StoreProductController, UpdateProductController};
use App\Http\Controllers\Admin\Category\{GetCategoryOptionsController, IndexCategoriesController, ShowCategoryController, DeleteCategoryController, StoreCategoryController, UpdateCategoryController};
use App\Http\Controllers\Admin\Order\{IndexOrdersController,ShowOrderController , StoreOrderController  , DeleteOrderController , UpdateOrderStatusController};
use Illuminate\Support\Facades\Route;


Route::prefix('categories')->name('Category.')->group(function () {
    Route::get('/', IndexCategoriesController::class)->middleware('permission:category.index');
    Route::get('/{id}', ShowCategoryController::class)->middleware('permission:category.show');
    Route::post('/', StoreCategoryController::class)->middleware('permission:category.store');
    Route::put('/{id}', UpdateCategoryController::class)->middleware('permission:category.update');
    Route::delete('/{id}', DeleteCategoryController::class)->middleware('permission:category.delete');
    Route::get('/options/{id}', GetCategoryOptionsController::class)->middleware('permission:category.options');
});


Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', IndexProductsController::class)->middleware('permission:product.index');
    Route::get('/{id}', ShowProductController::class)->middleware('permission:product.show');
    Route::post('/', StoreProductController::class)->middleware('permission:product.store');
    Route::put('/{id}', UpdateProductController::class)->middleware('permission:product.update');
    Route::patch('/{id}', ActiveStatusProductController::class)->middleware('permission:product.change_status');
    Route::delete('/{id}', DeleteProductController::class)->middleware('permission:product.delete');
    Route::patch('/pin/{id}', PinProductController::class)->middleware('permission:product.pin');
});


Route::prefix('options')->name('option.')->group(function () {
    Route::get('/', IndexOptionsController::class)->middleware('permission:option.index');
    Route::get('/{id}', ShowOptionController::class)->middleware('permission:option.show');
    Route::post('/', StoreOptionController::class)->middleware('permission:option.store');
    Route::put('/{id}', UpdateOptionController::class)->middleware('permission:option.update');
    Route::delete('/{id}', DeleteOptionController::class)->middleware('permission:option.delete');

    //details
    Route::post('/detail', StoreOptionDetailController::class)->middleware('permission:option.detail.store');
    Route::put('/detail/{id}', UpdateOptionDetailController::class)->middleware('permission:option.detail.update');
    Route::delete('/detail/{id}', DeleteOptionDetailController::class)->middleware('permission:option.detail.delete');
});


Route::prefix('feedbacks')->name('feedback.')->group(function () {
    Route::get('/', IndexFeedbacksController::class)->middleware('permission:feedback.index');
    Route::get('/{id}', ShowFeedbackController::class)->middleware('permission:feedback.show');
    Route::patch('/approve/{id}', ApproveFeedbackController::class)->middleware('permission:feedback.approve');
    Route::delete('/{id}', DeleteFeedbackController::class)->middleware('permission:feedback.delete');
});


Route::prefix('contactUs')->name('contactUs.')->group(function () {
    Route::get('/', IndexContactUsController::class)->middleware('permission:contact_us.index');
    Route::get('/{id}', ShowContactUsController::class)->middleware('permission:contact_us.show');
    Route::delete('/{id}', DeleteContactUsController::class)->middleware('permission:contact_us.delete');
});


Route::prefix('users')->name('user.')->group(function () {
    Route::get('/', IndexUsersController::class)->middleware('permission:user.index');
    Route::get('/{id}', ShowUserController::class)->middleware('permission:user.show');
    Route::delete('/{id}', DeleteUserController::class)->middleware('permission:user.delete');
    Route::patch('/{id}', UserStatusController::class)->middleware('permission:user.change_status');
    Route::post('/', StoreUserController::class)->middleware('permission:user.store');
    Route::put('/{id}', UpdateUserController::class)->middleware('permission:user.update');
    Route::post('/sms/{id}', SendSmsUserController::class)->middleware('permission:user.send_sms');
});

Route::prefix('orders')->name('order.')->group(function () {
    Route::get('/', IndexOrdersController::class)->middleware('permission:order.index');
    Route::get('/{id}', ShowOrderController::class)->middleware('permission:order.show');
    Route::post('/', StoreOrderController::class)->middleware('permission:order.store');
    Route::delete('/{id}', DeleteOrderController::class)->middleware('permission:order.delete');
    Route::post('/status/{id}', UpdateOrderStatusController::class)->middleware('permission:order.update_status');
});


Route::prefix('permissions')->name('permission.')->group(function () {
    Route::get('/', IndexPermissionController::class)->middleware('permission:permission.index');
    Route::get('/{id}', ShowPermissionController::class)->middleware('permission:permission.show');
});


Route::prefix('roles')->name('role.')->group(function () {
    Route::get('/', IndexRoleController::class)->middleware('permission:role.index');
    Route::get('/{id}', ShowRoleController::class)->middleware('permission:role.show');
    Route::post('/', StoreRoleController::class)->middleware('permission:role.store');
    Route::put('/{role}', UpdateRoleController::class)->middleware('permission:role.update');
    Route::delete('/{role}', DeleteRoleController::class)->middleware('permission:role.delete');
    Route::post('/assign/{role}', AssignRoleToUserController::class)->middleware('permission:role.assign');
});


Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', IndexPaymentsController::class)->middleware('permission:payment.index');
    Route::get('/{id}', ShowPaymentController::class)->middleware('permission:payment.show');
});


Route::prefix('customers')->name('customer.')->group(function () {
    Route::get('/', IndexCustomerController::class)->middleware('permission:customer.index');
    Route::get('/{id}', ShowCustomerController::class)->middleware('permission:customer.show');
    Route::delete('/{id}', DeleteCustomerController::class)->middleware('permission:customer.delete');
    Route::patch('/{id}', StatusCustomerController::class)->middleware('permission:customer.change_status');
    Route::post('/', StoreCustomerController::class)->middleware('permission:customer.store');
    Route::put('/{id}', UpdateCustomerController::class)->middleware('permission:customer.update');
    Route::post('/sms/{id}', SendSmsCustomerController::class)->middleware('permission:customer.send_sms');
});


