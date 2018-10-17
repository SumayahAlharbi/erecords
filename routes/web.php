<?php

use App\Exports\SimpleSearchExport;

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
  return view('home');
});

Route::get('/home', function () {
  return view('home');
})->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function()
{
Route::get('student/search_result', 'StudentController@search')->name('student.search_result');
Route::get('student/advanced_search_result', 'StudentController@advanced_search')->name('student.advanced_search_result');
Route::post('student/update_personal', 'StudentController@update_personal')->name('student.update_personal');
Route::post('student/update_academic', 'StudentController@update_academic')->name('student.update_academic');
Route::post('student/update_contact', 'StudentController@update_contact')->name('student.update_contact');
Route::resource('/student', 'StudentController');
Route::get('/advanced_search', function () {
  return view('advanced_search');
})->name('advanced_search');

//Routes for exporting to PDF or Excel
Route::get('Student/pdf','StudentController@export_pdf');
Route::get('Student/excel', function () {
  return Excel::download(new SimpleSearchExport, 'erecords.xlsx');
});
Route::get('/pdfview', function () {
  return view('ExportPDFSearch');
});

Route::get('summeryReport/pdf','StudentController@summeryReport_pdf');
Route::get('studentReport/pdf/{id}','StudentController@studentReport_pdf');

});
