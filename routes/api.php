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
