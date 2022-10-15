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
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\GuardianController;
use App\Http\Controllers\backend\FeesTypeController;
use App\Http\Controllers\backend\FeesController;
use App\Http\Controllers\backend\ExpenseTypeController;
use App\Http\Controllers\backend\ExpenseController;
use App\Http\Controllers\backend\ResultRuleController;
use App\Http\Controllers\backend\MarkController;
use App\Http\Controllers\backend\EmployeeAttendenceController;
use App\Http\Controllers\backend\StudentAttendenceController;


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

    // Student >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('students', StudentController::class);

    // Student >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('guardians', GuardianController::class);

    // Fees Type >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('fees-type', FeesTypeController::class);
    Route::get('/getFeesType', [FeesTypeController::class, 'getFeesType'])->name('getFeesType');

    // Fees >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('fees', FeesController::class);

    // Expense Type >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('expense-type', ExpenseTypeController::class);
    Route::get('/getExpenseType', [ExpenseTypeController::class, 'getExpenseType'])->name('getExpenseType');

    // Expense  >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('expense', ExpenseController::class);
    Route::get('/getExpense', [ExpenseController::class, 'getExpense'])->name('getExpense');

    // Result Rule  >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('result-rule', ResultRuleController::class);
    Route::get('/getResultRule', [ResultRuleController::class, 'getResultRule'])->name('getResultRule');

    // Result Rule  >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('mark', MarkController::class);
    Route::get('mark-edit', [MarkController::class, 'markedit'])->name('markedit');
    Route::post('mark-update', [MarkController::class, 'markupdate'])->name('markupdate');

    // Employee Attendence  >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('employee-attendence', EmployeeAttendenceController::class);

    // Student Attendence  >>>>>>>>>>>>>>>>>>>>>>>>>
    Route::resource('student-attendence', StudentAttendenceController::class);


});
