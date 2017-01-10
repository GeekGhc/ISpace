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
        /*\App\Tag::create(['name'=>"PHP",'type'=>"primary"]);
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
        \App\Tag::create(['name'=>"随想",'type'=>"primary"]);*/

        \App\Tag::create(['name'=>"PHP",'type'=>"red"]);
        \App\Tag::create(['name'=>"Laravel",'type'=>"orange"]);
        \App\Tag::create(['name'=>"C++",'type'=>"yellow"]);
        \App\Tag::create(['name'=>"JSP",'type'=>"olive"]);
        \App\Tag::create(['name'=>"Javascript",'type'=>"green"]);
        \App\Tag::create(['name'=>"Html5",'type'=>"teal"]);
        \App\Tag::create(['name'=>"Css",'type'=>"blue"]);
        \App\Tag::create(['name'=>"Web",'type'=>"violet"]);
        \App\Tag::create(['name'=>"ThinkPHP",'type'=>"purple"]);
        \App\Tag::create(['name'=>"YII",'type'=>"pink"]);
        \App\Tag::create(['name'=>"VueJs",'type'=>"brown"]);
        \App\Tag::create(['name'=>"Markdown",'type'=>"black"]);
        \App\Tag::create(['name'=>"command",'type'=>"purple"]);
        \App\Tag::create(['name'=>"Session",'type'=>"pink"]);
        \App\Tag::create(['name'=>"PHPUnit",'type'=>"brown"]);
        \App\Tag::create(['name'=>"nodeJs",'type'=>"orange"]);
        \App\Tag::create(['name'=>"服务器",'type'=>"grey"]);
        \App\Tag::create(['name'=>"Database",'type'=>"black"]);
        \App\Tag::create(['name'=>"MAC",'type'=>"red"]);
        \App\Tag::create(['name'=>"Windows",'type'=>"orange"]);
        \App\Tag::create(['name'=>"Linux",'type'=>"yellow"]);
        \App\Tag::create(['name'=>"Github",'type'=>"green"]);
        \App\Tag::create(['name'=>"Git",'type'=>"teal"]);
        \App\Tag::create(['name'=>"Composer",'type'=>"blue"]);
        \App\Tag::create(['name'=>"随想",'type'=>"olive"]);
    }
}
