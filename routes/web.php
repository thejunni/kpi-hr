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
    // Route::get('/result', [QuestionController::class, 'result'])->name('result');
    Route::post('/answer', [QuestionController::class, 'answerNew'])->name('answer');
    Route::get('/result/download', [QuestionController::class, 'downloadPdf'])->name('downloadPdf');
	Route::delete('/delete/{id}', [QuestionController::class, 'destroy'])->name('destroy');
	Route::get('/questions/category/{slug}', [QuestionController::class, 'category'])->name('category');
	// Route::get('/matrix/download', [QuestionController::class, 'downloadMatrix'])->name('matrix-download');
	// Route::get('/matrix/{type}', [QuestionController::class, 'matrixShow'])->name('matrix.show');
	// Route::get('/matrix-count', [QuestionController::class, 'matrixCount'])->name('matrix.count');


	//NEW FORMULA
	Route::get('/result', [QuestionController::class, 'resultNewFormula'])->name('result-new-formula');
	Route::get('/matrix/download', [QuestionController::class, 'downloadMatrixNewFormula'])->name('matrix-download-new-formula');
	Route::get('/matrix/{type}', [QuestionController::class, 'matrixShowNewFormula'])->name('matrix.show-new-formula');
	Route::get('/new-matrix-count', [QuestionController::class, 'matrixCountNewFormula'])->name('matrix.count-new-formula');
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