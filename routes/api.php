<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//route login
Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'index']);

//group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function() {

    //logout
    Route::post('/logout', [\App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);
    
});

// group route with prefix "admin"
Route::prefix('admin')->group(function () {
    // group route with middleware "auth:api"
    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        // dashboard
        Route::get('/dashboard', App\Http\Controllers\Api\Admin\DashboardController::class);
    
        // permissions
        Route::get('/permissions', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'index'])
        ->middleware('permission:permissions.index');

        // permissions all
        Route::get('/permissions/all', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'all'])
        ->middleware('permission:permissions.index');

        // roles all
        Route::get('/roles/all', [\App\Http\Controllers\Api\Admin\RoleController::class, 'all'])
        ->middleware('permission:roles.index');

        // roles
        Route::get('/roles', App\Http\Controllers\Api\Admin\RoleController::class)
        ->middleware('permission:roles.index');
    });
});
