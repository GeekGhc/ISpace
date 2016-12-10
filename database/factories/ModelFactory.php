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

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $name = array('PHP','Laravel','Java','C++','C','JSP','Python','C#','Javascript','NodeJs','MySQL','HTML');
    $type = array('default','success','primary','warning','danger','info');
    return [
        'name' => $faker->randomElement($name),
        'type' => $faker->randomElement($type),
    ];
});
