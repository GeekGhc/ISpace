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

Route::get('/','Home\UserController@index');

//主页首页
Route::get('/mypage',function(){

    return view('welcome');
});

//登录验证码
Route::get('/captcha/{config?}',function(\Mews\Captcha\Captcha $captcha,$config='default'){
    return $captcha->create($config);
});

//用户组路由
Route::group(['namespace' => 'Home','prefix'=>'user'], function () {
    Route::get('/login','UserController@login');
    Route::post('/register','UserController@store');
    Route::get('/register','UserController@register');
    Route::post('/login','UserController@signin');

    Route::get('/login/{github}','LoginController@driver');
    Route::get('/login/{weibo}','LoginController@driver');
    Route::get('/login/{qq}','LoginController@driver');
    Route::get('/login/{weixin}','LoginController@driver');
});


Route::group(['namespace' => 'Home'],function(){
    Route::get('/logout','UserController@logout');//退出当前用户
    Route::get('verify/token/{confirm_code}','UserController@confirmEmail');//邮箱的验证

    Route::get('/github/login','LoginController@githubLogin');
});

Route::group(['namespace' => 'Home'],function(){
    Route::resource('/discussion','DiscussionsController');

    /*Route::get('/discussion','DiscussionsController@index');
    Route::get('/discussion/create','DiscussionsController@create');
    Route::get('/discussion/{id}','DiscussionsController@show');*/
    Route::post('/post/upload','PostController@upload');

    Route::resource('/article','ArticlesController');
   /* Route::get('/article','ArticlesController@index');
    Route::get('/articles/create','ArticleController@create');*/
});
