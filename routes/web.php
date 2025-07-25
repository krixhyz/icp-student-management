<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Attendance\AttendanceController;

use App\Http\Controllers\User\AuthController;

Route::middleware(['auth'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('role:teacher');
        Route::post('/', [UserController::class, 'store'])->name('users.store')->middleware('role:teacher');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:teacher');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update')->middleware('role:teacher');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:teacher');
        Route::get('/students', [UserController::class, 'students'])->name('users.students')->middleware('role:teacher');
        Route::get('/students', [UserController::class, 'students'])->name('users.students')->middleware('role:student,teacher');
    });

    Route::prefix('attendances')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index')->middleware('role:teacher,student');
        Route::post('/mark-all', [AttendanceController::class, 'markAllPresent'])->name('attendances.markAll')->middleware('role:teacher');
    });
});

Route::get('/register/verification/{token}', [AuthController::class, 'verification'])->name('register.verification');



// Registration
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');


Route::prefix('/login')
    ->as('login.')
    ->controller(AuthController::class)->group(function () {
        Route::get('/verification/{token}', 'verification')->name('verification');
        Route::get('/', 'showLoginForm')->name('show');
        Route::post('/', 'login')->name('attempt');
    });



// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return redirect()->route('login.show');
});