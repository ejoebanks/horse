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
});


Route::group( ['middleware' => 'auth' ], function()
{

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

});


Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/contact', 'ContactController@show');
Route::post('/contact',  'ContactController@mailToAdmin');


Route::get('', function () {
    return view('landing');
});


Route::get('/tentative', function () {
    return view('tentative');
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


//Confirm or deny orders
Route::get('/reject/{id}', 'OrderController@rejectOrder');
Route::get('/deny/{id}', 'OrderController@cancelOrder');
Route::get('/confirm/{id}', 'OrderController@approveOrder');
Route::get('/complete/{id}', 'OrderController@completeOrder');
