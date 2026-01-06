<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    if (Session::has('admin_id')) {
        return redirect(url('admin/dashboard'));
    }
    return redirect(url('admin/login'));
});


Route::get('/', function () {
    if (Session::has('admin_id')) {
        return redirect(url('admin/dashboard'));
    }
    return redirect(url('admin/login'));
});


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [Admin\Auth\AuthController::class, 'login'])->name('login');
    Route::post('login', [Admin\Auth\AuthController::class, 'loginSubmit'])->name('login.submit');

    Route::get('/register', [Admin\Auth\AuthController::class, 'register']);
    Route::post('register', [Admin\Auth\AuthController::class, 'registerSubmit'])->name('register.submit');

    Route::get('/logout', [Admin\Auth\AuthController::class, 'logout']);

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        });

        // VISA CATEGORY
        Route::resource('visa-category', Admin\VisaCategory\VisaCategoryController::class);

        // OLD MANUAL ROUTES → YOU CAN DELETE (OPTIONAL)
        Route::prefix('visa-category')->group(function () {
            Route::get('list', [Admin\VisaCategory\VisaCategoryController::class, 'index']);
            Route::get('show/{id}',[Admin\VisaCategory\VisaCategoryController::class, 'show']);
            Route::get('create', [Admin\VisaCategory\VisaCategoryController::class, 'create']);
            Route::post('add', [Admin\VisaCategory\VisaCategoryController::class, 'store']);
            Route::get('edit/{id}', [Admin\VisaCategory\VisaCategoryController::class, 'edit']);
            Route::post('update/{id}', [Admin\VisaCategory\VisaCategoryController::class, 'update']);
            Route::delete('delete/{id}', [Admin\VisaCategory\VisaCategoryController::class, 'destroy']);
        });

        // VISA SUB CATEGORY (IMPORTANT)
        Route::resource('visa-sub-category', Admin\VisaCategory\VisaSubCategoryController::class);
    });

});






Route::get('/admin/forgot-password', function () {
    return view('admin.auth.forgot-password');
});


Route::fallback(function () {
    return response()->view('admin.404', [], 404);
});
