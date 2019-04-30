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
    Route::group(['namespace' => 'Admin'], function()
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

        # add users
        Route::get('users/add', 'UsersController@addUser')->name('admin.users.add');
        Route::post('users/store','UsersController@addAccount')->name('admin.users.store');

        # menu detail user
        Route::get('users/show/{id}', 'UsersController@showDetail')->name('admin.users.show');

        # edit users
        Route::get('users/edit/{id}','UsersController@editUser')->name('admin.users.edit');

        # update data users
        Route::post('users/update/data/{id}','UsersController@updateData')->name('admin.users.update.data');
        Route::post('users/update/password/{id}','UsersController@updatePassword')->name('admin.users.update.password');
        Route::post('users/update/displayPicture/{id}','UsersController@updateDisplayPicture')->name('admin.users.update.displayPicture');

        # update Status User
        Route::post('users/update/status/deactivate/{id}','UsersController@changeStatusDeactivate')->name('admin.users.update.status.deactivate');
        Route::post('users/update/status/active/{id}','UsersController@changeStatusActive')->name('admin.users.update.status.active');

        #blog Admin
        Route::get('blogs','BlogsController@index')->name('admin.blogs');

        #funding Admin
        Route::get('funding','FundingController@index')->name('admin.funding');

        #support Admin
        Route::get('support','SupportController@index')->name('admin.support');

        #statistic Admin
        Route::get('statistic','StatisticController@index')->name('admin.statistic');

        #notify Admin
        Route::get('notify','NotifyController@index')->name('admin.notify');
    });
});

Route::prefix('teacher')->group(function ()
{
    Route::group(['namespace' => 'Teacher'], function()
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
    Route::group(['namespace' => 'Student'], function()
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
