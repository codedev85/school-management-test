<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
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


Route::resource('students',StudentController::class);
Route::resource('courses',CourseController::class);

Route::post('assign/{student_id}/course',[StudentController::class , 'assignCourse'])->name('assign.course');
Route::get('/detach/{student_id}/course/{course_id}', [StudentController::class , 'unassignCourse'])->name('detach.course');


Route::post('assign/{course_id}/student',[CourseController::class , 'assignCourse'])->name('assign.course');
Route::get('/detach/{student_id}/student/{course_id}', [CourseController::class , 'unassignCourse'])->name('detach.course');
