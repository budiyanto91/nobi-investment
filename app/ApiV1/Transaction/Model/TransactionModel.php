<?php

namespace App\ApiV1\Transaction\Model;

use Illuminate\Database\Eloquent\Model;
use App\ApiV1\User\Model\UserModel;
use App\ApiV1\User\Model\UserBalanceModel;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['user_id', 'type', 'unit'];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function userBalance()
    {
        return $this->hasOne(UserBalanceModel::class, 'user_id', 'user_id');
    }
}