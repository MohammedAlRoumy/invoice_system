<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'InvoiceController@index')->name('index');

Route::get('change-locale/{locale}', ['as'=>'frontend_change_locale','uses'=>'GeneralController@changeLanguage']);

Route::resource('invoice', 'InvoiceController');
Route::get('invoice/print/{id}', ['as' => 'invoice.print', 'uses' => 'InvoiceController@print']);
Route::get('invoice/pdf/{id}', ['as' => 'invoice.pdf', 'uses' => 'InvoiceController@pdf']);

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
