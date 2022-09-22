<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\SectionController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\ClassRoomController;
use App\Http\Controllers\backend\SubjectController;
use App\Http\Controllers\backend\TeacherController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\RoleController;



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
    Route::resource('classroom', SubjectController::class);
    Route::get('/get/class/room', [SubjectController::class, 'getClassRoom'])->name('getClassRoom');

    // Subject >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('subject', SubjectController::class);
    Route::get('/get/subject', [SubjectController::class, 'getSubject'])->name('getSubject');

    // Subject >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('teacher', TeacherController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});