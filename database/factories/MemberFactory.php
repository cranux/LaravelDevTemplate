<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inviter_id' => rand(1, 20),
            'wx_unionid' => Str::random(30),
            'wx_openid' => Str::random(30),
            'nickname' => $this->faker->name,
            'sex' => rand(0, 2),
            'credit1' => rand(0, 1000),
            'credit2' => rand(0, 1000),
            'head_img_url' => $this->faker->imageUrl(100, 100),
        ];
    }
}
