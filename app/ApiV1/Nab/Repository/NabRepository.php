<?php

namespace App\ApiV1\Nab\Repository;

use App\ApiV1\Nab\Model\NabModel;

class NabRepository
{
    public function __construct(
        protected NabModel $nabModel
    ){}

    public function index()
    {
        return $this->nabModel->latest()->get();
    }

    public function create($data)
    {
        return $this->nabModel->create($data);
    }
}