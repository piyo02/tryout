<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VariationController;

use \App\Http\Middleware\Authenticate;
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

Route::get('/', function () { return redirect('/login'); });

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware([Authenticate::class])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    
    Route::get('/dashboard',  [DashboardController::class, 'index']);
    Route::resource('/profile', UserProfileController::class);

    Route::post('/management/question_group', [QuestionController::class, 'store_group']);
    Route::get('/management/collection/token', [CollectionController::class, 'token'])->middleware('role.admin');
    Route::resource('/management/collection', CollectionController::class)->middleware('role.admin');
    Route::resource('/management/question', QuestionController::class)->middleware('role.admin');
    Route::resource('/management/student', StudentController::class)->middleware('role.admin');
    Route::resource('/management/tryout', TryoutController::class)->middleware('role.admin');
    Route::resource('/management/user', UserController::class)->middleware('role.admin');
    Route::resource('/management/variation', VariationController::class)->middleware('role.admin');
    
    
    Route::post('/tryout/answer', [TryoutController::class, 'answer']);
    Route::post('/tryout/finished', [TryoutController::class, 'finished'])->middleware('role.student');
    Route::post('/tryout/token', [TryoutController::class, 'token'])->middleware('role.student');
    Route::get('/tryout/working', [TryoutController::class, 'working'])->middleware('role.student');
    Route::get('/tryout', [TryoutController::class, 'index'])->middleware('role.student');
    Route::get('/history/tryout/result', [TryoutController::class, 'result'])->middleware('role.student');
    Route::get('/history/tryout/{tryout}', [TryoutController::class, 'show'])->middleware('role.student');
    Route::get('/history/tryout/worksheet/{worksheet}', [TryoutController::class, 'worksheet'])->middleware('role.student');
    Route::get('/history/tryout', [TryoutController::class, 'history'])->middleware('role.student');
});

