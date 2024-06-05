<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class UserIndexController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws AuthorizationException
     */
    public function __invoke(): JsonResponse|AnonymousResourceCollection
    {
        if (Gate::denies('viewAny-user')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $this->authorize('viewAny', User::class);

        $users = Cache::remember('users', 3600, function () {
            return $this->userService->getAll();
        });

        return UserResource::collection($users);
    }
}

