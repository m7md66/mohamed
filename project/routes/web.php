<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('full-calender', 'App\Http\Controllers\FullCalenderController@index');

Route::post('full-calender/action', 'App\Http\Controllers\FullCalenderController@action');
Route::get('course/create', 'FullCalenderController@create')->name('course.create');
Route::get('instructor/create', 'FullCalenderController@create')->name('instructor.create');
Route::get('track/create', 'FullCalenderController@create')->name('track.create');
Route::get('session/create', 'FullCalenderController@create')->name('session.create');

?>
