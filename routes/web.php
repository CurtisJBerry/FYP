<?php

use App\Http\Controllers\admin\AdminChangelogController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UploadController;
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

    //Access Subjects functions
    Route::resource('/subjects', SubjectController::class);

    Route::resource('/module', ModuleController::class);

    Route::post('/upload', [UploadController::class, 'store'])->name('upload');
    Route::get('/download{name}', [UploadController::class, 'download'])->name('download');


    //admin only routes
    Route::group(['middleware' => 'is_admin:admin'], function () {

        Route::get('/admin/dashboard', function () {
            return view('admin/admin-dashboard');
        })->name('admin.dashboard');


        Route::resource('/admin-users',AdminUserController::class);
        Route::post('/user-update',[AdminUserController::class, 'store'])->name('user-update');

        Route::resource('/verification', AdminVerificationController::class);
        Route::resource('/changelog', AdminChangelogController::class);

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
