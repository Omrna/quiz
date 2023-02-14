<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function(){
    Route::get('/answer_dynamic_loading', [AnswerController::class, 'fetch_data'])->name('answer_dynamic_loading');
    Route::post('/answer', [AnswerController::class, 'add'])->name('answer');
    Route::get('/answer', [AnswerController::class, 'add'])->name('answer');
    Route::post('/submit_quiz', [AnswerController::class, 'submit_your_answers'])->name('submit_quiz');

    // Admin Pages
    Route::get('/admins', [UserController::class, 'showAdminUsers'])->name('admins');
    Route::get('/users', [UserController::class, 'showNormalUsers'])->name('users');
    Route::get('/allquestions', [QuestionController::class, 'showquestions'])->name('allquestions');
    Route::get('/addquestion', [QuestionController::class, 'add'])->name('addquestion');
    Route::post('/addquestion', [QuestionController::class, 'add'])->name('addquestion');
});
