<?php

namespace App\ApiV1\User\Response;

use App\ApiV1\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceResponse extends JsonResource
{
    public function toArray($request)
    {
        $currentNab = Helper::currentNab();
        $unit = $this->userBalance ? $this->userBalance->total_unit : 0;
        $totalAmount = $unit * $currentNab;

        return [
            'user_id' => $this->id,
            'total_unit_per_uid' => $unit,
            'total_amountrupiah_per_uid' => 'Rp '.Helper::roundDown($totalAmount, 2),
            'current_NAB' => $currentNab
        ];
    }
}
