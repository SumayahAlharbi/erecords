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


Route::get('403error', function () {
  return view('403error');
});



Route::group(['middleware' => ['role:officer|manager']], function ()
{
Route::get('student/search_result', 'StudentController@search')->name('student.search_result');
Route::get('student/advanced_search_result', 'StudentController@advanced_search')->name('student.advanced_search_result');
Route::resource('/student', 'StudentController');
Route::get('/advanced_search', function () {
  return view('advanced_search');
})->name('advanced_search');
});

Route::group(['middleware' => ['role:manager']], function ()
{
Route::post('student/update_personal', 'StudentController@update_personal')->name('student.update_personal');
Route::post('student/update_academic', 'StudentController@update_academic')->name('student.update_academic');
Route::post('student/update_contact', 'StudentController@update_contact')->name('student.update_contact');
Route::post('student/upload_attachment', 'StudentController@upload_attachment')->name('student.upload_attachment');
Route::get('Student/pdf','StudentController@export_pdf');
Route::get('Student/excel', function () {
  return Excel::download(new SimpleSearchExport, 'erecords.xlsx');
});
Route::get('/pdfview', function () {
  return view('ExportPDFSearch');
});
Route::get('summeryReport/pdf','StudentController@summeryReport_pdf');
Route::get('studentReport/pdf/{id}','StudentController@studentReport_pdf');

//roles and permissions
Route::get('/manager','UserController@index')->name('manager.home'); //manger dashboard
Route::get('/manager/userRoles/{id}','UserController@showUserRoles'); // show user roles form
Route::get('user/{id}','UserController@update')->name('user.update'); // assign user to roles

Route::get('/manager/activityLog','UserController@activity_log')->name('activity.log');
});

Route::group(['middleware' => ['role:admin']], function ()
{
Route::resource('/role', 'RoleController');
Route::resource('/permission', 'PermissionController');
Route::get('/admin','AdminController@index')->name('admin.home');

Route::get('/userRoles/{id}','RoleController@showUserRoles');// show user role form

Route::get('/permission_assign','PermissionController@showRolePermission')->name('permission.assign'); // show the form of assign permission to role -1-
Route::get('dynamic_dependent/ajax/{id}', 'PermissionController@dynamic_dependent_ajax'); // show list of permissions for the selected role -2-
Route::get('/permission/assign','PermissionController@update')->name('permission.update'); // assign permission to role -3-
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
