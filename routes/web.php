<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('branches', App\Http\Controllers\BranchController::class);

Route::resource('rooms', App\Http\Controllers\RoomController::class);

Route::resource('mentors', App\Http\Controllers\MentorController::class);

Route::resource('departments', App\Http\Controllers\DepartmentController::class);

Route::resource('institutes', App\Http\Controllers\InstituteController::class);

Route::resource('courses', App\Http\Controllers\CourseController::class);

Route::resource('modules', App\Http\Controllers\ModuleController::class);

Route::resource('batches', App\Http\Controllers\BatchController::class);

Route::resource('bookings', App\Http\Controllers\BookingController::class);

Route::resource('contents', App\Http\Controllers\ContentController::class);

Route::resource('topics', App\Http\Controllers\TopicController::class);

Route::resource('faculty-disciplines', App\Http\Controllers\FacultyDisciplineController::class);

Route::resource('sessions', App\Http\Controllers\SessionController::class);


Route::resource('branches', App\Http\Controllers\BranchController::class);

Route::resource('rooms', App\Http\Controllers\RoomController::class);

Route::resource('mentors', App\Http\Controllers\MentorController::class);

Route::resource('departments', App\Http\Controllers\DepartmentController::class);

Route::resource('institutes', App\Http\Controllers\InstituteController::class);

Route::resource('courses', App\Http\Controllers\CourseController::class);

Route::resource('modules', App\Http\Controllers\ModuleController::class);

Route::resource('batches', App\Http\Controllers\BatchController::class);

Route::resource('bookings', App\Http\Controllers\BookingController::class);

Route::resource('contents', App\Http\Controllers\ContentController::class);

Route::resource('topics', App\Http\Controllers\TopicController::class);

Route::resource('faculty-disciplines', App\Http\Controllers\FacultyDisciplineController::class);

Route::resource('sessions', App\Http\Controllers\SessionController::class);


Route::resource('branches', App\Http\Controllers\BranchController::class);

Route::resource('rooms', App\Http\Controllers\RoomController::class);

Route::resource('mentors', App\Http\Controllers\MentorController::class);

Route::resource('departments', App\Http\Controllers\DepartmentController::class);

Route::resource('institutes', App\Http\Controllers\InstituteController::class);

Route::resource('courses', App\Http\Controllers\CourseController::class);

Route::resource('modules', App\Http\Controllers\ModuleController::class);

Route::resource('batches', App\Http\Controllers\BatchController::class);

Route::resource('bookings', App\Http\Controllers\BookingController::class);

Route::resource('contents', App\Http\Controllers\ContentController::class);

Route::resource('topics', App\Http\Controllers\TopicController::class);

Route::resource('faculty-disciplines', App\Http\Controllers\FacultyDisciplineController::class);

Route::resource('sessions', App\Http\Controllers\SessionController::class);
