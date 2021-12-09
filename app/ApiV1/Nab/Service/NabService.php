<?php

namespace App\ApiV1\Nab\Service;

use App\ApiV1\Helper\Helper;
use App\ApiV1\Nab\Repository\NabRepository;

class NabService
{
    public function __construct(
        protected NabRepository $nabRepository, 
        protected Helper $helper
    ){}

    public function index()
    {
        return $this->nabRepository->index();
    }

    public function create($request)
    {
        $currentBalance = $this->helper->roundDown($request->current_balance, 5);
        $totalUnit = $this->helper->totalUnit();
        $nab = $totalUnit > 0 ?  $currentBalance/$totalUnit : 1;

        $data = [
            'total_balance' => $currentBalance, 
            'total_unit' => $totalUnit, 
            'nab' => $this->helper->roundDown($nab, 4)
        ];

        return $this->nabRepository->create($data);
    }
}