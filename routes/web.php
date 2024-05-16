<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryGradeController;
use App\Http\Controllers\SalaryYearController;
use App\Http\Controllers\SalaryMonthController;
use App\Http\Controllers\SalaryController;

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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login/action', [AuthController::class, 'login'])->name('login.action');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::resource('user', UserController::class);
// Route::post('/check-empcode', 'UserController@checkEmpCode');
Route::post('/check-empcode',  [UserController::class, 'checkEmpCode']);
Route::get('/check-email', 'UserController@checkEmail');


// route edit tanpa parameter id, karena id nya menggunakan request
Route::get('/salarygrade/edit', [SalaryGradeController::class, 'edit'])->name('salarygrade.edit');
Route::put('/salarygrade/update', [SalaryGradeController::class, 'update'])->name('salarygrade.update_multiple');
Route::get('/salary-year/edit', [SalaryYearController::class, 'edit'])->name('salary-year.edit');
Route::put('/salary-year/update', [SalaryYearController::class, 'update'])->name('salary-year.update_multiple');
Route::get('/salary-month/edit', [SalaryMonthController::class, 'edit'])->name('salary-month.edit');
Route::put('/salary-month/update', [SalaryMonthController::class, 'update'])->name('salary-month.update_multiple');

Route::resource('salarygrade', SalaryGradeController::class);
Route::resource('salary-year', SalaryYearController::class);
Route::resource('salary-month', SalaryMonthController::class);
Route::resource('salary', SalaryController::class);
Route::resource('status', StatusController::class);
Route::resource('grade', GradeController::class);
Route::resource('departement', DeptController::class);
Route::resource('job', JobController::class);

Route::get('/print-pdf/{id}', [SalaryController::class, 'print']);
Route::get('/download-pdf/{id}', [SalaryController::class, 'download']);
Route::get('/print-all', [SalaryController::class, 'printall']);
Route::get('/print-allocation', [SalaryController::class, 'printallocation']);
