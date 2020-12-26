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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//QA
Route::get('/qa', 'Qa\QaController@index')->name('qa.index');
Route::get('/qa/create', 'Qa\QaController@create')->name('qa.create');
Route::get('/qa/edit/{qa_id?}', 'Qa\QaController@edit')->name('qa.edit');
Route::post('/qa/confirm/{qa_id?}', 'Qa\QaController@confirm')->name('qa.confirm');
Route::post('/qa/complete{qa_id?}', 'Qa\QaController@complete')->name('qa.complete');

Route::get("/gurunavi", "Gurunavi\GurunaviController@index")->name('gurunavi.index');