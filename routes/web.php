<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;

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

Route::post('/users_list', 'AuthController@list_all_data')->name('users_list');

Route::get('/add', 'AuthController@add')->name('add');
Route::post('/submit', 'AuthController@submit')->name('submit');

Route::get('/home', 'AuthController@index')->name('home');
Route::get('/list', 'AuthController@lists')->name('list');

Route::post('/login', 'AuthController@login_check')->name('login');
Route::post('/forget', 'AuthController@forget_password')->name('forget');
Route::post('/update', "AuthController@update_password")->name('update');