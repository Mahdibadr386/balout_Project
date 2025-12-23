<?php

use App\Http\Controllers\Admin\Category\GetCategoryOptionsController;
use App\Http\Controllers\Admin\Discount\CodeDiscountController;
use App\Http\Controllers\Admin\Discount\UsageDiscountController;
use App\Http\Controllers\Admin\Customer\{SendSmsCustomerController, StatusCustomerController };
use App\Http\Controllers\Admin\Role\{AssignRoleToUserController};
use App\Http\Controllers\Admin\User\{ SendSmsUserController,  UserStatusController};
use App\Http\Controllers\Admin\Feedback\{ApproveFeedbackController};
use App\Http\Controllers\Admin\Option\{DeleteOptionDetailController,  StoreOptionDetailController, UpdateOptionDetailController};
use App\Http\Controllers\Admin\Product\{ActiveStatusProductController,  PinProductController};
use App\Http\Controllers\Admin\Order\{UpdateOrderStatusController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Example usage of the crudResource macro
|--------------------------------------------------------------------------
|
| This example defines all CRUD routes for the 'Product' resource.
| Additional custom routes (PATCH for status and pin) are added via $extra.
|
*/
require base_path('app/Support/RouteMacros.php');

// Categories
Route::crudResource('categories', 'Category', 'Category', function () {
    Route::get('/options/{category}', GetCategoryOptionsController::class);
});

// Products
Route::crudResource('products', 'product', 'Product', function () {
    Route::patch('/{product}', ActiveStatusProductController::class);
    Route::patch('/pin/{product}', PinProductController::class);
});

// Options
Route::crudResource('options', 'option', 'Option', function () {
    // details
    Route::post('/detail', StoreOptionDetailController::class);
    Route::put('/detail/{detail}', UpdateOptionDetailController::class);
    Route::delete('/detail/{detail}', DeleteOptionDetailController::class);
});

// Feedbacks
Route::crudResource('feedbacks', 'feedback', 'Feedback', function () {
    Route::patch('/approve/{feedback}', ApproveFeedbackController::class);
});

// Contact Us
Route::crudResource('contactUs', 'contactUs', 'ContactUs');

// Users
Route::crudResource('users', 'user', 'User', function () {
    Route::patch('/{user}', UserStatusController::class);
    Route::post('/sms/{user}', SendSmsUserController::class);
});

// Orders
Route::crudResource('orders', 'order', 'Order', function () {
    Route::post('/status/{order}', UpdateOrderStatusController::class);
});

// Permissions
Route::crudResource('permissions', 'permission', 'Permission');

// Roles
Route::crudResource('roles', 'role', 'Role', function () {
    Route::post('/assign/{role}', AssignRoleToUserController::class);
});

// Payments
Route::crudResource('payments', 'payments', 'Payment');

// Customers
Route::crudResource('customers', 'customer', 'Customer', function () {
    Route::patch('/{customer}', StatusCustomerController::class);
    Route::post('/sms/{customer}', SendSmsCustomerController::class);
});

//Discount
Route::crudResource('discounts', 'discount', 'Discount', function () {
    Route::get('/usages', UsageDiscountController::class)->name('usages');
    Route::post('/codes/{discount}', CodeDiscountController::class)->name('codes');
});



