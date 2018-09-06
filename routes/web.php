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

Route::get('/home', function () {
  return view('welcome');
})->name('home');

Route::get('/advanced_search', function () {
  return view('advanced_search');
})->name('advanced_search');

Route::get('student/search_result', 'StudentController@search')->name('student.search_result');

Route::get('student/advanced_search_result', 'StudentController@advanced_search')->name('student.advanced_search_result');

Route::resource('/student', 'StudentController');
