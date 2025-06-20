<?php

use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ClassrommController;
use App\Http\Controllers\ExportPDFController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\StudentdropoutController;
use App\Http\Controllers\SetlocalizationController;

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
Route::middleware(['lang', 'auto.app'])->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login/save', [LoginController::class, 'save'])->name('login.save');
});

Route::middleware(['auth', 'lang', 'auto.app'])->group(function () {

        Route::get('welcome', function () {
            return view('welcome');
        })->name('home');
        Route::get('/', function () {
            return view('welcome');
        })->name('home');
        Route::get('dashboard', function () {
            return view('welcome');
        })->name('home');
        Route::get('index', function () {
            return view('welcome');
        })->name('home');
        Route::get('default', function () {
            return view('welcome');
        })->name('home');
        Route::get('home', function () {
            return view('welcome');
        })->name('home');


        // Department route
        // Route::get('department', DepartmentController::class, 'home')->name('department.index');
        // Route::get('department/create', DepartmentController::class, 'create')->name('department.create');
        // Route::post('department/store', DepartmentController::class, 'store')->name('department.store');
        // Route::get('department/edit/{id}', DepartmentController::class, 'edit')->name('department.edit');
        // Route::post('department/update/{id}', DepartmentController::class, 'update')->name('department.update');
        // Route::get('department/delete/{id}', DepartmentController::class, 'destroy')->name('department.destroy');
        // Route::get('department/show/{id}', DepartmentController::class, 'show')->name('department.show');
        // Route::get('department/list', [DepartmentController::class, 'index'])->name('department.index');
        // Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
        // Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');
        // Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        // Route::post('department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
        // Route::get('department/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
        // Route::get('department/show/{id}', [DepartmentController::class, 'show'])->name('department.show');
        Route::resource('department', DepartmentController::class);
        Route::resource('major', MajorController::class);
        Route::resource('class', ClassController::class);
        Route::resource('semester', SemesterController::class);
        Route::resource('classroom', ClassrommController::class);

        // TEACHER HERE
        Route::resource('teacher', TeacherController::class);
        Route::post('teacher/block/{id}', [TeacherController::class, 'block'])->name('teacher.block');
        Route::post('teacher/reset-pass', [TeacherController::class, 'resetPass'])->name('teacher.resetPass');
        Route::post('teacher/leave/{id}', [TeacherController::class, 'leave'])->name('teacher.leave');

        Route::get('teacher/list/leave', [TeacherController::class, 'leaveList'])->name('teacher.leaveList');


        // STUDENT HERE
        Route::resource('student', StudentController::class);
        Route::post('student/get-class', [StudentController::class, 'getClassByYear'])->name('student.getClass');
        Route::post('student/class/detail', [StudentController::class, 'classDetail'])->name('student.classDetail');
        Route::get('student/create/multiple', [StudentController::class, 'createMultiple'])->name('student.createMultiple');
        Route::post('student/create/multiple/save', [StudentController::class, 'storeMultiple'])->name('student.storeMultiple');
        Route::get('student/preview-list/{class_id}', [StudentController::class, 'preview'])->name('student.preview');
        Route::get('student/export-list/{class_id}', [StudentController::class, 'exportList'])->name('student.saveExport');
        Route::get('student/dropout/list', [StudentController::class, 'dropoutList'])->name('student.dropoutList');

        Route::post('student/block/{id}', [StudentController::class, 'block'])->name('student.block');
        Route::post('student/reset-pass', [StudentController::class, 'resetPass'])->name('student.resetPass');
        Route::post('student/leave/{id}', [StudentController::class, 'leave'])->name('student.leave');
        Route::resource('student-dropout', StudentdropoutController::class)->only('index');
        // PDF route
        Route::get('student/list/export/pdf/{class_id}', [ExportPDFController::class, 'exportPdf'])->name('pdf.student');


        //course route
        Route::resource('course', CourseController::class);
        //Qr Code route
        Route::resource('qrcode', QRCodeController::class);
        Route::get('qrcode/generate/new/{id}', [QRCodeController::class, 'generate'])->name('qrcode.generate');
        Route::get('download/qrcode/{id}', [QRCodeController::class, 'download'])->name('qrcode.download');
});



Route::get('lang/{locale}',[SetlocalizationController::class, 'setlocalization'])->name('lang');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
