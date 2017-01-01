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

    return time();

    $disk = \Storage::disk('qiniu');
//    $disk->put('images/file.jpg',fopen('images/avatar/head.jpg','r+'));
    dd($disk->privateDownloadUrl('images/page/work.jpg'));
//    $disk->get('style.css');       //获取文件内容
//    $contents = "/public/css/search.css";
//    $disk->put('search.css',$contents);

//    dd($disk->privateDownloadUrl('/css/style.css'));
});
Route::get('/download','Home\SeriesController@videoDownload');

Route::get('/show',function(){
    $discussion = \App\Discussion::find(18);
    dd($discussion);
//    $discussion->delete();
    return "delete done";
    dd(\Auth::user()->unreadNotifications->count());
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
    Route::patch('/account/{id}','UserController@userUpdate');
    //头像上传修改
    Route::post('/avatar','UserController@changeAvatar');
    Route::post('/crop/api','UserController@cropAvatar');

    //用户的第三方登录
    Route::get('/login/{style}','LoginController@driver');
    Route::delete('/socialite/relieve/{id}','LoginController@SocialiteRelieve');

    //站内通知
    Route::get('/notifications','NotificationController@index');
    Route::get('/notifications/all','NotificationController@allInfo');
    Route::get('/notifications/message','NotificationController@message');
    Route::get('/notifications/read','NotificationController@markAsRead');
});


Route::group(['namespace' => 'Home'],function(){
    Route::get('/logout','UserController@logout');//退出当前用户
    Route::get('/u/{user_name}','UserController@profile');//用户的个人主页
    Route::get('/verify/token/{confirm_code}','UserController@confirmEmail');//邮箱的验证

    //github登录
    Route::get('/github/callback','LoginController@githubLogin');
    Route::get('/weibo/callback','LoginController@weiboLogin');
    Route::get('/wechat/callback','LoginController@wechatLogin');
    Route::get('/qq/callback','LoginController@qqLogin');
    Route::get('/google/callback','LoginController@googleLogin');
});

Route::group(['namespace' => 'Home'],function(){
    //视频系列
    Route::get('/series/{series_name}','VideosController@videoSeriesList');
    Route::get('/series/{series_name}/video/{video_index}','VideosController@videoPlay');
    //帖子文章
    Route::resource('/discussion','DiscussionsController');
    Route::resource('/article','ArticlesController');
    Route::paginate('discussion', 'DiscussionsController@index');
    Route::paginate('article', 'ArticlesController@index');

    //markdown文本图片上传
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
    Route::get('/search/post','SearchController@searchPost');
    Route::get('/search/article','SearchController@searchArticle');
    Route::get('/search/video','SearchController@searchVideo');
    Route::post('/search/loadPost','SearchController@loadPost');
    Route::post('/search/loadArticle','SearchController@loadArticle');
    Route::post('/search/loadVideo','SearchController@loadVideo');
});

//登录验证码
Route::get('/captcha/{config?}',function(\Mews\Captcha\Captcha $captcha,$config='default'){
    return $captcha->create($config);
});
