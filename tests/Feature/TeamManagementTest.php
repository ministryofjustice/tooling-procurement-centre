<?php

namespace Tests\Feature;

use App\Models\Organisation;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class TeamManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_a_team_can_be_created()
    {
        // authentication needed
        $this->authorisedUser();

        $organisation = Organisation::factory()->create();

        $response = $this->post('/teams', [
            'name' => 'Our Great Team',
            'comms_url' => '',
            'organisation_id' => $organisation->id
        ]);
        $response->assertCreated();
        $this->assertCount('1', Team::all());
    }

    public function test_a_team_can_be_updated()
    {
        $this->authorisedUser();

        $team = Team::factory()->create();

        $organisation = Organisation::factory()->create();

        $this->patch('teams/' . $team->id, [
            'name' => 'Our Brilliant Team',
            'comms_url' => 'https:/slack.com/webhook',
            'organisation_id' => $organisation->id
        ]);

        $team = Team::first();
        $this->assertEquals('Our Brilliant Team', $team->name);
        $this->assertEquals('https:/slack.com/webhook', $team->comms_url);
    }
}
