<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| SOAP Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API SOAP!
|
*/

Route::get('/operacion', 'SoapController@operaciones');
Route::post('/operacion', 'SoapController@operaciones');
