<?php


/*
|--------------------------------------------------------------------------
| CRUD Resource Macro
|--------------------------------------------------------------------------
|
| This macro allows you to define all the standard CRUD routes for a resource
| (index, show, store, update, delete) in a single line. It also allows
| adding extra custom routes through the $extra callback.
|
| Parameters:
| - $prefix: The URL prefix for the resource routes.
| - $name: The name prefix for route names (e.g., 'product.').
| - $resourceSingular: The singular name of the resource (e.g., 'Product').
| - $extra: Optional closure for additional routes beyond standard CRUD.
| - $param: Optional route parameter name (defaults to lowercase resource name).
|
| Features:
| - Automatically checks if each controller class exists before defining the route.
| - Supports Route Model Binding by naming route parameters according to the model.
| - Allows custom extra routes via the $extra callback.
|
*/
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

Route::macro('crudResource', function (
    string $prefix,
    string $name,
    string $resourceSingular,
    ?callable $extra = null,
    string $param = 'id',
    ?string $namespace = null
) {
    $namespace = $namespace ?? 'App\\Http\\Controllers\\Admin\\' . $resourceSingular;
    $resourcePlural = Str::pluralStudly($resourceSingular);

    Route::prefix($prefix)->name($name)->group(function () use ($namespace, $resourceSingular, $resourcePlural, $extra, $param) {
        $map = [
            'index'  => ['verb' => 'get',    'uri' => '/',              'class' => "Index{$resourcePlural}Controller", 'binding' => false],
            'store'  => ['verb' => 'post',   'uri' => '/',              'class' => "Store{$resourceSingular}Controller", 'binding' => false],
            'show'   => ['verb' => 'get',    'uri' => "/{{$param}}",    'class' => "Show{$resourceSingular}Controller", 'binding' => true],
            'update' => ['verb' => 'put',    'uri' => "/{{$param}}",    'class' => "Update{$resourceSingular}Controller", 'binding' => true],
            'delete' => ['verb' => 'delete', 'uri' => "/{{$param}}",    'class' => "Delete{$resourceSingular}Controller", 'binding' => true],
        ];

        foreach ($map as $action => $info) {
            $class = $namespace . '\\' . $info['class'];
            if (class_exists($class)) {
                if ($info['binding']) {
                    Route::{$info['verb']}($info['uri'], $class)
                        ->where($param, '[0-9]+'); // فقط where برای id
                } else {
                    Route::{$info['verb']}($info['uri'], $class);
                }
            } else {
                Log::warning("CRUD Resource: Controller {$class} برای {$action} یافت نشد.");
            }
        }


        if ($extra) {
            $extra();
        }
    });
});
