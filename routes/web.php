<?php

use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', [HomeController::class, 'checkUserType'])->name('home');

    //admin only routes
    Route::group(['middleware' => 'is_admin:admin'], function () {

        Route::get('/admin/dashboard', function () {
            return view('admin/admin-dashboard');
        })->name('admin.dashboard');

        Route::resource('/admin/users', AdminUserController::class)->name('index', 'admin.users');
        Route::resource('/admin/user/update', AdminUserController::class)->name('update', 'admin.users.update');

    });

    //user only routes
    Route::group(['middleware' => 'is_user:user'], function () {

        Route::get('/user/dashboard', function (){
            return view('student/dashboard');
        })->name('user.dashboard');


    });

    //teacher only routes
    Route::group(['middleware' => 'is_teacher:teacher'], function () {

        Route::get('/teacher/dashboard', function (){
            return view('teacher/teacher-dashboard');
        })->name('teacher.dashboard');


    });


});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
