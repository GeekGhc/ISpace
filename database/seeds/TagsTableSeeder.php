<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tag::create(['name'=>"PHP",'type'=>"primary"]);
        \App\Tag::create(['name'=>"Java",'type'=>"info"]);
        \App\Tag::create(['name'=>"Laravel",'type'=>"danger"]);
        \App\Tag::create(['name'=>"C++",'type'=>"default"]);
        \App\Tag::create(['name'=>"服务器",'type'=>"warning"]);
        \App\Tag::create(['name'=>"ThinkPHP",'type'=>"success"]);
        \App\Tag::create(['name'=>"JSP",'type'=>"primary"]);
        \App\Tag::create(['name'=>"Javascript",'type'=>"info"]);
        \App\Tag::create(['name'=>"Database",'type'=>"success"]);
        \App\Tag::create(['name'=>"MAC",'type'=>"danger"]);
        \App\Tag::create(['name'=>"Windows",'type'=>"danger"]);
        \App\Tag::create(['name'=>"Linux",'type'=>"danger"]);
        \App\Tag::create(['name'=>"Github",'type'=>"default"]);
        \App\Tag::create(['name'=>"Git",'type'=>"default"]);
        \App\Tag::create(['name'=>"Composer",'type'=>"warning"]);
        \App\Tag::create(['name'=>"随想",'type'=>"primary"]);
    }
}
