<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventsManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_event_can_be_created()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tool = Tool::factory()->create();

        $response = $this->post('/tools/' . $tool->id . '/event', [
            'action' => 'tooling-review',
            'detail' => 'This detail would contain an official review of a tool after consideration.',
            'origin' => 'email-submission',
            'user_id' => $user->id
        ]);
        $this->assertCount(1, Event::all());
        $response->assertCreated();
    }
}
