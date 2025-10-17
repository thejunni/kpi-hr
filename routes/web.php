<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('/', [QuestionController::class, 'showQuestion'])->name('index');
    Route::get('/result', [QuestionController::class, 'result'])->name('result');
    Route::post('/answer', [QuestionController::class, 'answer'])->name('answer');
    Route::get('/result/download', [QuestionController::class, 'downloadPdf'])->name('downloadPdf');
});
Route::resource('users', UserController::class);
Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
Route::get('/employees/{id}', [UserController::class, 'getEmployeeById'])->name('employees.get');
Route::get('/download/{id}', [UserController::class, 'downloadPDF'])->name('employees.download');
// Auth (HRD only)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard setelah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});