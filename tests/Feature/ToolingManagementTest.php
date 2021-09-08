<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tool;

class ToolingManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function a_tool_can_be_added_to_the_tpc()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/tool', [
            'name' => 'My cool tool',
            'description' => 'A wonderful description to enlighten the reader.',
            'external-management-link' => 'https:/example.com/remote-management-admin',
            'tags' => '{"json-tags":["cool","tooling"]}',
            'version' => "1.23.4567",
            'license_id' => "1",
            'contact_id' => "1"
        ]);

        $response->assertOk();
        $this->assertCount('1', Tools::all());
    }
}
