<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('student')->group(function () {
    Route::get('/all', [StudentController::class, 'all'])->name('student.all');
    Route::post('/store', [StudentController::class, 'store'])->name('student.store');
    Route::get('/get/{student_id}', [StudentController::class, 'get'])->name('student.get');
    Route::post('/update/{student_id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/delete/{student_id}', [StudentController::class, 'delete'])->name('student.delete');
    Route::get('/status/{student_id}', [StudentController::class, 'status'])->name('student.status');

});

require __DIR__ . '/auth.php';
