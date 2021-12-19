<?php

namespace App\ApiV1\User\Model;

use Illuminate\Database\Eloquent\Model;
use App\ApiV1\User\Model\UserBalanceModel;
use Database\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = ['name', 'username'];

    protected static function newFactory()
    {
        return UserModelFactory::new();
    }
    
    public function userBalance()
    {
        return $this->hasOne(UserBalanceModel::class, 'user_id', 'id');
    }
}