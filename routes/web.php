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

use App\Services\Twitter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index');
Route::get('/twitter', function (Twitter $twitter)
{
    dd($twitter);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'ContactFormController@create')->name('contact.create');
Route::post('/contact', 'ContactFormController@store')->name('contact.store');

Route::view('/about', 'about');

Route::get('forum', 'ForumController@index');
Route::get('forum/{parent?}', 'ForumController@show')->name('forum.show');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'admin'], function ()
    {
        Route::get('users', ['as'=>'admin.user.index', 'uses'=>'UsersController@index']);
        Route::get('roles', 'RolesController@index')->name('roles.index');
        Route::get('roles/create', 'RolesController@create')->name('roles.create');
        Route::post('roles/create', 'RolesController@store')->name('roles.store');
        Route::get('roles/{role?}', 'RolesController@show')->name('roles.show');
        Route::get('roles/{role?}/edit', 'RolesController@edit')->name('roles.edit');
        Route::post('roles/{role?}/edit', 'RolesController@update')->name('roles.update');
        Route::post('roles/{role?}/delete', 'RolesController@destroy')->name('roles.delete');

        Route::get('users', 'UsersController@index')->name('users.index');
        Route::get('users/create', 'UsersController@create')->name('users.create');
        Route::post('users/create', 'UsersController@store')->name('users.store');
        Route::get('users/{user?}', 'UsersController@show')->name('users.show');
        Route::get('users/{user?}/edit', 'UsersController@edit')->name('users.edit');
        Route::post('users/{user?}/edit', 'UsersController@update')->name('users.update');
        Route::post('users/{user?}/delete', 'UsersController@destroy')->name('users.delete');

        Route::resource('subforums', 'SubforumController');

        Route::get('topics', 'TopicController@index')->name('admin.topics.index');
        Route::get('topics/{topic?}', 'TopicController@show')->name('admin.topics.show');
        Route::get('topics/{topic?}/edit', 'TopicController@edit')->name('admin.topics.edit');
        Route::post('topics/{topic?}/edit', 'TopicController@update')->name('admin.topics.update');
        Route::post('topics/{topic?}/delete', 'TopicController@destroy')->name('admin.topics.delete');

        Route::post('/posts/{post?}/delete', 'PostController@destroy')->name('admin.posts.delete');
        Route::view('/', 'admin.admin')->name('admin');
    });

Route::group(['prefix'=>'forum', 'middleware'=>'forum'], function ()
    {
        Route::get('/{parent?}/topics/create', 'TopicController@create')->name('topics.create');
        Route::post('/topics/create', 'TopicController@store')->name('topics.store');
        Route::post('/posts/create', 'PostController@store')->name('posts.store');
        Route::get('{subforum?}/posts/{post?}/edit', 'PostController@edit')->name('posts.edit');
        Route::post('/posts/{post?}/edit', 'PostController@update')->name('posts.update');
        Route::get('{subforum?}/topics/{topic?}/posts/{post?}/reply', 'PostController@reply')
            ->name('posts.reply');
    });

Route::get('/forum/{parent?}/topics/{topic?}', 'TopicController@show')->name('topics.show');

Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');