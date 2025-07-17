<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultysubjectController;
use App\Http\Controllers\AttendanceController;
use App\Models\Attendance;

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
    return view('login');
});
Route::get('/home', function () {
    return view('dashboard');
});

Route::resource('login', LoginController::class);
Route::resource('user', UserController::class);
Route::resource('course', CourseController::class);
Route::resource('subject', SubjectController::class);
Route::resource('faculty', FacultyController::class);
Route::resource('student', StudentController::class);
Route::resource('facultySubject', FacultysubjectController::class);
Route::resource('attendance', AttendanceController::class);

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/editUser/{id}', [UserController::class, 'editUser']);
Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);

Route::get('/editCourse/{id}', [CourseController::class, 'editCourse']);
Route::get('/deleteCourse/{id}', [CourseController::class, 'deleteCourse']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')
->middleware('auth');

Route::post('/loginAuth', [LoginController::class, 'loginAuth']);
Route::get('/genUser', [LoginController::class, 'genUser']);

Route::get('/deleteFaculty/{id}', [FacultyController::class, 'deleteFaculty']);
Route::get('/editFaculty/{id}', [FacultyController::class, 'editFaculty']);

Route::get('/deleteSubject/{id}', [SubjectController::class, 'deleteSubject']);
Route::get('/editSubject/{id}', [SubjectController::class, 'editSubject']);

Route::get('/newStudent', [StudentController::class, 'newStudent']);


Route::post('logout', [LogoutController::class, 'index']);

Route::get('/selectSemesterCourse', [FacultysubjectController::class, 'selectSemesterCourse']);
Route::get('/deleteFacultySubject/{id}', [FacultysubjectController::class, 'deleteFacultySubject']);
Route::get('/editFacultySubject/{id}', [FacultysubjectController::class, 'editFacultySubject']);

Route::get('/markAttendance/{id}', [AttendanceController::class, 'markAttendance']);

