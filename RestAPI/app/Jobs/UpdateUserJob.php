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

class UpdateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $userId;
    protected UserDTO $userDTO;

    public function __construct(int $userId, UserDTO $userDTO)
    {
        $this->userId = $userId;
        $this->userDTO = $userDTO;
    }

    public function handle(UserServiceInterface $userService): void
    {
        $userService->update($this->userId, $this->userDTO);
        Cache::forget("user_{$this->userId}");
        Cache::forget('users');
    }
}
