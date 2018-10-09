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
    return view('welcome');
});

Route::get('/upload', function () {
    return view('layouts.upload');
});

Route::get('/admin', function () {
    return view('/gpa/admin');
});

Auth::routes();

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
Route::get(
    '/',
function () {
    return view('welcome');
}
);

Auth::routes();

Route::get('/gpa', 'GPAController@index');

//CRUDS
Route::resource('users', 'UserController');
Route::resource('courses', 'CourseController');
Route::resource('colleges', 'CollegeController');
Route::resource('grade', 'GradeController');


//User edits for grade
Route::get('/edits/grades/{id}', 'GradeController@singleEdit');
Route::post('/edits/grade/{id}', 'GradeController@singleUpdate');
Route::delete('/deletes/grade/{id}', 'GradeController@singleDestroy');

//Store Grade from user input
Route::post('/home', 'GradeController@storeHome');

//Account details update
Route::get('/update/user/{id}', 'UserController@singleEdit');
Route::post('/update/user/{id}', 'UserController@singleUpdate');

//Calculate Page
Route::post('/calculate', function () {
    return view('calculate');
});
Route::get('/calculate', function () {
    return view('calculate');
});

Route::get('/schedule', function () {
    return view('appointment');
});


Route::get('/results', function () {
    return view('results');
});


Route::post('/calcterm', function () {
    return view('calcterm');
});
Route::get('/calcterm', function () {
    return view('calcterm');
});

Route::post('/test', function () {
    return view('testpage');
});
Route::get('/test', function () {
    return view('testpage');
});

Route::get('/horse', function () {
    return view('horseadmin');
});
