<?php

use App\Http\Controllers\admin\AdminChangelogController;
use App\Http\Controllers\admin\AdminProcessAllUserData;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\student\LearnerTypeTestController;
use App\Http\Controllers\student\PastTestsController;
use App\Http\Controllers\student\ProcessViewingDataController;
use App\Http\Controllers\student\ProcessViewingDataControllers;
use App\Http\Controllers\student\StudentTestController;
use App\Http\Controllers\student\VerificationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\SubModuleController;
use App\Http\Controllers\teacher\TeacherAnswerController;
use App\Http\Controllers\teacher\TeacherQuestionController;
use App\Http\Controllers\teacher\TeacherTestController;
use App\Models\SubModule;
use App\Models\Test;
use App\Models\User;
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

    Route::resource('/submodule', SubModuleController::class);

    Route::get('/submodule/show/{submodule}/{showall}/{module}',[SubModuleController::class, 'show'])->name('/sub.show');


    //File routes
    Route::controller(FileUploadController::class)->group(function () {

        Route::get('/download/{name}/{id}','download')->name('file-download');

        Route::get('/view/{name}/{id}','view')->name('file-view');

        Route::post('/file-upload', 'store')->name('file-upload');

        Route::post('/file-delete/{id}', 'destroy')->name('file-delete');

        Route::post('/file-edit/{id}', 'update')->name('file-edit');
    });

    Route::get('/process-data/{id}',[ProcessViewingDataController::class, '__invoke'])->name('process-data.invoke');


    //user only routes
    Route::group(['middleware' => 'is_user:user'], function () {

        Route::get('/user/dashboard', function (){
            $learnertest = Test::where('test_name', "Learner Type")->first();
            $tests = Test::with('submodule.module.subject')->whereNotNull('submodule_id')->orderBy('test_name')->paginate(5);

            return view('student/dashboard', compact('learnertest', 'tests'));
        })->name('user.dashboard');

        Route::get('/user/verification', function (){
            return view('student/request-verification');
        })->name('user.verification');

        Route::post('/user/verification',[VerificationController::class, 'store'])->name('user-verify');

        Route::resource('/past-tests',PastTestsController::class);

        Route::resource('/user-test', StudentTestController::class);

        Route::get('/user-test/show/{id}',[StudentTestController::class, 'show'])->name('/user-test.show');

        Route::resource('/user-learner', LearnerTypeTestController::class);

        Route::post('/user-learner/update',[LearnerTypeTestController::class, 'update'])->name('/user-learner.update');

    });

    //admin only routes
    Route::group(['middleware' => 'is_admin:admin'], function () {

        Route::get('/admin/dashboard', function () {

            $students = count(User::where('user_type', '=', 'user')->get());
            $teachers = count(User::where('user_type', '=', 'teacher')->get());

            return view('admin/admin-dashboard', compact('students', 'teachers'));
        })->name('admin.dashboard');

        Route::resource('/admin-users',AdminUserController::class);
        Route::post('/admin-users/update',[AdminUserController::class, 'store'])->name('admin-users-update');

        Route::resource('/verification', AdminVerificationController::class);
        Route::post('/verification/update',[AdminVerificationController::class, 'update'])->name('verification-update');

        Route::resource('/changelog', AdminChangelogController::class);

        Route::get('/process-all-users', [AdminProcessAllUserData::class, '__invoke'])->name('process-all-users.invoke');;

    });


    //teacher only routes
    Route::group(['middleware' => 'is_teacher:teacher'], function () {

        Route::get('/teacher/dashboard', function (){
            return view('teacher/teacher-dashboard');
        })->name('teacher.dashboard');

        //teacher test creation controllers
        Route::resource('/teacher-tests',TeacherTestController::class);
        Route::get('/teacher-tests/show/{id}',[TeacherTestController::class, 'show'])->name('/teacher-tests.show');

        Route::resource('/teacher-question',TeacherQuestionController::class);

        Route::resource('/teacher-answer',TeacherAnswerController::class);

    });

});
