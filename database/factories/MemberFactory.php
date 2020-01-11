<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\Member::class, function (Faker $faker) {
    return [
        'inviter_id' => rand(1, 20),
        'wx_unionid' => Str::random(30),
        'wx_openid' => Str::random(30),
        'nickname' => $faker->name,
        'sex' => rand(0, 2),
        'credit1' => rand(0, 1000),
        'credit2' => rand(0, 1000),
        'head_img_url' => $faker->imageUrl(100, 100),
    ];
});
