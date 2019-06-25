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
    //return view('welcome');
    return redirect('login');
});

//Auth::routes();

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('s20register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('s20register', 'Auth\RegisterController@register');

// Password Reset Routes...
/*$this->get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('admin/password/reset', 'Auth\ResetPasswordController@reset');*/

Route::any('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {

    Route::any('/home', 'NewController@ajax5')->name('home')->middleware('verified');
    Route::any('/home2', 'NewController@ajax6')->name('home2')->middleware('verified');
    //Route::any('/home', 'NewController@testhome')->name('home')->middleware('verified');

    Route::any('/newmodels', 'NewController@newmodels2')->name('newmodels')->middleware('verified');
    //Route::any('/newmodels2', 'NewController@newmodels2')->name('newmodels2')->middleware('verified');

    ///super admin
    Route::any('/trafficstats', 'SuperAdminController@trafficstats')->middleware('verified');

    Route::any('/twitterstats', 'SuperAdminController@twitterstats2')->middleware('verified');
    //Route::any('/twitterstats2', 'SuperAdminController@twitterstats2')->middleware('verified');

    Route::any('/modelsmanagement', 'SuperAdminController@modelsmanagement')->name('modelsmanagement')->middleware('verified');

    Route::any('/users', 'SuperAdminController@getUsers')->name('getUsers')->middleware('verified');

    Route::post('/analytics/{stat}', 'AnalyticsController@filter')->name('analyticsFilter');
    Route::get('/analytics/{stat?}', 'AnalyticsController@index')->name('analytics');
    Route::get('/ip/{ip_code?}', 'AnalyticsController@ip')->name('visitorsIP');
    Route::post('/ip/search', 'AnalyticsController@search')->name('visitorsSearch');
    Route::get('/visitors', 'AnalyticsController@visitors')->name('visitors');
    Route::any('/visitorsbyip', 'AnalyticsController@visitorsByIp')->name('visitorsByIp');
    Route::any('/visitorsbanner', 'AnalyticsController@visitorsBanner')->name('visitorsBanner');
    Route::any('/visitorsbysource/{range?}', 'AnalyticsController@visitorsbysource')->name('visitorsbysource');




    Route::any('/api/last10days/{modelname}', 'NewController@lastTenDays')->middleware('verified');
    Route::any('/api/last5periods/{model}', 'NewController@lastFivePeriods')->middleware('verified');
    Route::any('/testapi', 'NewController@getModelsFromApi')->middleware('verified');
    Route::any('/newmodelsapi', 'NewController@getModelsFromApiNewModels')->middleware('verified');
    Route::any('/newmodelsapi2', 'NewController@getModelsFromApiNewModels2')->middleware('verified');



//    Route::any('/modelstest', 'NewController@modelstest');
//
//    Route::any('/ajax2', 'NewController@othermodels');
//
//    Route::any('/proxy/{modelname}', 'NewController@proxyFetch');
//
//    Route::any('/getdays/{modelname}', 'NewController@getDays');
//
//    Route::any('/proxywname/{modelname}', 'NewController@proxyFetchWStore');
//
//    Route::any('/ajaxcron', 'NewController@ajaxCron');
//
//    Route::any('/ajaxcron3', 'NewController@ajaxCron3');
//
//    Route::any('/getModelVisit/{model}', 'NewController@getModelVisit');
//
//    Route::any('/api/models', 'NewController@apimodels');
//

//
//    Route::any('/ajaxban', 'NewController@ajaxBan');
//
//    Route::any('/testimg', 'NewController@testimg');

});


Route::any('/cronjobasjkhdkhakshkdhjkaskdk', 'NewController@cronjob');

