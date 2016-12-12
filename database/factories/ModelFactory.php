<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//用户
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => $faker->imageUrl(256, 256),
        'confirm_code' => str_random(48),
        'social_type'=>'local',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


//文章
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $userId = \App\User::pluck('id')->toArray();
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'html_body'=>$faker->paragraph,
        'user_id' => $faker->randomElement($userId),
        'comment_count' => $faker->numberBetween(1,999),
        'view_count' => $faker->numberBetween(1,999),
    ];
});

//帖子
$factory->define(App\Discussion::class, function (Faker\Generator $faker) {
    $userId = \App\User::pluck('id')->toArray();
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'html_body' => $faker->paragraph,
        'user_id' => $faker->randomElement($userId),
        'last_user_id' => $faker->randomElement($userId),
        'comment_count' => $faker->numberBetween(1,999),
        'view_count' => $faker->numberBetween(1,999),
    ];
});

//标签
$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $name = array('PHP','Laravel','Java','C++','C','JSP','Python','C#','Javascript','NodeJs','MySQL','HTML');
    $type = array('default','success','primary','warning','danger','info');
    return [
        'name' => $faker->randomElement($name),
        'type' => $faker->randomElement($type),
    ];
});

//视频系列
$factory->define(App\VideoSerie::class, function (Faker\Generator $faker) {
    $name = array(
        'HTML基础学习',
        'Nginx服务器搭建',
        '初识Bootstrap,了解响应式布局',
        '部署Laravel项目',
        'Laravel结合VueJs',
        'VueJs2.0过渡',
        '邮件发送服务',
        '实现菜单多级管理'
        );

    return [
        'name' => $faker->randomElement($name),
        'intro' => $faker->sentence,
        'thumbnail'=> $faker->imageUrl(1920,1080),
    ];
});

//视频
$factory->define(App\Video::class, function (Faker\Generator $faker) {
    $videoSeriesId = \App\VideoSerie::pluck('id')->toArray();
    $title = array(
        'Laravel路由详解',
        'Laravel视图',
        'Laravel内置邮件发送',
        'Laravel的passport',
        'Eloquent的使用',
        '使用factory生成测试数据',
        'Laravel Model使用',
    );

    return [
        'title' => $faker->randomElement($title),
        'video_series_id'=>$faker->randomElement($videoSeriesId),
        'intro' => $faker->sentence,
        'url'=>'http://static.qiakr.com/movie/0060202.mp4',
        'poster'=> $faker->imageUrl(1920,1080),
    ];
});