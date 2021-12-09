<?php

namespace App\ApiV1\User\Service;

use App\ApiV1\User\Repository\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function index($request)
    {
        return $this->userRepository->index($request->user_id, $request->limit);
    }

    public function create($request)
    {
        $data = [
            'name' => $request->name,
            'username' => $request->username
        ];

        return $this->userRepository->create($data);
    }
}