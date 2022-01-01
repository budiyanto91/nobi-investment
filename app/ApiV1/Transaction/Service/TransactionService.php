<?php

namespace App\ApiV1\Transaction\Service;

use App\ApiV1\Exception\InvalidWithdrawException;
use App\ApiV1\Helper\Helper;
use App\ApiV1\Transaction\Repository\TransactionRepository;

class TransactionService
{
    public function __construct(
        protected TransactionRepository $transactionRepository, 
        protected Helper $helper
    ){}

    public function topup($request)
    {
        $currentNab = $this->helper->currentNab();
        $unit = $request->amount/$currentNab;

        $data = [
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'type' => 'topup', 
            'unit' => $this->helper->roundDown($unit, 4),
            'nab' => $currentNab
        ];

        return $this->transactionRepository->topup($data);
    }

    public function withdraw($request)
    {
        $currentNab = $this->helper->currentNab();
        $userBalanceUnit = $this->helper->userBalanceUnit($request->user_id);
        $userBalanceRupiah = $userBalanceUnit * $this->helper->currentNab();
        $unit = abs($request->amount)/$currentNab;

        if(abs($request->amount) > $userBalanceRupiah) throw new InvalidWithdrawException();

        $data = [
            'user_id' => $request->user_id,
            'amount' => -1 * abs($request->amount),
            'type' => 'withdraw', 
            'unit' => -1 * $this->helper->roundDown($unit, 4),
            'nab' => $currentNab
        ];

        return $this->transactionRepository->withdraw($data);
    }
}