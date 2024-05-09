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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,"index"])->name('home');

Route::prefix('/student')->group(function(){

    Route::get('/',[StudentController::class,"index"])->name('student');
    Route::post('/store',[StudentController::class,"store"])->name('student.store');
    Route::get('/edit',[StudentController::class,"edit"])->name('student.edit');
    Route::post('/{student_id}/update',[StudentController::class,"update"])->name('student.update');
    Route::get('/{student_id}/delete',[StudentController::class,'delete'])->name(('student.delete'));
     Route::get('/{student_id}/status',[StudentController::class,'status'])->name(('student.status'));


});
