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

Route::get('/clear-cache', function () {
    Artisan::call('chace:clear');
    return "Cache is cleared";
});

/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return view('dashbord');
})->middleware('auth');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource(
    'kelas',
    'KelasController'
)->middleware('auth');
Route::resource(
    'jurusan',
    'JurusanController'
)->middleware('auth');
Route::resource(
    'siswa',
    'SiswaController'
)->middleware('auth');
Route::resource(
    'guru',
    'GuruController'
)->middleware('auth');
Route::resource(
    'matpel',
    'MatpelController'
)->middleware('auth');
Route::resource(
    'predikat',
    'PredikatController'
)->middleware('auth');
Route::resource(
    'nilai',
    'NilaiController'
)->middleware('auth');
Route::resource(
    'sekolah',
    'SekolahController'
)->middleware('auth');
Route::resource(
    'walikelas',
    'WaliKelasController'
)->middleware('auth');
Route::resource(
    'semester',
    'SemesterController'
)->middleware('auth');
Route::resource(
    'member',
    'MemberController'
)->middleware('auth');

Route::get('pdfrapor/{id}', 'NilaiController@generatePDF')->middleware('auth');
