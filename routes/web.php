<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // user payment
    Route::get('/user-payment/transfer/{id}','UserPaymentController@transfer_proses')->name('user.payment.transnfer');
    Route::post('/user-payment/transfer/payment/{id}','UserPaymentController@transfer_store')->name('user.payment.store');
    Route::post('/user-payment/create', 'UserPaymentController@create')->name('user.payment.create');
    Route::get('/user-payment/delete/{id}', 'UserPaymentController@delete')->name('user.payment.delete');

    // Barcode Generator
    Route::get('/barcode-generator/generate/{id}', 'BarcodeProductController@generate')->name('barcode.generator');
    Route::get('/qr-generator/generate/{id}', 'BarcodeProductController@generate_qr')->name('qr.generator');

    // Print Barcode
    Route::get('/print-barcode/{id}', 'PrintBarcodeController@index')->name('print.barcode');
    Route::get('/print-qr/{id}', 'PrintBarcodeController@index2')->name('print.qr');
    Route::post('/print-barcode/{id}', 'PrintBarcodeController@print_setting')->name('print.barcode.setting');
    Route::get('/print-barcode/print/{id}', 'PrintBarcodeController@print_data')->name('print.barcode.data');

    // Subcription Price
    Route::get('/subcription-price/{id}/delete', 'SubscriptionPriceController@delete')->name('subcription.price.delete');

    Route::get('/home', function () {
        return redirect(route('dashboard'));
    });


    // RS Subcription Price
    Route::resource('subcription-price', 'SubscriptionPriceController');

    // Rs Barcode Generator
    Route::resource('barcode-generator', 'BarcodeProductController');

    // RS User Payment
    Route::resource('user-payment', 'UserPaymentController');

    // RS User
    Route::resource('user', 'UserController');

     // product
    Route::get('/product', 'ProductController@index')->name('product');
    Route::post('/product/create', 'ProductController@create')->name('product.create');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('/product/update/{id}', 'ProductController@update')->name('product.update');
    Route::get('/product/{id}/delete', 'ProductController@delete')->name('product.delete');

    // category
    Route::get('/category', 'CategoryController@index')->name('category');
    Route::post('/category/create', 'CategoryController@create')->name('category.create');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('/category/update/{id}', 'CategoryController@update')->name('category.update');
    Route::get('/category/{id}/delete', 'CategoryController@delete')->name('category.delete');

    // company
    Route::get('/company', 'CompanyController@index')->name('company');
    Route::post('/company/create', 'CompanyController@create')->name('company.create');
    Route::get('/company/edit/{id}', 'CompanyController@edit')->name('company.edit');
    Route::post('/company/update/{id}', 'CompanyController@update')->name('company.update');
    Route::get('/company/{id}/delete', 'CompanyController@delete')->name('company.delete');

//    profile
    Route::get('/myprofile', 'ProfileController@index')->name('myprofile');
    Route::post('/myprofile/update', 'ProfileController@update')->name('myprofile.update');
    // brand
    Route::get('/brand', 'BrandController@index')->name('brand');
    Route::post('/brand/store', 'BrandController@store')->name('brand.store');
    Route::get('/brand/edit/{id}', 'BrandController@edit')->name('brand.edit');
    Route::post('/brand/update/{id}', 'BrandController@update')->name('brand.update');
    Route::get('/brand/{id}/delete', 'BrandController@delete')->name('brand.delete');

});
