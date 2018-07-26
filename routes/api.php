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

Route::group(['namespace' => 'Backend'], function () {
    // detach exist iphone information
    Route::get('checkIphoneInformation', 'IphoneInformationController@checkInformation');

    // delete all selected id apples
    Route::post('apple/delete-all', 'AppleController@deleteAll');
});
