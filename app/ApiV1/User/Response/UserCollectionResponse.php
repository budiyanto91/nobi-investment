<?php

namespace App\ApiV1\User\Response;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollectionResponse extends ResourceCollection
{
    public function toArray($request)
    {
        return [
                'data' => $this->collection->transform(function ($user){
                    return new UserResourceResponse($user);
                })
          ];
    }
}
