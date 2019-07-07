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
    Route::get('/register/teacher','LandingController@registerTeacher')->name('landing.registerTeacher');

    Route::post('store/teacher','LandingController@storeTeacher')->name('store.teacher');
});

Auth::routes();

Route::group(['namespace' => 'Globals'], function()
{
    Route::prefix('admin')->group(function (){
        Route::group(['middleware' => 'admin'], function() {

            # Category admin menu
            Route::get('category','CategoryController@index')->name('admin.category');
            Route::get('category/add','CategoryController@add')->name('admin.category.add');
            Route::post('category/store','CategoryController@store')->name('admin.category.store');
            Route::get('category/edit/{id}','CategoryController@edit')->name('admin.category.edit');
            Route::post('category/update/{id}','CategoryController@update')->name('admin.category.update');
            Route::get('category/delete/{id}','CategoryController@delete')->name('admin.category.delete');
            Route::get('category/show/{id}','CategoryController@show')->name('admin.category.show');

            # Tags admin menu
            Route::get('tags','TagsController@index')->name('admin.tags');
            Route::get('tags/delete/{id}','TagsController@delete')->name('admin.tags.delete');
        });
    });

    # Tags store Global
    Route::post('tags/store','TagsController@store')->name('tags.store');
});

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

        # Points admin
        Route::get('points','PointsController@index')->name('admin.points');
        Route::get('points/topup/{id}','PointsController@topup')->name('admin.points.topup');
        Route::post('points/update/topup/{id}','PointsController@updateTopup')->name('admin.points.update.topup');
        Route::get('points/withdraw/{id}','PointsController@withdraw')->name('admin.points.withdraw');
        Route::post('points/update/withdraw/{id}','PointsController@updateWithdraw')->name('admin.points.update.withdraw');

        # Support admin
        Route::get('support','SupportController@index')->name('admin.support');

        # Statistic admin
        Route::get('statistic','StatisticController@index')->name('admin.statistic');

        # Notify admin
        Route::get('notify','NotifyController@index')->name('admin.notify');
        Route::post('notify/sendAll','NotifyController@sendAll')->name('admin.notify.send_all');
        Route::post('notify/sendSingle','NotifyController@sendSingle')->name('admin.notify.send_single');
        Route::post('notify/sendMultiple','NotifyController@sendMultiple')->name('admin.notify.send_multiple');
        Route::get('notify/detail/{id}','NotifyController@detail')->name('admin.notify.detail');

        Route::get('notify/read/{id}/{title}','NotifyController@read')->name('admin.notify.read');
        Route::get('notify/viewAll','NotifyController@viewAll')->name('admin.notify.viewAll');
        Route::get('notify/readable','NotifyController@readableTable')->name('admin.notify.readable');
        Route::get('notify/unreadable','NotifyController@unreadableTable')->name('admin.notify.unreadable');
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

        Route::get('notify/viewAll','NotifyController@viewAll')->name('teacher.notify.viewAll');
        Route::get('notify/readable','NotifyController@readableTable')->name('teacher.notify.readable');
        Route::get('notify/unreadable','NotifyController@unreadableTable')->name('teacher.notify.unreadable');

        Route::get('notify/read/{id}/{title}','NotifyController@read')->name('teacher.notify.read');

        Route::get('article','ArticleController@index')->name('teacher.article');
        Route::get('article/add','ArticleController@add')->name('teacher.article.add');
        Route::post('article/store','ArticleController@storeBlogs')->name('teacher.article.store');

        Route::group(['middleware' => 'article.owner'], function () {
            Route::get('article/detail/{id}','ArticleController@detailBlogs')->name('teacher.article.detail');
            Route::get('article/edit/{id}','ArticleController@editBlogs')->name('teacher.article.edit');
            Route::post('article/update/data/{id}','ArticleController@updateBlogsData')->name('teacher.article.update.data');
            Route::post('article/update/thumbnail/{id}','ArticleController@updateBlogsThumbnail')->name('teacher.article.update.thumbnail');
            Route::post('article/update/body/{id}','ArticleController@updateBlogsBody')->name('teacher.article.update.body');
            Route::get('article/delete/{id}','ArticleController@deleteBlogs')->name('teacher.article.delete');
        });

        Route::get('courses','CoursesController@index')->name('teacher.courses');
        Route::get('courses/add','CoursesController@add')->name('teacher.courses.add');
        Route::post('courses/storeCourses','CoursesController@storeCourse')->name('teacher.courses.storeCourse');

        Route::group(['middleware' => 'course_data.owner'], function () {
            Route::get('courses/details/{id}','CoursesController@detailCourse')->name('teacher.courses.detailCourses');
            Route::post('courses/update/data/{id}','CoursesController@editCourseData')->name('teacher.courses.editDataCourse');
            Route::post('courses/update/thumbnail/{id}','CoursesController@editCourseThumbnail')->name('teacher.courses.editDataThumbnail');
        });

        Route::group(['middleware' => 'course_videos.owner'], function () {
            Route::get('courses/videoCourse/{id}','CoursesController@editVideoCourse')->name('teacher.courses.video');
            Route::get('course/videoCourse/{id}/detail/{slug}','CoursesController@videoDetail')->name('teacher.course.video.detail');
        });

        Route::get('courses/videoCourse/add/{id}','CoursesController@addVideoCourse')->name('teacher.courses.video.add');
        Route::post('courses/videoCourse/store/{id}','CoursesController@storeVideoCourse')->name('teacher.courses.video.store');
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

        # Notify
        Route::get('notify/viewAll','NotifyController@viewAll')->name('student.notify.viewAll');
        Route::get('notify/readable','NotifyController@readableTable')->name('student.notify.readable');
        Route::get('notify/unreadable','NotifyController@unreadableTable')->name('student.notify.unreadable');

        Route::get('notify/read/{id}/{title}','NotifyController@read')->name('student.notify.read');

        Route::get('discussion','DiscussionController@index')->name('student.discussion');
        Route::get('discussion/add','DiscussionController@add')->name('student.discussion.add');
        Route::post('discussion/store','DiscussionController@store')->name('student.discussion.store');
    });
});
