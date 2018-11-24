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
Route::get('/admin', function () {
    return view('admin.admin');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('', function () {
    return view('landing');
});

Route::get('/submitted', function () {
    return view('layouts.orderplaced');
});

Auth::routes();

Route::get('/calendar', 'OrderController@calendar');
Route::post('/calendar', 'OrderController@updateDate');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login', array(
    'uses' => 'MainController@showLogin'
));

// Route to process the form
Route::post('login', array(
    'uses' => 'MainController@doLogin'
));

Route::get('logout', array(
    'uses' => 'MainController@doLogout'
));

Auth::routes();

//CRUDS
Route::resource('users', 'UserController');
Route::resource('buildings', 'BuildingController');
Route::resource('services', 'ServiceController');
Route::resource('orders', 'OrderController');
Route::resource('locations', 'LocationController');

Route::get('/view/{id}', 'OrderController@appointment');

Route::get('/home', 'OrderController@homeList');

// Order revision
Route::get('/revise/{id}', 'OrderController@reviseReview');
Route::post('/revise/{id}', 'OrderController@reviseSubmit');

//Orders List page
Route::get('/ordersummary', 'OrderController@listOrders');

//Confirm or deny orders
Route::get('/deny/{id}', 'OrderController@cancelOrder');
Route::get('/confirm/{id}', 'OrderController@approveOrder');

//Account details update
Route::get('/update/user/{id}', 'UserController@singleEdit');
Route::post('/update/user/{id}', 'UserController@singleUpdate');

Route::post('/schedule', 'OrderController@scheduleAppt');



Route::get('/calculate', function () {
    return view('calculate');
});

Route::get('/schedule', function () {
    return view('appointment');
});
