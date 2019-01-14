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

Route::resource('questions', 'QuestionsController');

// Route::get('/questions', 'QuestionsController@index')->name('questions.index');
// Route::get('/questions/{question}', 'QuestionsController@show')->name('questions.show');
// Route::get('/questions/create', 'QuestionsController@create')->name('questions.create');
// Route::post('/questions', 'QuestionsController@store')->name('questions.store');
// Route::get('/questions/{question}/edit', 'QuestionsController@edit')->name('questions.edit');
// Route::patch('/questions/{question}/update', 'QuestionsController@update')->name('questions.update');
