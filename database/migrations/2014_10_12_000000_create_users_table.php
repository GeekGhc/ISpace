<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('avatar');//保存用户头像
            $table->string('confirm_code',64);//邮箱确认激活code
            $table->smallInteger('is_confirmed')->default(0);//判断用户呢是否已经激活他的邮箱
            $table->string('password');
            $table->integer('followers_count')->default(0);
            $table->integer('followings_count')->default(0);
            $table->rememberToken()->nullable();
            $table->string('api_token',64)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
