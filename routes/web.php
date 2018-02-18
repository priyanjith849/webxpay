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

Auth::routes();

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/admin', 'DashboardController@index')->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'admin'], function () {
        $this->get('ads', 'AdsController@index');
        // $this->get('ads/create', 'AdsController@create');
        
        $this->get('ads/edit/{id}', 'AdsController@edit');
        $this->post('ads/update/{id}', 'AdsController@update');
        $this->get('ads/show/{id}', 'AdsController@show');
        $this->get('ads/delete/{id}', 'AdsController@destroy');

        $this->get('subscription-plans', 'SubscriptionPlanController@index');
        $this->get('subscription-plans/create', 'SubscriptionPlanController@create');
        $this->post('subscription-plans/store', 'SubscriptionPlanController@store');
        $this->get('subscription-plans/edit/{id}', 'SubscriptionPlanController@edit');
        $this->post('subscription-plans/update/{id}', 'SubscriptionPlanController@update');
        $this->get('subscription-plans/show/{id}', 'SubscriptionPlanController@show');
        $this->get('subscription-plans/delete/{id}', 'SubscriptionPlanController@destroy');

        $this->get('categories', 'CategoryController@index');
        $this->get('categories/create', 'CategoryController@create');
        $this->post('categories/store', 'CategoryController@store');
        $this->get('categories/edit/{id}', 'CategoryController@edit');
        $this->post('categories/update/{id}', 'CategoryController@update');
        $this->get('categories/show/{id}', 'CategoryController@show');
        $this->get('categories/delete/{id}', 'CategoryController@destroy');

    });
});

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => ''], function () {
        // $this->get('ads', 'AdsController@index');
        $this->get('ads/create', 'AdsController@create');
        $this->post('ads/store', 'AdsController@store');
    });
});

Route::get('/ads-refresh', 'AdsController@updateAdsBySubscription')->name('ads_refresh');