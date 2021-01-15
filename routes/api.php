<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// User Routes
Route::get('/users','UserController@users');
Route::post('/auth/register','AuthController@register');
Route::post('/auth/login','AuthController@login');
Route::get('/users/profile','UserController@profile')->middleware('auth:api');
Route::get('users/{id}','UserController@profileById')->middleware('auth:api');

// Artice Routes
Route::post('/articles','ArticleController@add')->middleware('auth:api'); //post article
Route::put('/article/{article}','ArticleController@update')->middleware('auth:api'); // update article
Route::delete('/article/{article}','ArticleController@delete')->middleware('auth:api'); // delete article
