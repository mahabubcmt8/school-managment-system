<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\SectionController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\ClassRoomController;
use App\Http\Controllers\backend\SubjectController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\ClassRoutineController;
use App\Http\Controllers\backend\ExamController;
use App\Http\Controllers\backend\ExamScheduleContorller;



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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
    // Class >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('class', ClassController::class);
    Route::get('/getClasses', [ClassController::class, 'getClasses'])->name('getClasses');

    // Section >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('section', SectionController::class);
    Route::get('/get/sections', [SectionController::class, 'getSections'])->name('getSections');

    // Department >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('department', DepartmentController::class);
    Route::get('/get/department', [DepartmentController::class, 'getDepartment'])->name('getDepartment');

    // Class Room >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('classroom', ClassRoomController::class);
    Route::get('/get/class/room', [ClassRoomController::class, 'getClassRoom'])->name('getClassRoom');

    // Subject >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('subject', SubjectController::class);
    Route::get('/get/All/subject', [SubjectController::class, 'getAllSubject'])->name('getAllSubject');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    // Class Routine >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('class-routine', ClassRoutineController::class);

    // Exam >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('exam', ExamController::class);
    Route::get('/get/exam/list', [ExamController::class, 'getExamList'])->name('getExamList');

    // Exam schedule >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('exam-schedule', ExamScheduleContorller::class);
});
