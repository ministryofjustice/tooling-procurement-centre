<?php

namespace Tests\Feature;

use App\Models\Licence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LicenceManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_licence_can_be_created()
    {
        $this->mockTool();

        $response = $this->post('/licences', [
            'tool_id' => 1,
            'description' => 'hello',
            'user_limit' => '1000',
            'annual_cost' => 24140,
            'currency' => 'GB',
            'cost_per_user' => 10.99,
            'start' => '2021-09-12 00:00:00',
            'stop' => '2022-09-11 23:59:59'
        ]);
        $response->assertCreated();
        $this->assertCount(1, Licence::all());
    }

    /** @test */
    public function a_licence_can_be_created_with_only_tool_id()
    {
        $this->mockTool();

        // add a licence and associate with the tool_id
        $response = $this->post('/licences', [
            'tool_id' => 1
        ]);
        $response->assertCreated();
        $this->assertCount(1, Licence::all());

        // force an error on the tool_id column; attempt to create a record with no data
        $response = $this->post('/licences', []);
        $response->assertSessionHasErrors('tool_id');
    }

    /** @test */
    public function a_licence_description_cannot_be_boolean()
    {
        $this->mockTool();

        // description: boolean
        $response = $this->post('/licences', [
            'tool_id' => 1,
            'description' => false
        ]);
        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_licence_description_cannot_be_an_integer()
    {
        $this->mockTool();

        // description: integer
        $response = $this->post('/licences', [
            'tool_id' => 1,
            'description' => 12345
        ]);
        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_licence_currency_code_is_3_chars_max()
    {
        $this->mockTool();

        // description: integer
        $response = $this->post('/licences', [
            'tool_id' => 1,
            'currency' => 'GBPL'
        ]);
        $response->assertSessionHasErrors('currency');
    }

    /** @test */
    public function a_licence_is_removed_if_tool_deleted()
    {
        $this->mockTool();

        $this->post('/licences', [
            'tool_id' => 1
        ]);
        $this->assertCount(1, Licence::all());

        $this->delete('/tools/1');
        $this->assertCount(0, Licence::all());
    }

    /** @test */
    public function a_licence_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->mockTool();

        $this->post('/licences', [
            'tool_id' => 1,
            'user_limit' => 5,
            'description' => 'Hello'
        ]);
        $licence = Licence::first();
        $this->assertEquals('Hello', $licence->description);

        $response = $this->patch('/licences/1', [
            'tool_id' => 1,
            'description' => 'This description is now a great description',
            'user_limit' => 2000,
            'annual_cost' => 24140,
            'currency' => 'GBP',
            'cost_per_user' => 5.99,
            'start' => '2021-09-12 00:00:00',
            'stop' => '2022-09-11 23:59:59'
        ]);

        $licence = Licence::first();

        $this->assertEquals('This description is now a great description', $licence->description);
        $this->assertEquals(2000, $licence->user_limit);
        $this->assertEquals(24140, $licence->annual_cost);
        $this->assertEquals('GBP', $licence->currency);
        $this->assertEquals(5.99, $licence->cost_per_user);
        $response->assertRedirect($licence->fresh()->path());
    }

    protected function mockTool()
    {
        $this->post('/tools', [
            'name' => 'My cool tool',
            'description' => 'A wonderful description to enlighten the reader.',
            'link' => 'https:/example.com/remote-management-admin',
            'version' => "1.23.4567",
            'license_id' => "1",
            'contact_id' => "1"
        ]);
    }
}
