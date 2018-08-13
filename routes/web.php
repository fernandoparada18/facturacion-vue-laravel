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
Route::get('/invoices', 'InvoiceController@index');
Route::get('/invoices/create', 'InvoiceController@create');
Route::get('/invoices/detail/{id}', 'InvoiceController@show');
Route::get('/invoices/pdf/{id}', 'InvoiceController@pdf');
Route::get('/invoices/findClient', 'InvoiceController@findClient');
Route::get('/invoices/findProduct', 'InvoiceController@findProduct');
Route::post('/invoices/save', 'InvoiceController@store');
