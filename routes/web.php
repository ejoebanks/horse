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
Route::group(['middleware' => 'admin'], function () {
    //Admin Page
    Route::get('/admin', function () {
        return view('admin.admin');
    });

    //CRUDS
    Route::resource('users', 'UserController');
    Route::resource('buildings', 'BuildingController');
    Route::resource('services', 'ServiceController');
    Route::resource('orders', 'OrderController');
    Route::resource('locations', 'LocationController');

    //Confirm or deny orders
    Route::get('/reject/{id}', 'OrderController@rejectOrder');
    Route::get('/deny/{id}', 'OrderController@cancelOrder');
    Route::get('/confirm/{id}', 'OrderController@approveOrder');
    Route::get('/complete/{id}', 'OrderController@completeOrder');

    // Appointment list (requests, pending, complete)
    Route::get('/home', 'OrderController@homeList');
    Route::post('/calendar', 'OrderController@updateDate');
});


//Ensuring user is logged in
Route::group(['middleware' => 'auth' ], function () {
    //Orders List page
    Route::get('/ordersummary', 'OrderController@listOrders');

    //Order Placing
    Route::post('/schedule', 'OrderController@scheduleAppt');

    Route::get('/schedule', function () {
        return view('appointment');
    });

    //Account details update
    Route::get('/update/user/{id}', 'UserController@singleEdit');
    Route::post('/update/user/{id}', 'UserController@singleUpdate');

    //View Order
    Route::get('/view/{id}', 'OrderController@appointment');

    //View Last Submitted Orders
    Route::get('/submitted', 'OrderController@lastOrder');

    // Order revision
    Route::get('/revise/{id}', 'OrderController@reviseReview');
    Route::post('/revise/{id}', 'OrderController@reviseSubmit');

    // View Appointment
    Route::get('/view/{id}', 'OrderController@appointment');
});

// Gallery
Route::get('/gallery', function () {
    return view('gallery');
});

// Contact Form
Route::get('/contact', 'ContactController@show');
Route::post('/contact', 'ContactController@mailToAdmin');

// Landing Page
Route::get('', function () {
    return view('landing');
});

// Tentative Schedule
Route::get('/tentative', function () {
    return view('tentative');
});

Auth::routes();

// Calendar View
Route::get('/calendar', 'OrderController@calendar');

// Login Functions
Route::get('login', array(
    'uses' => 'MainController@showLogin'
));

Route::post('login', array(
    'uses' => 'MainController@doLogin'
));

Route::get('logout', array(
    'uses' => 'MainController@doLogout'
));

Auth::routes();
