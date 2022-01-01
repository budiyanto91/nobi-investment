<?php

namespace Database\Factories;

use App\ApiV1\User\Model\UserModel;
use App\ApiV1\User\Model\UserBalanceModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserBalanceModelFactory extends Factory
{
    protected $model = UserBalanceModel::class;

    public function definition()
    {
        return [
            'user_id' => UserModel::factory(), 
            'total_unit' => $this->faker->randomFloat(2, 1000, 5000)
        ];
    }
}
