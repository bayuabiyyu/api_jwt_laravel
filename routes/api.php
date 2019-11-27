<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'LoginApiController@register');
Route::post('login', 'LoginApiController@login');
Route::post('logout', 'LoginApiController@logout');

Route::get('user', 'LoginApiController@getAuthenticatedUser')->middleware('jwt.verify');

// Route::get('book', 'BookController@book');
// Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::resource('barang', 'BarangController');
});
