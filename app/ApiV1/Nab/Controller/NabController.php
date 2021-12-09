<?php

namespace App\ApiV1\Nab\Controller;

use App\Http\Controllers\Controller;
use App\ApiV1\Nab\Service\NabService;
use App\ApiV1\Nab\Requests\CreateNabRequest;
use App\ApiV1\Nab\Response\NabResourceResponse;

class NabController extends Controller
{
    public function __construct(
        protected NabService $nabService
    ){}

    public function index()
    {
        $nab = $this->nabService->index();

        $nab->transform(function ($query) {
            return (new NabResourceResponse($query));
        });

        return $nab;
    }
    
    public function create(CreateNabRequest $request)
    {
        $nab = $this->nabService->create($request);

        return response()->json(['nab_amount' => $nab->nab], 200);
    }
}
