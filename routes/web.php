<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CompanyAdvisorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolAdvisorController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\StudentController;

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
    return auth()->check() ? redirect()->to('dashboard') : redirect()->to('login');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.process');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([Authenticate::class])->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'remove')->name('remove');
    });

    Route::controller(SchoolYearController::class)->prefix('school-years')->name('school-years.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'remove')->name('remove');
        Route::put('school-years/{id}/activate', 'activate')->name('activate');
        Route::put('school-years/{id}/deactivate', 'deactivate')->name('deactivate');
    });

    Route::controller(ClassroomController::class)->prefix('classrooms')->name('classrooms.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'remove')->name('remove');

        Route::get('/{id}/students', 'studentIndex')->name('studentIndex');
        Route::get('/{id}/students/create', 'studentCreate')->name('studentCreate');
        Route::get('/{classroomId}/student/{studentId}', 'studentEdit')->name('studentEdit');
        Route::delete('/{classroomId}/student/{studentId}', 'studentRemove')->name('studentRemove');
    });

    Route::controller(CompanyAdvisorController::class)->prefix('company-advisors')->name('company-advisors.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'remove')->name('remove');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(CompanyController::class)->prefix('companies')->name('companies.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::controller(StudentController::class)->prefix('students')->name('students.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'store')->name('store');
        Route::put('/{classroomId}/student/{id}', 'update')->name('update');
        Route::delete('/{id}', 'remove')->name('remove');
        Route::post('/import/{classroomId}', 'import')->name('import');
    });


    Route::controller(SchoolController::class)->prefix('school')->name('school.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
    });

    Route::controller(SchoolAdvisorController::class)->prefix('school-advisors')->name('school-advisors.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'remove')->name('remove');
    });

    Route::controller(InternshipController::class)->prefix('internships')->name('internships.')->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/create', 'create')->name('create');
        Route::get('/{id}', 'show')->name('show');
        // Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        // Route::put('/{id}', 'update')->name('update');
        // Route::delete('/{id}', 'remove')->name('remove');
    });

    Route::controller(AnnouncementController::class)->prefix('announcements')->name('announcements.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/detail', 'show')->name('show');
        Route::get('/{id}', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});
