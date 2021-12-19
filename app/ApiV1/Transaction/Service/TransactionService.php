<?php

namespace App\ApiV1\Transaction\Service;

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
        $unit = $request->amount_rupiah/$currentNab;

        $data = [
            'user_id' => $request->user_id,
            'amount' => $request->amount_rupiah,
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
        $unit = $request->amount_rupiah/$currentNab;

        $data = [
            'user_id' => $request->user_id,
            'amount' => -1 * $request->amount_rupiah,
            'type' => 'withdraw', 
            'unit' => -1 * $this->helper->roundDown($unit, 4),
            'nab' => $currentNab
        ];

        return $this->transactionRepository->withdraw($data, $request->amount_rupiah, $userBalanceRupiah);
    }
}