<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\ApiV1\Transaction\Model\TransactionModel;

class TransactionTest extends TestCase
{
    public function setUp(): void 
    {
        parent::setUp();

        $this->setBaseUrl('api/v1/ib/topup');
        $this->setBaseModel(TransactionModel::class);
    }

    public function test_topup_success()
    {
        $attributes = $this->baseModel::factory()->topup()->raw();

        $this->create(true, $attributes)->assertSuccessful();
    }

    public function test_withdraw_success()
    {
        // $this->withoutExceptionHandling();

        $this->setBaseUrl('api/v1/ib/withdraw');

        $attributes = $this->baseModel::factory()->withdraw()->raw();

        $this->create(true, $attributes)->assertSuccessful();
    }

    public function test_withdraw_invalid()
    {
        // $this->withoutExceptionHandling();

        $this->setBaseUrl('api/v1/ib/withdraw');

        $attributes = $this->baseModel::factory()->withdraw()->raw(['amount' => -6000]);

        $this->create(false, $attributes)
            ->assertStatus(400)
            ->assertJsonFragment(['message' => 'Invalid Withdraw.']);
    }

    public function test_transaction_validator_requires()
    {
        // $this->withoutExceptionHandling();

        $this->create(false, ['user_id' => '', 'amount' => ''])
            ->assertStatus(422)
            ->assertInvalid([
                'user_id' => 'The user id field is required.',
                'amount' => 'The amount field is required.',
            ]);
    }

    public function test_transaction_validator_exists_user_id_from_users_table()
    {
        // $this->withoutExceptionHandling();

        $this->create(false, ['user_id' => 0])
            ->assertStatus(422)
            ->assertInvalid(['user_id' => 'The selected user id is invalid.']);
    }

}
