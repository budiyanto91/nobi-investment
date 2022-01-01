<?php

namespace Tests\Feature;

use App\ApiV1\User\Model\UserModel;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function setUp(): void 
    {
        parent::setUp();

        $this->setBaseUrl('api/v1/user/add');
        $this->setBaseModel(UserModel::class);
    }

    public function test_get_data_member_with_paginator()
    {
        $this->setBaseUrl('api/v1/ib/member');

        $this->findByPaginator();
    }

    public function test_add_user_success()
    {
        $attributes = UserModel::factory()->raw();
        
        $this->create(true,  $attributes)->assertJson(fn ($json) => $json->has('user_id')->whereType('user_id', 'integer'))->assertSuccessful();
    }

    public function test_add_user_validator_requires()
    {
        // $this->withoutExceptionHandling();

        $this->create(false, ['name' => '', 'username' => ''])
            ->assertStatus(422)
            ->assertInvalid([
                'name' => 'The name field is required.',
                'username' => 'The username field is required.',
            ]);
    }

    public function test_add_user_validator_unique_an_username()
    {
        // $this->withoutExceptionHandling();

        $attributes = $this->baseModel::factory()->create()->toArray();

        $this->create(false, $attributes)
            ->assertStatus(422)
            ->assertInvalid([
                'username' => 'The username has already been taken.'
            ]);
    }
}
