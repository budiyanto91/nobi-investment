<?php

namespace App\ApiV1\User\Model;

use Illuminate\Database\Eloquent\Model;
use App\ApiV1\User\Model\UserBalanceModel;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'username'];

    public function userBalance()
    {
        return $this->hasOne(UserBalanceModel::class, 'user_id', 'id');
    }
}