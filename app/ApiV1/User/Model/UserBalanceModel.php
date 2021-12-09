<?php

namespace App\ApiV1\User\Model;

use Illuminate\Database\Eloquent\Model;

class UserBalanceModel extends Model
{
    protected $table = 'user_balances';
    protected $fillable = ['user_id', 'total_unit'];
}