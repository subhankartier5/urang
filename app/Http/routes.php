<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*landing page routes*/
Route::get('/',['uses' => 'MainController@getIndex', 'as' => 'index']);
Route::get('/login', ['uses' => 'MainController@getLogin' ,'as' => 'getLogin']);
Route::post('/login-attempt', ['uses' => 'MainController@postCustomerLogin', 'as' => 'postCustomerLogin']);
Route::get('/sign-up', ['uses' => 'MainController@getSignUp', 'as' => 'getSignUp']);
Route::post('/attmept-sign-up', ['uses' => 'MainController@postSignUp', 'as' => 'postSignUp']);
Route::get('/user-logout', ['uses' => 'MainController@getLogout', 'as' => 'getLogout']);

/*after login user functionality in middleware*/
Route::group(['middleware' => ['user']], function () {
    Route::get('/user-dashboard', ['uses' => 'MainController@getDashboard','as' => 'getCustomerDahsboard']);
    Route::get('/profile', ['uses' => 'MainController@getProfile', 'as' => 'get-user-profile']);
    Route::post('/profile', ['uses' => 'MainController@postProfile', 'as' => 'post-user-profile']);
    Route::get('/changepassword', ['uses' => 'MainController@getChangePassword', 'as' => 'getChangePassword']);
});


/*Admin Routes*/
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'get-admin-login']);
Route::post('/admin', ['uses' => 'AdminController@LoginAttempt', 'as' => 'post-admin-login']);


Route::get('/dashboard', ['uses' => 'AdminController@getDashboard', 'middleware' => 'auth', 'as' => 'get-admin-dashboard']);
Route::get('/logout', ['uses' => 'AdminController@logout', 'as' => 'get-admin-logout']);
Route::get('/profile-details', ['uses' => 'AdminController@getProfile', 'as' => 'get-admin-profile']);
Route::post('/profile-details', ['uses' => 'AdminController@postProfile', 'as' => 'post-admin-profile']);
Route::get('/settings', ['uses' => 'AdminController@getSettings', 'as' => 'get-admin-settings']);
Route::post('/change-password', ['uses' => 'AdminController@postChangePassword', 'as' => 'post-change-password']);
Route::post('/site-settings', ['uses' => 'AdminController@postSiteSettings', 'as' => 'post-site-settings']);
Route::get('/neighborhood', ['uses' => 'AdminController@getNeighborhood', 'as' => 'get-neighborhood']);
Route::post('/neighborhood', ['uses' => 'AdminController@postNeighborhood', 'as' => 'postneighborhood' ]);
Route::post('/edit-neighborhood', ['uses' => 'AdminController@editNeighborhood', 'as' => 'editneighborhood']);
Route::post('/delete-neighborhood', ['uses' => 'AdminController@deleteNeighborhood', 'as' => 'postDeleteNeighborhood']);
Route::get('/price-list', ['uses' => 'AdminController@getPriceList' , 'as' => 'getPriceList']);
Route::post('/price-list', ['uses' => 'AdminController@postPriceList', 'as' => 'postPriceList']);
Route::post('/edit-price-list', ['uses' => 'AdminController@editPriceList', 'as' => 'PostEditPriceList']);
Route::post('/delete-price-item', ['uses' => 'AdminController@postDeleteItem', 'as' => 'postDeleteItem']);
Route::post('/add-category', ['uses' => 'AdminController@postCategory', 'as' => 'postCategory']);
Route::post('/delete-category', ['uses' => 'AdminController@postDeleteCategory', 'as' => 'postDeleteCategory']);
Route::get('/customers', ['uses' => 'AdminController@getCustomers', 'as' => 'getAllCustomers']);
Route::get('/edit-customer/{id}', ['uses' => 'AdminController@getEditCustomer', 'as' => 'getEditCustomer']);
Route::post('/block-user', ['uses' => 'AdminController@postBlockCustomer', 'as' => 'postBlockCustomer']);
Route::post('/delete-user', ['uses' => 'AdminController@DeleteCustomer', 'as'=> 'postDeleteCustomer']);
Route::post('/edit-customer', ['uses' => 'AdminController@postEditCustomer', 'as' => 'postEditCustomer']);
Route::get('/add-new-customer', ['uses' => 'AdminController@getAddNewCustomer', 'as' => 'getAddNewCustomers']);
Route::post('/add-new-customer', ['uses' => 'AdminController@postAddNewCustomer', 'as' => 'postAddNewCustomer']);