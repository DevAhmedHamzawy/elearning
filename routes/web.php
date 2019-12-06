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
Route::resource('courses/{course}/sections', 'SectionController', ['only' => ['store', 'show', 'update', 'destroy']]);
Route::resource('courses/{course}/sections/{section}/lectures', 'LectureController', ['only' => ['store', 'show', 'update', 'destroy']]);



Route::resource('courses/{course}/sections/{section}/lectures/{lecture}/attachments', 'AttachmentController', ['only' => ['index', 'store']]);
Route::resource('courses/{course}/ratings', 'RatingController', ['only' => ['store', 'update']]);
Route::resource('courses/{course}/favourites', 'FavouriteController', ['only' => ['store', 'destroy']]);


Route::resource('profile', 'ProfileController', ['only' => ['show', 'edit', 'update']]);

Route::get('/watch-course/{course}', 'WatchCourseController@index')->name('course.learning');
Route::post('/course/complete-lecture/{lecture}', 'WatchCourseController@completeLecture');
Route::get('/course/{course}/lecture/{lecture}', 'WatchCourseController@showLecture')->name('course.watch');

});