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

Route::get('/test',function(){

    $disk = \Storage::disk('qiniu');
//    $disk->put('images/file.jpg',fopen('images/avatar/head.jpg','r+'));
//    $disk->privateDownloadUrl('style.css');
//    $disk->get('style.css');       //获取文件内容
//    $contents = "/public/css/search.css";
//    $disk->put('search.css',$contents);

    dd($disk->privateDownloadUrl('/css/style.css'));
});
Route::get('/download','Home\SeriesController@videoDownload');

Route::get('/show',function(){
    $discussion = \App\Discussion::find(17);
    foreach ($discussion->tags as $tag) {
         return $tag->type;
    }
});

Route::get('/','Home\UserController@index');

//个人主页首页
Route::get('/mypage',function(){
    return view('welcome');
});


//用户组路由
Route::group(['namespace' => 'Home','prefix'=>'user'], function () {
    //用户登录注册
    Route::get('/login','UserController@login');
    Route::post('/register','UserController@store');
    Route::get('/register','UserController@register');
    Route::post('/login','UserController@signin');

    //用户密码修改
    Route::get('/password','PasswordController@password');
    Route::post('/password_edit','PasswordController@passwordEdit');

    //用户密码重置
    Route::get('/password/forget','PasswordController@passwordForget');
    Route::post('/password/forget/send_email','PasswordController@passwordSendEmail');
    Route::get('/password/reset/token/{password_token}','PasswordController@passwordReset');
    Route::post('/password/reset/edit','PasswordController@passwordResetEdit');

    //用户账户设置
    Route::get('/account','UserController@userAccount');


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

    //github登录
    Route::get('/github/login','LoginController@githubLogin');
    Route::get('/weibo/login','LoginController@weiboLogin');
    Route::get('/weixin/login','LoginController@weixinLogin');
    Route::get('/qq/login','LoginController@qqLogin');
});

Route::group(['namespace' => 'Home'],function(){
    //视频系列
    Route::get('/series/{series_name}','SeriesController@videoSeriesList');
    Route::get('/series/{series_name}/video/{video_index}','SeriesController@videoPlay');
    //帖子文章
    Route::resource('/discussion','DiscussionsController');
    Route::resource('/article','ArticlesController');
    Route::paginate('discussion', 'DiscussionsController@index');
    Route::paginate('article', 'ArticlesController@index');


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

//登录验证码
Route::get('/captcha/{config?}',function(\Mews\Captcha\Captcha $captcha,$config='default'){
    return $captcha->create($config);
});
