<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//route category
Route::post('category', 'Api\Category@index');
Route::post('category/show', 'Api\Category@get');
Route::post('category/store', 'Api\Category@store');
Route::post('category/update', 'Api\Category@update');
Route::post('category/delete', 'Api\Category@delete');
//route product
Route::post('product', 'Api\Product@index');
Route::post('product/show', 'Api\Product@get');
Route::post('product/store', 'Api\Product@store');
Route::post('product/update', 'Api\Product@update');
Route::post('product/delete', 'Api\Product@delete');
//route company
Route::post('company', 'Api\Company@index');
Route::post('company/show', 'Api\Company@get');
Route::post('company/store', 'Api\Company@store');
Route::post('company/update', 'Api\Company@update');
Route::post('company/delete', 'Api\Company@delete');
//route user
Route::post('user', 'Api\User@index');
Route::post('user/show', 'Api\User@get');
Route::post('user/store', 'Api\User@store');
Route::post('user/update', 'Api\User@update');
Route::post('user/delete', 'Api\User@delete');
//route barcode
Route::post('barcode', 'Api\Barcode@index');
Route::post('barcode/show', 'Api\Barcode@get');
Route::post('barcode/store', 'Api\Barcode@store');
//route auth
Route::post('login', 'Api\Login@login');
Route::post('register', 'Api\Login@register');
