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

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::resource('/third-party', 'ThirdPartyController');

Auth::routes();

Route::group(['middleware' => ['auth', 'bindings']], function () {
    Route::get('loan-request/{id}', 'LoanController@index');
    Route::post('loan-request/update', 'LoanController@update');
    Route::get('loan-details/{id}', 'LoanController@loanDetails');
    Route::post('loan-request/update-repayment', 'LoanController@updateRepayment');
    Route::get('success', 'LoanController@success');
});