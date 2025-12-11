<?php

use App\Http\Controllers\Admin\Customer\{DeleteCustomerController,IndexCustomerController,SendSmsCustomerController, UpdateCustomerController ,StoreCustomerController ,StatusCustomerController ,ShowCustomerController};
use App\Http\Controllers\Admin\Permission\{DeletePermissionController, IndexPermissionController, ShowPermissionController, StorePermissionController, UpdatePermissionController};
use App\Http\Controllers\Admin\Role\{AssignRoleToUserController, DeleteRoleController, IndexRoleController, ShowRoleController, StoreRoleController, UpdateRoleController};
use App\Http\Controllers\Admin\Payment\{IndexPaymentsController, ShowPaymentController};
use App\Http\Controllers\Admin\User\{IndexUsersController, SendSmsUserController, ShowUserController, DeleteUserController, StoreUserController, UpdateUserController, UserStatusController};
use App\Http\Controllers\Admin\ContactUs\{IndexContactUsController, ShowContactUsController, DeleteContactUsController};
use App\Http\Controllers\Admin\Feedback\{IndexFeedbacksController, ShowFeedbackController, ApproveFeedbackController, DeleteFeedbackController};
use App\Http\Controllers\Admin\Media\{DeleteMediaController,StoreMediaController};
use App\Http\Controllers\Admin\Option\{DeleteOptionDetailController, IndexOptionsController, ShowOptionController, StoreOptionController, StoreOptionDetailController, UpdateOptionController, DeleteOptionController, UpdateOptionDetailController};
use App\Http\Controllers\Admin\Product\{ActiveStatusProductController, DeleteProductController, PinProductController, ShowProductController, IndexProductsController, StoreProductController, UpdateProductController};
use App\Http\Controllers\Admin\Category\{GetCategoryOptionsController, IndexCategoriesController, ShowCategoryController, DeleteCategoryController, StoreCategoryController, UpdateCategoryController};
use App\Http\Controllers\Admin\Order\{IndexOrdersController,ShowOrderController , StoreOrderController  , DeleteOrderController , UpdateOrderStatusController};
use Illuminate\Support\Facades\Route;




Route::prefix('categories')->name('Category.')->group(function () {
    Route::get('/', IndexCategoriesController::class);
    Route::get('/{id}', ShowCategoryController::class);
    Route::post('/', StoreCategoryController::class);
    Route::put('/{id}', UpdateCategoryController::class);
    Route::delete('/{id}', DeleteCategoryController::class);
    Route::get('/options/{id}' , GetCategoryOptionsController::class);
});

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', IndexProductsController::class);
    Route::get('/{id}', ShowProductController::class);
    Route::post('/', StoreProductController::class);
    Route::put('/{id}', UpdateProductController::class);
    Route::patch('/{id}', ActiveStatusProductController::class);
    Route::delete('/{id}', DeleteProductController::class);
    Route::patch('/pin/{id}', PinProductController::class);
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
    Route::patch('/approve/{id}', ApproveFeedbackController::class);
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
    Route::patch('/{id}', UserStatusController::class);
    Route::post('/', StoreUserController::class);
    Route::put('/{id}', UpdateUserController::class);
    Route::post('/sms/{id}' , SendSmsUserController::class);
});


Route::prefix('orders')->name('order.')->group(function () {
    Route::get('/', IndexOrdersController::class);
    Route::get('/{id}', ShowOrderController::class);
    Route::post('/', StoreOrderController::class);
    Route::delete('/{id}', DeleteOrderController::class);
    Route::post('/status/{id}', UpdateOrderStatusController::class);
});


Route::prefix('permissions')->name('permission.')->group(function () {
    Route::get('/', IndexPermissionController::class);
    Route::get('/{id}', ShowPermissionController::class);
    Route::post('/', StorePermissionController::class);
    Route::put('/{permission}', UpdatePermissionController::class);
    Route::delete('/{permission}', DeletePermissionController::class);
});


Route::prefix('roles')->name('role.')->group(function () {
    Route::get('/', IndexRoleController::class);
    Route::get('/{id}', ShowRoleController::class);
    Route::post('/', StoreRoleController::class);
    Route::put('/{role}', UpdateRoleController::class);
    Route::delete('/{role}', DeleteRoleController::class);

    // assign role to users
    Route::post('/assign/{role}', AssignRoleToUserController::class);
});


Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', IndexPaymentsController::class)->name('index');
    Route::get('/{id}', ShowPaymentController::class)->name('show');
});


Route::prefix('customers')->name('customer.')->group(function () {
    Route::get('/', IndexCustomerController::class);
    Route::get('/{id}', ShowCustomerController::class);
    Route::delete('/{id}', DeleteCustomerController::class);
    Route::patch('/{id}', StatusCustomerController::class);
    Route::post('/', StoreCustomerController::class);
    Route::put('/{id}', UpdateCustomerController::class);
    Route::post('/sms/{id}' , SendSmsCustomerController::class);
});
