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

//    return view('welcome');
    dd(\App\Comment::where('to_comment_id',10)->first()?1:0);
});

//登录验证码
Route::get('/captcha/{config?}',function(\Mews\Captcha\Captcha $captcha,$config='default'){
    return $captcha->create($config);
});

//用户组路由
Route::group(['namespace' => 'Home','prefix'=>'user'], function () {
    //用户登录注册
    Route::get('/login','UserController@login');
    Route::post('/register','UserController@store');
    Route::get('/register','UserController@register');
    Route::post('/login','UserController@signin');

    //用户的第三方登录
    Route::get('/login/{github}','LoginController@driver');
    Route::get('/login/{weibo}','LoginController@driver');
    Route::get('/login/{qq}','LoginController@driver');
    Route::get('/login/{weixin}','LoginController@driver');
});


Route::group(['namespace' => 'Home'],function(){
    Route::get('/logout','UserController@logout');//退出当前用户
    Route::get('/u/{user_name}','UserController@profile');//用户的个人主页
    Route::get('/verify/token/{confirm_code}','UserController@confirmEmail');//邮箱的验证

    Route::get('/github/login','LoginController@githubLogin');
});

Route::group(['namespace' => 'Home'],function(){
    //帖子文章
    Route::resource('/discussion','DiscussionsController');
    Route::resource('/article','ArticlesController');

    //文本图片上传
    Route::post('/post/upload','PostController@upload');

    //用户收藏
    Route::post('/favPost','FavoritesController@favoritePost');
    Route::post('/favArticle','FavoritesController@favoriteArticle');
    Route::post('/favVideo','FavoritesController@favoriteVideo');

    //用户评论
    Route::post('/commentPost','CommentsController@storePost');
    Route::post('/commentArticle','CommentsController@storeArticle');
    Route::post('/commentVideo','CommentsController@storeVideo');

    //站内搜索
    Route::get('/search','UserController@search');
    
});
