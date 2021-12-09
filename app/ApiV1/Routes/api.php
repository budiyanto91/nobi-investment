<?php

use Illuminate\Support\Facades\Route;
use App\ApiV1\Nab\Controller\NabController;
use App\ApiV1\User\Controller\UserController;
use App\ApiV1\Transaction\Controller\TransactionController;

// User
Route::get('ib/member', [UserController::class, 'index']);
Route::post('user/add', [UserController::class, 'create']);

// nab
Route::get('ib/listNAB', [NabController::class, 'index']);
Route::post('ib/updateTotalBalance', [NabController::class, 'create']);

// transaction
Route::post('ib/topup', [TransactionController::class, 'topup']);
Route::post('ib/withdraw', [TransactionController::class, 'withdraw']);