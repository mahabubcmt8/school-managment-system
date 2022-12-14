<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ajaxRequestController;



/*
|--------------------------------------------------------------------------
| Ajax Data Fetch Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth']], function () {
    Route::get('get/section/{id}' ,[ajaxRequestController::class , 'getSection'])->name('getSection');
    Route::get('get/subject/{id}' ,[ajaxRequestController::class , 'getSubject'])->name('getSubject');
    Route::get('get/exams/{exam_id}/{class_id}/{section_id}',[ajaxRequestController::class, 'getExams'])->name('getExams');
    Route::get('/get/student/{class_id}/{section_id}', [ajaxRequestController::class, 'getStudent'])->name('getStudent');
    Route::get('/get/fees/{fees_type}/{class}/{section}/{status}', [ajaxRequestController::class, 'getFees'])->name('getFees');
    Route::get('/get/all/marks/{exam}/{class}/{section}/{subject}', [ajaxRequestController::class, 'getAllMarks'])->name('getAllMarks');
});
