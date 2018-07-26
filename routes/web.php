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

Route::get('/administrator', function () {
    return view('backend.auth.login');
});

Route::group(['prefix' => 'administrator', 'namespace' => 'Backend'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
    Route::post('login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
});

Route::group(['prefix' => 'administrator', 'middleware' => 'auth', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => 'checkrole:1|2'], function () {
        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminSiteController@index']);

        // update account information
        Route::get('user/update-account', ['as' => 'user.updateAccount', 'uses' => 'UserController@updateAccount']);
        Route::put('user/update-account', ['as' => 'user.putUpdateAccount', 'uses' => 'UserController@account']);

        // route for id apples
	    Route::resource('apple', 'AppleController');

	    // route for credit card
	    Route::resource('creditCard', 'CreditCardController');
        Route::get('creditCard/deleteAll', ['as' => 'creditCard.deleteAll', 'uses' => 'CreditCardController@deleteAll'] );

	    // route for serial
	    Route::resource('serial', 'SerialController');
        Route::get('serial/deleteAll', ['as' => 'serial.deleteAll', 'uses' => 'SerialController@deleteAll'] );

	    Route::resource('iphoneInformation', 'IphoneInformationController');
	    Route::get('iphoneInformation/deleteAll', ['as' => 'iphoneInformation.deleteAll', 'uses' => 'IphoneInformationController@deleteAll'] );
    });

    Route::group(['middleware' => 'checkrole:1'], function () {
        Route::resource('menuSystem', 'MenuSystemController', ['except' => ['show']]);
        Route::resource('user', 'UserController');
    });
});

Route::group(['namespace' => 'Backend'], function () {
    // get one id apple to use.
    Route::get('get-id-apple', 'AppleController@getOneIdApple');
});