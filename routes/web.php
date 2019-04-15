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

Route::view('/','home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'ContactFormController@create')->name('contact.create');
Route::post('/contact', 'ContactFormController@store')->name('contact.store');

Route::view('/about', 'about');

Route::resource('customers', 'CustomerController');
Route::get('forum', 'ForumController@index');
Route::get('forum/{id?}', 'ForumController@show')->name('forum.show');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'admin'], function ()
    {
        Route::get('users', ['as'=>'admin.user.index', 'uses'=>'UsersController@index']);
        Route::get('roles', 'RolesController@index')->name('roles.index');
        Route::get('roles/create', 'RolesController@create')->name('roles.create');
        Route::post('roles/create', 'RolesController@store')->name('roles.store');

        Route::get('users', 'UsersController@index')->name('users.index');
        Route::get('users/create', 'UsersController@create')->name('users.create');
        Route::post('users/create', 'UsersController@store')->name('users.store');
        Route::get('users/{id?}/edit', 'UsersController@edit')->name('users.edit');
        Route::post('users/{id?}/edit', 'UsersController@update')->name('users.update');

        Route::resource('subforums', 'SubforumController');

        Route::get('/topics', 'TopicController@index')->name('admin.topics.index');
        Route::get('/topics/{id?}', 'TopicController@show')->name('admin.topics.show');
        Route::get('/topics/{topic?}/edit', 'TopicController@edit')->name('admin.topics.edit');
        Route::post('/topics/{topic?}/edit', 'TopicController@update')->name('admin.topics.update');
        Route::post('/topics/{topic?}/delete', 'TopicController@destroy')->name('admin.topics.delete');

        Route::post('/posts/{post?}/delete', 'PostController@destroy')->name('admin.posts.delete');
        Route::view('/', 'admin.admin')->name('admin');
    });

Route::group(['prefix'=>'forum', 'middleware'=>'forum'], function ()
    {
        Route::get('/{id?}/topics/create', 'TopicController@create')->name('topics.create');
        Route::post('/topics/create', 'TopicController@store')->name('topics.store');
        Route::post('/posts/create', 'PostController@store')->name('posts.store');
        Route::get('/posts/{post?}/edit', 'PostController@edit')->name('posts.edit');
        Route::post('/posts/{post?}/edit', 'PostController@update')->name('posts.update');
    });

Route::get('/forum/topics/{id?}', 'TopicController@show')->name('topics.show');