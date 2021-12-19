<?php

namespace App\ApiV1\Transaction\Response;

use App\ApiV1\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResourceResponse extends JsonResource
{
    public function toArray($request)
    {
        $currentNab = Helper::currentNab();
        $totalUnit = $this->userBalance ? $this->userBalance->total_unit : 0;
        $totalSaldo = $totalUnit * $currentNab;

        return [
            'nilai_unit' => $this->unit, 
            'nilai_unit_total' => $totalUnit, 
            'saldo_rupiah_total' => 'Rp '.round($totalSaldo, 2, PHP_ROUND_HALF_DOWN)
        ];
    }
}
