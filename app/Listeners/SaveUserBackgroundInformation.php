<?php

namespace App\Listeners;

use App\Services\UserService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveUserBackgroundInformation
{

    protected $userService;


    /**
     * Create the event listener.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->userService->saveUserDetails($event->user);
    }
}