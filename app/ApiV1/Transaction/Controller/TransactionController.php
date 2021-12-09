<?php

namespace App\ApiV1\Transaction\Controller;

use App\Http\Controllers\Controller;
use App\ApiV1\Transaction\Service\TransactionService;
use App\ApiV1\Transaction\Requests\CreateTransactionRequest;
use App\ApiV1\Transaction\Response\TransactionResourceResponse;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $transactionService
    ){}

    public function topup(CreateTransactionRequest $request)
    {
        $topup = $this->transactionService->topup($request);

        return new TransactionResourceResponse($topup);
    }

    public function withdraw(CreateTransactionRequest $request)
    {
        $withdraw = $this->transactionService->withdraw($request);

        return new TransactionResourceResponse($withdraw);
    }
}