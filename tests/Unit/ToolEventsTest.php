<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToolEventsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function tools_can_record_a_review_event()
    {
        /**
         * @var Tool $tool
         **/
        $tool = Tool::factory()->create();
        $user = User::factory()->create();

        $detail = $this->faker->sentence;

        $tool->reviewEvent($detail, $user);

        $this->assertCount(1, Event::all());
        $this->assertEquals($detail, Event::first()->detail);
        $this->assertEquals($tool->id, Event::first()->tool_id);
        $this->assertEquals($user->id, Event::first()->user_id);
    }

    /** @test */
    public function tools_can_record_a_status_update_event()
    {
        /**
         * @var Tool $tool
         **/
        $tool = Tool::factory()->create();
        $user = User::factory()->create();

        $detail = 'approved';

        $tool->statusEvent($detail, $user);

        $this->assertCount(1, Event::all());
        $this->assertEquals($detail, Event::first()->detail);
        $this->assertEquals($tool->id, Event::first()->tool_id);
        $this->assertEquals($user->id, Event::first()->user_id);
    }
}
