<?php

use App\Http\Controllers\admin\AdminChangelogController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\student\PastTestsController;
use App\Http\Controllers\student\VerificationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\teacher\TeacherAnswerController;
use App\Http\Controllers\teacher\TeacherQuestionController;
use App\Http\Controllers\teacher\TeacherTestController;
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

Route::group(['auth:sanctum', 'verified'], function() {

    Route::get('/home', [HomeController::class, 'checkUserType'])->name('home');

    //Access Subjects functions
    Route::resource('/subjects', SubjectController::class);

    Route::resource('/module', ModuleController::class);


    Route::controller(FileUploadController::class)->group(function () {

        Route::get('/download/{name}/{id}','download')->name('file-download');

        Route::get('/view/{name}/{id}','view')->name('file-view');

        Route::post('/file-upload', 'store')->name('file-upload');

        Route::post('/file-delete/{id}', 'destroy')->name('file-delete');

        Route::post('/file-edit/{id}', 'update')->name('file-edit');
    });


    //user only routes
    Route::group(['middleware' => 'is_user:user'], function () {

        Route::get('/user/dashboard', function (){
            return view('student/dashboard');
        })->name('user.dashboard');

        Route::get('/user/verification', function (){
            return view('student/request-verification');
        })->name('user.verification');

        Route::post('/user/verification',[VerificationController::class, 'store'])->name('user-verify');

        Route::resource('/past-tests',PastTestsController::class);

    });

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


    //teacher only routes
    Route::group(['middleware' => 'is_teacher:teacher'], function () {

        Route::get('/teacher/dashboard', function (){
            return view('teacher/teacher-dashboard');
        })->name('teacher.dashboard');

        //teacher test creation controllers
        Route::resource('/teacher-tests',TeacherTestController::class);
        Route::resource('/teacher-question',TeacherQuestionController::class);
        Route::resource('/teacher-answer',TeacherAnswerController::class);

    });


});
