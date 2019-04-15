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

Route::group(['namespace' => 'Landing'], function()
{
    # landing page route
    Route::get('/', 'LandingController@index')->name('landing');

});


Auth::routes();

Route::prefix('admin')->group(function ()
{
    Route::group(['namespace' => 'Admin','middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
    {
        # dashboard admin route
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');

        # menu users admin route
        Route::get('profile', 'AdminController@profile')->name('admin.profile');

        # menu users admin route
        Route::get('users', 'UsersController@index')->name('admin.users');

        # menu detail user admin route
        Route::get('users/show/{username}', 'UsersController@showDetail')->name('admin.users.show');

    });
});

Route::prefix('teacher')->group(function ()
{
    Route::group(['namespace' => 'Teacher','middleware' => 'App\Http\Middleware\TeacherMiddleware'], function()
    {
        # dashboard teacher route
        Route::get('dashboard', 'TeacherController@dashboard')->name('teacher.dashboard');

    });
});

Route::prefix('student')->group(function ()
{
    Route::group(['namespace' => 'Student','middleware' => 'App\Http\Middleware\StudentMiddleware'], function()
    {
        # dashboard student route
        Route::get('dashboard', 'StudentController@dashboard')->name('student.dashboard');

    });
});

