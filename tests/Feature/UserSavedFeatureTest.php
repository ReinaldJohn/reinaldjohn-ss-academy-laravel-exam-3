<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Events\UserSaved;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSavedFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_saved_event_is_dispatched()
    {
        Event::fake();
        $user = User::factory()->create([
            'firstname' => 'Original'
        ]);
        event(new UserSaved($user));
        Event::assertDispatched(UserSaved::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }
}
