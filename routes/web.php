<?php

use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;


Route::get('/', function () {
    return redirect()->route('quizzes.index', QuizController::class);
});

Route::get('lang/{lang}',[LanguageController::class,'switch'])->name('switch.lang');
Route::middleware('auth')->group(function () {
    Route::resource('/quizzes', QuizController::class)->except('index');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/quizzes/check/{quiz}', [QuizController::class, 'checkAnswers'])->name('quizzes.checkAnswers');
    Route::post('/quizzes/{quiz}/delete', [QuizController::class, 'deleteQuiz'])->name('quizzes.delete');
    Route::post('/quizzes/{quiz}/competition',[QuizController::class,'compQuiz'])->name('compt.quiz');
    Route::post('/quizzes/{quiz}/competition/reset',[QuizController::class,'deCompQuiz'])->name('compt.quiz.delete');
    Route::get('/competition', [CompetitionController::class, 'index'])->name('competition.index');
    Route::prefix('adm')->as('adm.')->middleware('hasrole:admin')->group(function () {
        Route::get('/users/', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/search', [UserController::class, 'index'])->name('users.search');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::put('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::put('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');

        //        Route::get('/adm/posts/',[UserController::class ,'showPosts'])->name('adm.posts');

    });
});

Route::resource('quizzes', QuizController::class)->only('index');
Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'create'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
