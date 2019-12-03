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

// DON'T Put it inside the '/admin' Prefix , Otherwise you'll never get the page due to assign.guard that will redirect you too many times
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::group(['prefix' => '/admin','middleware' => 'assign.guard:admin,admin/login'],function(){

    Route::get('dashboard', 'AdminPanelController@dashboard');
    Route::resource('categories', 'CategoryController');
    Route::resource('categories/{category}/subcategories', 'SubcategoryController');
    Route::resource('users', 'UsersController');
    Route::resource('admins', 'AdminsController');
    Route::resource('settings', 'SettingController');
    Route::resource('widgets', 'WidgetController');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'web'], function (){

Route::resource('courses', 'CourseController');
Route::resource('courses/{course}/sections', 'SectionController');
Route::resource('courses/{course}/sections/{section}/lectures', 'LectureController');



Route::resource('courses/{course}/sections/{section}/lectures/{lecture}/attachments', 'AttachmentController');
Route::resource('courses/{course}/ratings', 'RatingController');
Route::resource('courses/{course}/favourites', 'FavouriteController');


Route::resource('profile', 'ProfileController');


});