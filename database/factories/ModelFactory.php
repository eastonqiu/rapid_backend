<?php

use Carbon\Carbon;
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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'nickname' => str_random(10),
        'avatar' => 'http://img.mp.itc.cn/upload/20160528/74a3f298a3184542bd468786d59feae9.jpg',
        'sex' => 1,
        'city' => 'Shenzhen',
        'country' => 'China',
        'password' => bcrypt(str_random(10)),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Models\Post::class, function ($faker) {
    return [
        'title' => $faker->title,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        }
    ];
});
