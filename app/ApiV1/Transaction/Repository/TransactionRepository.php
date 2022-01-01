<?php

namespace App\ApiV1\Transaction\Repository;

use App\ApiV1\Helper\Helper;
use Illuminate\Support\Facades\DB;
use App\ApiV1\Transaction\Model\TransactionModel;

class TransactionRepository
{
    public function __construct(
        protected TransactionModel $transactionModel,
        protected Helper $helper
    ){}

    public function topup($data)
    {
        return DB::transaction(function () use ($data){
            $userTopup = $this->transactionModel->create($data);

            $userBalance = $userTopup->userBalance ? $userTopup->userBalance->total_unit : 0;
            $totalBalance = $userBalance + $userTopup->unit;

            $userTopup->userBalance()->updateOrCreate(
                ['user_id' => $userTopup->user_id], ['total_unit' => $this->helper->roundDown($totalBalance, 4)]
            );

            $user = $this->transactionModel->find($userTopup->id);
    
            return $user;
        });
    }

    public function withdraw($data)
    {
        return DB::transaction(function () use ($data){
            $userWithdraw = $this->transactionModel->create($data);                                                                                                                                                                                                                                                       

            $userBalance = $userWithdraw->userBalance ? $userWithdraw->userBalance->total_unit : 0;
            $totalBalance = $userBalance + $userWithdraw->unit;

            $userWithdraw->userBalance()->updateOrCreate(
                ['user_id' => $userWithdraw->user_id], ['total_unit' => $this->helper->roundDown($totalBalance, 4)]
            );

            $user = $this->transactionModel->find($userWithdraw->id);
    
            return $user;
        });
    }
}