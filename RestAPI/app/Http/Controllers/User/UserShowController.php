<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class UserShowController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws AuthorizationException
     */
    public function __invoke(int $id): UserResource|JsonResponse
    {
        $user = $this->userService->getById($id);

        if (Gate::denies('view-user', $user)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $this->authorize('view', $user);

        return new UserResource($user);
    }
}

