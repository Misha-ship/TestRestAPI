<?php

namespace App\Http\Controllers\User;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\CreateUserJob;
use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class UserStoreController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws AuthorizationException
     */
    public function __invoke(UserRequest $request): JsonResponse
    {
        if (Gate::denies('create-user')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $this->authorize('create', User::class);

        $userDTO = new UserDTO($request->name, $request->email, $request->password, $request->role);
        CreateUserJob::dispatch($userDTO);

        return response()->json(['message' => 'User creation in progress'], 202);
    }
}

