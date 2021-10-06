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

        $patch_name = 'Our Brilliant Team';
        $patch_comms_url = 'https:/slack.com/webhook';

        $this->patch('teams/' . $team->id, [
            'name' => $patch_name,
            'comms_url' => $patch_comms_url,
            'organisation_id' => Organisation::factory()->create()->id
        ]);

        $team = Team::first();
        $this->assertEquals($patch_name, $team->name);
        $this->assertEquals($patch_comms_url, $team->comms_url);
    }
}
