<?php

namespace Database\Factories;

use App\ApiV1\User\Model\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName()
        ];
    }
}
