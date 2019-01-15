<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsController')->except('show');
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');

//Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswersController');
Route::post('/answers/{answer}/accept', 'AcceptAnswersController')->name('answers.accept');
Route::post('/questions/{question}/favorite', 'FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorite', 'FavoritesController@destroy')->name('questions.unfavorite');