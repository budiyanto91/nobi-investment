<?php

namespace App\ApiV1\Nab\Response;

use Illuminate\Http\Resources\Json\JsonResource;

class NabResourceResponse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'nab' => $this->nab,
            'date' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
    }
}
