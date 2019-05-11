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
    # Landing page route
    Route::get('/', 'LandingController@index')->name('landing');

});

Auth::routes();

Route::prefix('admin')->group(function ()
{
    Route::group(['namespace' => 'Admin'], function()
    {
        # Dashboard admin
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');

        # Menu profile
        Route::get('profile', 'ProfileController@index')->name('admin.profile');

        # Menu Edit profile
        Route::get('profile/edit', 'ProfileController@edit')->name('admin.profile.edit');

        # Update profile
        Route::post('profile/update/data','ProfileController@updateData')->name('admin.profile.update.data');
        Route::post('profile/update/password','ProfileController@updatePassword')->name('admin.profile.update.password');
        Route::post('profile/update/displayPicture','ProfileController@updateDisplayPicture')->name('admin.profile.update.displayPicture');

        # Menu users
        Route::get('users', 'UsersController@index')->name('admin.users');

        # Add users
        Route::get('users/add', 'UsersController@addUser')->name('admin.users.add');
        Route::post('users/store','UsersController@addAccount')->name('admin.users.store');

        # Menu detail users
        Route::get('users/show/{id}', 'UsersController@showDetail')->name('admin.users.show');

        # Edit users
        Route::get('users/edit/{id}','UsersController@editUser')->name('admin.users.edit');

        # Update data users
        Route::post('users/update/data/{id}','UsersController@updateData')->name('admin.users.update.data');
        Route::post('users/update/password/{id}','UsersController@updatePassword')->name('admin.users.update.password');
        Route::post('users/update/displayPicture/{id}','UsersController@updateDisplayPicture')->name('admin.users.update.displayPicture');

        # Update status user
        Route::post('users/update/status/deactivate/{id}','UsersController@changeStatusDeactivate')->name('admin.users.update.status.deactivate');
        Route::post('users/update/status/active/{id}','UsersController@changeStatusActive')->name('admin.users.update.status.active');

        # Blog admin
        Route::get('blogs','BlogsController@index')->name('admin.blogs.index');
        Route::get('blogs/add','BlogsController@add')->name('admin.blogs.add');
        Route::post('blogs/store','BlogsController@storeBlogs')->name('admin.blogs.store');

        Route::get('blogs/detail/{id}','BlogsController@detailBlogs')->name('admin.blogs.detail');
        Route::get('blogs/edit/{id}','BlogsController@editBlogs')->name('admin.blogs.edit');
        Route::post('blogs/update/data/{id}','BlogsController@updateBlogsData')->name('admin.blogs.update.data');
        Route::post('blogs/update/thumbnail/{id}','BlogsController@updateBlogsThumbnail')->name('admin.blogs.update.thumbnail');
        Route::post('blogs/update/body/{id}','BlogsController@updateBlogsBody')->name('admin.blogs.update.body');
        Route::get('blogs/delete/{id}','BlogsController@deleteBlogs')->name('admin.blogs.delete');

        # Blog category admin
        Route::get('blogs/category','BlogsController@category_index')->name('admin.blogs.category.index');
        Route::get('blogs/category/add','BlogsController@addCategory')->name('admin.blogs.category.add');
        Route::post('blogs/category/store','BlogsController@storeCategory')->name('admin.blogs.category.store');
        Route::get('blogs/category/edit/{id}','BlogsController@editCategory')->name('admin.blogs.category.edit');
        Route::post('blogs/category/update/{id}','BlogsController@updateCategory')->name('admin.blogs.category.update');
        Route::get('blogs/category/delete/{id}','BlogsController@deleteCategory')->name('admin.blogs.category.delete');
        Route::get('blogs/category/show/{id}','BlogsController@showCategory')->name('admin.blogs.category.show');

        # Funding admin
        Route::get('funding','FundingController@index')->name('admin.funding');

        # Support admin
        Route::get('support','SupportController@index')->name('admin.support');

        # Statistic admin
        Route::get('statistic','StatisticController@index')->name('admin.statistic');

        # Notify admin
        Route::get('notify','NotifyController@index')->name('admin.notify');

        # Tags admin
        Route::get('tags','TagsController@index')->name('admin.tags');
        Route::post('tags/store','TagsController@storeTags')->name('admin.tags.store');
        Route::get('tags/delete/{id}','TagsController@deleteTags')->name('admin.tags.delete');
    });
});

Route::prefix('teacher')->group(function ()
{
    Route::group(['namespace' => 'Teacher'], function()
    {
        # Dashboard teacher route
        Route::get('dashboard', 'TeacherController@dashboard')->name('teacher.dashboard');

        # Menu profile
        Route::get('profile', 'ProfileController@index')->name('teacher.profile');

        # Menu edit profile
        Route::get('profile/edit', 'ProfileController@edit')->name('teacher.profile.edit');

        # Update profile
        Route::post('profile/update/data','ProfileController@updateData')->name('teacher.profile.update.data');
        Route::post('profile/update/password','ProfileController@updatePassword')->name('teacher.profile.update.password');
        Route::post('profile/update/displayPicture','ProfileController@updateDisplayPicture')->name('teacher.profile.update.displayPicture');

    });
});

Route::prefix('student')->group(function ()
{
    Route::group(['namespace' => 'Student'], function()
    {
        # Dashboard student route
        Route::get('dashboard', 'StudentController@dashboard')->name('student.dashboard');

        # Menu profile
        Route::get('profile', 'ProfileController@index')->name('student.profile');

        # Menu edit profile
        Route::get('profile/edit', 'ProfileController@edit')->name('student.profile.edit');

        # Update profile
        Route::post('profile/update/data','ProfileController@updateData')->name('student.profile.update.data');
        Route::post('profile/update/password','ProfileController@updatePassword')->name('student.profile.update.password');
        Route::post('profile/update/displayPicture','ProfileController@updateDisplayPicture')->name('student.profile.update.displayPicture');

    });
});
