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
Route::get('/sign-up', ['uses' => 'MainController@getSignUp', 'as' => 'getSignUp']);
Route::post('/attmept-sign-up', ['uses' => 'MainController@postSignUp', 'as' => 'postSignUp']);
Route::get('/user-logout', ['uses' => 'MainController@getLogout', 'as' => 'getLogout']);
Route::get('/prices', ['uses' => 'MainController@getPrices', 'as' => 'getPrices']);
Route::get('/neighborhoods', ['uses' => 'MainController@getNeiborhoodPage', 'as' => 'getNeiborhoodPage']);
Route::get('/faqs', ['uses' => 'MainController@getFaqList', 'as' => 'getFaqList']);
Route::post('/email-checker', ['uses' => 'MainController@emailChecker', 'as' => 'postEmailChecker']);
Route::get('/contact-us',['uses' => 'MainController@getContactUs', 'as' => 'getContactUs']);
Route::post('/postContactForm',['uses' => 'MainController@postContactForm', 'as' => 'postContactForm']);

/*after login user functionality in middleware*/
Route::get('/login', ['uses' => 'MainController@getLogin' ,'as' => 'getLogin']);
Route::post('/login-attempt', ['uses' => 'MainController@postCustomerLogin', 'as' => 'postCustomerLogin']);

Route::group(['middleware' => ['user']], function () {
    Route::get('/user-dashboard', ['uses' => 'MainController@getDashboard','as' => 'getCustomerDahsboard']);
    Route::get('/profile', ['uses' => 'MainController@getProfile', 'as' => 'get-user-profile']);
    Route::post('/profile', ['uses' => 'MainController@postProfile', 'as' => 'post-user-profile']);
    Route::get('/changepassword', ['uses' => 'MainController@getChangePassword', 'as' => 'getChangePassword']);
    Route::post('/attempt-changepassword', ['uses' => 'MainController@postChangePassword', 'as' => 'postchangePassword']);
    Route::get('/pickup-request', ['uses'=> 'MainController@getPickUpReq', 'as' => 'getPickUpReq']);
    Route::post('/save-pickup-request', ['uses' => 'MainController@postPickUp', 'as' => 'postPickUpReq']);
    Route::get('/my-pickups', ['uses' => 'MainController@getMyPickUps', 'as' => 'getMyPickUp']);
    Route::post('/delete-pickup', ['uses' => 'MainController@postDeletePickUp', 'as' => 'postDeletePickup']);
    Route::get('/invoice', ['uses' => 'InvoiceController@index', 'as' => 'getInvoice']);
});


/*Admin Routes*/
Route::get('/admin', ['uses' => 'AdminController@index', 'as' => 'get-admin-login']);
Route::post('/admin', ['uses' => 'AdminController@LoginAttempt', 'as' => 'post-admin-login']);
Route::group(['middleware' => ['auth']], function () {
	Route::get('/dashboard', ['uses' => 'AdminController@getDashboard', 'as' => 'get-admin-dashboard']);
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
	Route::get('/faq' , ['uses' => 'AdminController@getFaq', 'as' => 'getFaq']);
	Route::post('/atempt-add-faq', ['uses' => 'AdminController@postAddFaq', 'as' => 'postAddFaq']);
	Route::post('/edit-faq', ['uses' => 'AdminController@UpdateFaq', 'as' => 'postEditFaq']);
	Route::post('/delete-faq', ['uses' => 'AdminController@DeleteFaq', 'as' => 'postDeleteFaq']);
	Route::get('/customer-orders', ['uses' => 'AdminController@getCustomerOrders', 'as' => 'getCustomerOrders']);
	Route::get('/staffs', ['uses' => 'AdminController@getStaffList', 'as' => 'getStaffList']);
	Route::post('/add-staff', ['uses' => 'AdminController@postAddStaff', 'as' => 'postAddStaff']);
	Route::post('/change-block-status', ['uses' => 'AdminController@postIsBlock', 'as' => 'postIsBlock']);
    Route::post('/changeOrderStatus',['uses' => 'AdminController@changeOrderStatusAdmin', 'as' => 'changeOrderStatusAdmin']);
    Route::post('/save-details-staff', ['uses'=> 'AdminController@postEditDetailsStaff', 'as' => 'postEditDetailsStaff']);
    Route::post('/delete-staff', ['uses' => 'AdminController@postDelStaff', 'as' => 'postDelStaff']);
    Route::post('/change-staff-password', ['uses' => 'AdminController@postChangeStaffPassword', 'as' => 'postChangeStaffPassword']);
    Route::post('/payment', ['uses' => 'PaymentController@AuthoRizePayment', 'as' => 'postPayment']);
    Route::get('/search',['uses' => 'AdminController@getSearchAdmin', 'as' => 'getSearchAdmin']);
    Route::get('/sortby',['uses' => 'AdminController@getSortAdmin','as' => 'sortAdmin']);
    Route::get('/payment', ['uses' => 'PaymentController@getPayment', 'as' => 'getPayment']);
    Route::post('/post-payment-keys', ['uses' => 'PaymentController@postPaymentKeys', 'as' => 'postPaymentKeys']);
    Route::group(['prefix' => 'cms'], function() {
    	Route::get('/dry-clean', ['uses' => 'AdminController@getCmsDryClean', 'as' => 'getCmsDryClean']);
    	Route::post('/save-dry-clean', ['uses' => 'AdminController@postCmsDryClean', 'as' => 'postCmsDryClean']);
    	Route::get('/wash-n-fold', ['uses' => 'AdminController@getCmsWashNFold', 'as' => 'getCmsWashNFold']);
    	Route::post('/save-wash-n-fold', ['uses' => 'AdminController@postCmsWashNFold', 'as' => 'postCmsWashNFold']);
    	Route::get('/corporate', ['uses' => 'AdminController@getCorporate', 'as' => 'getCorporate']);
    	Route::post('/save-corporate', ['uses' => 'AdminController@postCorpoarte' , 'as' => 'postCorpoarte']);
    	Route::get('/tailoring', ['uses' => 'AdminController@getTailoring', 'as' => 'getTailoring']);
    	Route::post('/save-tailoring', ['uses' => 'AdminController@postTailoring', 'as' => 'postTailoring']);
    	Route::get('/wet-cleaning', ['uses' => 'AdminController@getWetCleaning', 'as' => 'getWetCleaning']);
    	Route::post('/save-wet-cleaning',['uses' => 'AdminController@postWetCleaning', 'as' => 'postWetCleaning']);
    });
    Route::post('/save-invoice', ['uses' => 'InvoiceController@postInvoice', 'as' => 'postInvoice']);
    Route::post('/delete-invoice', ['uses' => 'InvoiceController@postDeleteInvoice', 'as' => 'postDeleteInvoice']);
});

//Staff routes
Route::group(['prefix' => 'staff'], function () {
    Route::get('/login',['uses' => 'StaffController@getStaffLogin','as' => 'getStaffLogin']);
    Route::get('/',['uses' => 'StaffController@getStaffIndex','as' => 'getStaffIndex']);
    Route::get('/orders',['uses' => 'StaffController@getStaffOrders', 'as' => 'getStaffOrders']);
    Route::post('/orders',['uses' => 'StaffController@changeOrderStatus', 'as' => 'changeOrderStatus']);
    Route::get('/search',['uses' => 'StaffController@getSearch', 'as' => 'getSearch']);
    Route::post('/login',['uses' => 'StaffController@LoginAttempt', 'as' => 'post-staff-login']);
    Route::get('/logout',['uses' => 'StaffController@getLogout', 'as' => 'getStaffLogout']);
    Route::get('/sort',['uses' => 'StaffController@getSort','as' => 'sort']);
});

//API V.1 routes
Route::group(['prefix' => 'V1'], function () {
    Route::post('/login',['uses' => 'ApiV1\UserApiController@LoginAttempt', 'as' => 'LoginAttempt']);
    Route::post('/order-history',['uses' => 'ApiV1\UserApiController@order_history','as' => 'order_history']);
    Route::post('/place-order',['uses' => 'ApiV1\UserApiController@placeOrder','as' => 'placeOrder']);
    Route::post('/sign-up-user',['uses' => 'ApiV1\UserApiController@userSignUp','as' => 'userSignUp']);
    Route::get('/get-prices',['uses' => 'ApiV1\UserApiController@getPrices', 'as' => 'getPricesApi']);
    Route::get('/get-neighborhoods',['uses' => 'ApiV1\UserApiController@getNeighborhood','as' => 'getNeighborhoodApi']);
    Route::get('/get-faq',['uses' => 'ApiV1\UserApiController@getFaq','as' => 'getFaqApi']);
    Route::post('/contact-us',['uses' => 'ApiV1\UserApiController@contactUs','as' => 'contactUsApi']);
    Route::post('/update-user',['uses' => 'ApiV1\UserApiController@updateProfile','as' => 'updateProfileApi']);
    Route::post('/change-password',['uses' => 'ApiV1\UserApiController@changePassword','as' => 'changePasswordApi']);
    Route::post('/delete-pickup',['uses' => 'ApiV1\UserApiController@deletePickup','as' => 'deletePickupApi']);
}); 