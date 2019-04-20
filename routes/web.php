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
        # dashboard
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');

        # menu profile
        Route::get('profile', 'ProfileController@index')->name('admin.profile');

        # menu edit profile
        Route::get('profile/edit', 'ProfileController@edit')->name('admin.profile.edit');

        #update profile
        Route::post('profile/update/data','ProfileController@updateData')->name('admin.profile.update.data');
        Route::post('profile/update/password','ProfileController@updatePassword')->name('admin.profile.update.password');
        Route::post('profile/update/displayPicture','ProfileController@updateDisplayPicture')->name('admin.profile.update.displayPicture');

        # menu users
        Route::get('users', 'UsersController@index')->name('admin.users');

        # menu detail user
        Route::get('users/show/{username}', 'UsersController@showDetail')->name('admin.users.show');

    });
});

Route::prefix('teacher')->group(function ()
{
    Route::group(['namespace' => 'Teacher','middleware' => 'App\Http\Middleware\TeacherMiddleware'], function()
    {
        # dashboard teacher route
        Route::get('dashboard', 'TeacherController@dashboard')->name('teacher.dashboard');

        # menu profile
        Route::get('profile', 'ProfileController@index')->name('teacher.profile');

        # menu edit profile
        Route::get('profile/edit', 'ProfileController@edit')->name('teacher.profile.edit');

        #update profile
        Route::post('profile/update/data','ProfileController@updateData')->name('teacher.profile.update.data');
        Route::post('profile/update/password','ProfileController@updatePassword')->name('teacher.profile.update.password');
        Route::post('profile/update/displayPicture','ProfileController@updateDisplayPicture')->name('teacher.profile.update.displayPicture');

    });
});

Route::prefix('student')->group(function ()
{
    Route::group(['namespace' => 'Student','middleware' => 'App\Http\Middleware\StudentMiddleware'], function()
    {
        # dashboard student route
        Route::get('dashboard', 'StudentController@dashboard')->name('student.dashboard');

        # menu profile
        Route::get('profile', 'ProfileController@index')->name('student.profile');

        # menu edit profile
        Route::get('profile/edit', 'ProfileController@edit')->name('student.profile.edit');

        #update profile
        Route::post('profile/update/data','ProfileController@updateData')->name('student.profile.update.data');
        Route::post('profile/update/password','ProfileController@updatePassword')->name('student.profile.update.password');
        Route::post('profile/update/displayPicture','ProfileController@updateDisplayPicture')->name('student.profile.update.displayPicture');

    });
});

