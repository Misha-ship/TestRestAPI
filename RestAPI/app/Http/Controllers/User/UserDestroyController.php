<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class UserDestroyController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws AuthorizationException
     */
    public function __invoke(int $id): JsonResponse
    {
        $user = $this->userService->getById($id);

        if (Gate::denies('delete-user', $user)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $this->authorize('delete', $user);

        $this->userService->delete($id);
        Cache::forget("user_{$id}");
        Cache::forget('users');
        return response()->json(['message' => 'User deleted successfully']);
    }
}

