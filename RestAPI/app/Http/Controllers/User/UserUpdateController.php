<?php

namespace App\Http\Controllers\User;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;;
use App\Jobs\UpdateUserJob;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class UserUpdateController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws AuthorizationException
     */
    public function __invoke(UserRequest $request, int $id): JsonResponse
    {
        $user = $this->userService->getById($id);

        if (Gate::denies('update-user', $user)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $this->authorize('view', $user);
        $this->authorize('update', $user);

        $userDTO = new UserDTO($request->name, $request->email, $request->password, $request->role);
        UpdateUserJob::dispatch($id, $userDTO);

        return response()->json(['message' => 'User update in progress'], 202);
    }
}

