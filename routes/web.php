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

Route::view("/", "index.index");

Route::get('courses', 'CourseController@index');


Route::middleware(['auth'])->group(function () {
    Route::redirect('/course{id}', '/');
    Route::get('courses/{id}', 'CourseController@show');
});

/*Route::get('admin/programmes', 'Admin\ProgrammeController@index');*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', '/admin/programmes');
    Route::resource('programmes', 'Admin\ProgrammeController');
    Route::get('programmes2/qryProgrammes', 'Admin\Programme2Controller@qryProgrammes');
    Route::resource('programmes2', 'Admin\Programme2Controller', ['parameters' => ['programmes2' => 'programme']]);

    Route::resource('programmes/{id}', 'CourseController')->only([
        /*'create',*/ 'store'
    ]);
});


Auth::routes(['register' => false]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
