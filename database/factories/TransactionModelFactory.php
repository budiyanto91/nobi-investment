<?php

namespace Database\Factories;

use App\ApiV1\Helper\Helper;
use App\ApiV1\User\Model\UserModel;
use App\ApiV1\Transaction\Model\TransactionModel;
use App\ApiV1\User\Model\UserBalanceModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionModelFactory extends Factory
{
    protected $model = TransactionModel::class;

    public function definition()
    {
        $user = UserModel::factory()->create();
        UserBalanceModel::factory()->create(['user_id' => $user->id]);

        return [
            'user_id' => $user->id,
        ];
    }

    public function topup()
    {
        $currentNab = Helper::currentNab();
        $amount = $this->faker->randomFloat(2, 1000, 5000);
        
        return $this->state([
            'type' => 'topup',
            'amount' => $amount,
            'unit' => Helper::roundDown($amount/$currentNab, 4),
            'nab' => $currentNab
        ]);
    }

    public function withdraw()
    {
        $currentNab = Helper::currentNab();
        $amount = $this->faker->randomFloat(2, 500, 1000) * -1;
        
        return $this->state([
            'type' => 'withdraw',
            'amount' => $amount,
            'unit' => Helper::roundDown($amount/$currentNab, 4),
            'nab' => $currentNab
        ]);
    }
}
