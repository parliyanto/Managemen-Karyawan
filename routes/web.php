<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Mail\AssignmentReminderMail;
use App\Models\Assignment;
use App\Http\Controllers\EmployeePageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EmployeeLogController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/employees', [EmployeePageController::class, 'index'])->name('employee.index');
Route::post('/employees', [EmployeePageController::class, 'store'])->name('employee.store');
Route::get('/employees/assign/{id}', [EmployeePageController::class, 'assign'])->name('employee.assign');
Route::delete('/employees/{id}', [EmployeePageController::class, 'destroy'])->name('employee.destroy');
Route::put('/employees/{id}', [EmployeePageController::class, 'update'])->name('employee.update');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
Route::delete('/assignments/{id}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');

Route::get('/assignments/confirm/{token}', [AssignmentController::class, 'confirm'])
    ->name('assignments.confirm');

Route::get('/employee/logs', [EmployeeLogController::class, 'index'])->name('employee.logs');

// get ke maatwebsite excel
Route::get('/employee/logs/export', [EmployeeLogController::class, 'export'])->name('employee.logs.export');








