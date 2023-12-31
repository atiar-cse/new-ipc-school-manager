<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Admin\GroupController;
use App\Http\Controllers\Api\Admin\SchoolController;
use App\Http\Controllers\Api\Admin\BookCategoryController;
use App\Http\Controllers\Api\Admin\BookController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\SchoolCategoryController;

use App\Http\Controllers\Api\SchoolManager\TeacherController;
use App\Http\Controllers\Api\SchoolManager\FamilyController;
use App\Http\Controllers\Api\SchoolManager\ClassController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')->group(function () {
    /** ======================================================
     *      1. User Routes
     * ====================================================== */
    Route::prefix('/users')->group(function () {
        /* Login route */
        Route::post('/login', [LoginController::class, 'store'])->name("users.login");
        // Route::post('/register', [RegisterController::class, 'saveUser'])->name("users.register");
        // Route::post('/check-email', [ResetPasswordController::class, 'setCode'])->name("users.check_email");
        // Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name("users.reset_password");
    });

    /** ======================================================
     *      2. Auth Routes
     * ====================================================== */
    Route::middleware('auth:sanctum')->group(function () {
        /* auth:sanctum user routes */
        Route::prefix('/users')->group(function () {
            Route::get('/me', [UserController::class, 'me']);
        });
    });

    /** ======================================================
     *      2.1. Schools admin (later on it have to move into auth middleware)
     * ====================================================== */
    Route::prefix('/admin')->group(function () {
        Route::apiResource('/groups', GroupController::class);
        Route::apiResource('/schools', SchoolController::class);
        Route::apiResource('/books/category', BookCategoryController::class);
        Route::get('/books/category-dropdown-list', [BookCategoryController::class, 'getCategoryDropdownList']);
        Route::apiResource('/books', BookController::class);
        Route::apiResource('/roles', RoleController::class);
        Route::apiResource('/users', UserController::class);
    });
    //School Manager
    Route::prefix('/school-admin')->group(function () {
        Route::get('/teachers/getTeachersBySchool', [TeacherController::class, 'getTeachersBySchool'])->name("teachers.getTeachersBySchool");
        Route::apiResource('/teachers', TeacherController::class);
        Route::get('/families/trashed', [FamilyController::class, 'transedFamilies'])->name("families.trashed");
        Route::get('/families/restore', [FamilyController::class, 'restore'])->name("families.restore");
        Route::apiResource('/families', FamilyController::class);
        Route::get('/classes/get', [FamilyController::class, 'restore'])->name("families.restore");
        Route::apiResource('/classes',  ClassController::class);
    });
});

Route::get('/clear-cache-all', function () {
    Artisan::call('cache:clear');
    Artisan::call("config:cache");
    die('Cache Cleared All');
});
