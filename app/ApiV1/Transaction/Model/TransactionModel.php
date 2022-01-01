<?php

namespace App\ApiV1\Transaction\Model;

use Illuminate\Database\Eloquent\Model;
use App\ApiV1\User\Model\UserModel;
use App\ApiV1\User\Model\UserBalanceModel;
use Database\Factories\TransactionModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionModel extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';
    protected $fillable = ['user_id', 'type', 'unit', 'amount', 'nab'];

    protected static function newFactory()
    {
        return TransactionModelFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function userBalance()
    {
        return $this->hasOne(UserBalanceModel::class, 'user_id', 'user_id');
    }
}