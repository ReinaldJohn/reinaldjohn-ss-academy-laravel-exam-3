<?php

namespace Tests\Unit;

use App\Models\User;
use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use App\Services\UserService;
use Tests\TestCase;
use Mockery;

class SaveUserBackgroundInformationTest extends TestCase
{
    public function test_it_saves_user_details_when_event_is_triggered()
    {
        $userService = Mockery::mock(UserService::class);
        $user = User::factory()->create();
        $userService->shouldReceive('saveUserDetails')
                    ->once()
                    ->with($user);
        $listener = new SaveUserBackgroundInformation($userService);
        $listener->handle(new UserSaved($user));
        $this->assertTrue(true);
        Mockery::close();
    }
}
