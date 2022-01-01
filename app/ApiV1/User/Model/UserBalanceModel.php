<?php

namespace App\ApiV1\User\Model;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserBalanceModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserBalanceModel extends Model
{
    use HasFactory;

    protected $table = 'user_balances';
    protected $fillable = ['user_id', 'total_unit'];

    protected static function newFactory()
    {
        return UserBalanceModelFactory::new();
    }
}