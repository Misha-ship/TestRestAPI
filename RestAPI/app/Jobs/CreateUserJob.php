<?php

namespace App\Jobs;

use App\DTO\UserDTO;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class CreateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected UserDTO $userDTO;

    public function __construct(UserDTO $userDTO)
    {
        $this->userDTO = $userDTO;
    }

    public function handle(UserServiceInterface $userService): void
    {
        $userService->create($this->userDTO);
        Cache::forget('users');
    }
}
