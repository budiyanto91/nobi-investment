<?php

namespace App\ApiV1\User\Controller;

use App\ApiV1\User\Requests\CreateUserRequest;
use App\ApiV1\User\Requests\GetUserRequest;
use App\ApiV1\User\Response\UserCollectionResponse;
use App\ApiV1\User\Service\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ){}

    public function index(GetUserRequest $request)
    {
        $users = $this->userService->index($request);

        return new UserCollectionResponse($users);
    }

    
    public function create(CreateUserRequest $request)
    {
        $user = $this->userService->create($request);

        return response()->json(['user_id' => $user->id], 200);
    }
}
