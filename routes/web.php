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
  /* $music = [
        'title'=>"一个人",
        'author'=>"夏婉安",
        'song_uri'=>"https://ol7nwmu54.qnssl.com/%E5%A4%8F%E5%A9%89%E5%AE%89%20-%20%E4%B8%80%E4%B8%AA%E4%BA%BA.mp3",
        'song_pic'=>"https://ol7nwmu54.qnssl.com/6064906139059719.jpg",
        'description'=>"你跟我说，你喜欢用网易音乐，为了接近你，我也去用了，并想着在每一首歌下都留下自己的痕迹，这样你看到我的时候，就会想到我了吧"
    ];*/
    $music = [
        'title'=>"那时候的我",
        'author'=>"刘惜君",
        'song_uri'=>"https://ol7nwmu54.qnssl.com/%E5%88%98%E6%83%9C%E5%90%9B%20-%20%E9%82%A3%E6%97%B6%E5%80%99%E7%9A%84%E6%88%91.mp3",
        'song_pic'=>"https://ol7nwmu54.qnssl.com/24189255827136.jpg",
        'description'=>"这也是非常喜欢的一首刘惜君的歌"
    ];
    \App\Music::create($music);
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

    Route::get('/favorites','FavoritesController@posts');
    Route::get('/favorites/articles','FavoritesController@articles');
    Route::get('/favorites/videos','FavoritesController@videos');
});


Route::group(['namespace' => 'Home'],function(){
    Route::get('/logout','UserController@logout');//退出当前用户
    Route::get('/verify/token/{confirm_code}','UserController@confirmEmail');//邮箱的验证
    Route::get('/u/{user_name}','ProfileController@post');//用户的个人主页
    Route::get('/u/{user_name}/posts','ProfileController@post');
    Route::get('/u/{user_name}/articles','ProfileController@article');
    Route::get('/u/{user_name}/answers','ProfileController@answer');
    Route::get('/u/{user_name}/followers','ProfileController@follower');
    Route::get('/u/{user_name}/followings','ProfileController@following');
    Route::get('/u/{user_name}/timeLine','ProfileController@timeLine');

    //github登录
    Route::get('/github/callback','LoginController@githubLogin');
    Route::get('/weibo/callback','LoginController@weiboLogin');
    Route::get('/wechat/callback','LoginController@wechatLogin');
    Route::get('/qq/callback','LoginController@qqLogin');
    Route::get('/google/callback','LoginController@googleLogin');
});

Route::group(['namespace' => 'Home'],function(){
    //视频系列
    Route::get('/lessons','VideosController@videos');
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

Route::group(['namespace' => 'Home'],function(){

    //音乐电台
    Route::get('/broadcasts','BroadcastsController@musicIndex');
    Route::get('/broadcasts/{id}','BroadcastsController@musicPlay');

    //用户之间关注
    Route::get('/api/user/followers/{id}', 'FollowersController@isFollow');
    Route::post('/api/user/follow', 'FollowersController@follow');

    //用户支付
    //支付宝支付处理
    Route::get('/alipay/pay',"WebPayController@aliPay");
    //支付后跳转页面
    Route::post('/alipay/callback',"WebPayController@aliPayResult");
    //微信支付
    Route::any('/wechat/pay', 'WebController@wechatPay');
});

//登录验证码
Route::get('/captcha/{config?}',function(\Mews\Captcha\Captcha $captcha,$config='default'){
    return $captcha->create($config);
});

Route::get('/donate-to-me','Home\UserController@donate');