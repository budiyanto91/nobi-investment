<?php

namespace App\ApiV1\User\Repository;

use App\ApiV1\User\Model\UserModel;

class UserRepository
{
    public function __construct(
        protected UserModel $userModel
    ){}

    public function index($userId, $limit)
    {
        return $this->userModel->when($userId, function($query) use ($userId){
            $query->where('id', $userId);
        })->paginate($limit ?? 20);
    }

    public function create($data)
    {
        return $this->userModel->create($data);
    }
}