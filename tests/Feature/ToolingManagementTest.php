<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\TagTool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tool;

class ToolingManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_tool_can_be_added_to_the_tpc()
    {
        $response = $this->post('/tools', [
            'name' => 'My cool tool',
            'description' => 'A wonderful description to enlighten the reader.',
            'link' => 'https:/example.com/remote-management-admin',
            'version' => "1.23.4567",
            'license_id' => "1",
            'contact_id' => "1"
        ]);

        $response->assertCreated();
        $this->assertCount('1', Tool::all());
    }

    /** @test */
    public function tool_data_must_not_be_blank()
    {
        $response = $this->post('/tools', [
            'name' => '',
            'description' => '',
            'link' => 'https:/example.com/remote-management-admin',
            'version' => "1.23.4567",
            'license_id' => "1",
            'contact_id' => "1"
        ]);

        $response->assertSessionHasErrors(['name', 'description']);
    }

    /** @test */
    public function a_tool_can_be_updated()
    {
        $tool = Tool::factory()->create();

        $response = $this->patch($tool->path(), [
            'name' => 'Even cooler tool',
            'description' => 'So boom!',
            'link' => 'https:/tool.com/login',
            'version' => "7.65.4321",
            'license_id' => "2",
            'contact_id' => "3"
        ]);

        $tool = Tool::first();

        $this->assertEquals('Even cooler tool', $tool->name);
        $this->assertEquals('So boom!', $tool->description);
        $this->assertEquals('https:/tool.com/login', $tool->link);
        $this->assertEquals('7.65.4321', $tool->version);
        $this->assertEquals('2', $tool->license_id);
        $this->assertEquals('3', $tool->contact_id);
        $response->assertRedirect($tool->fresh()->path());
    }

    /** @test */
    public function a_tool_can_be_deleted()
    {
        Tool::factory()->create();

        $this->assertCount(1, Tool::all());

        $response = $this->delete(Tool::first()->path());

        $this->assertCount(0, Tool::all());
        $response->assertRedirect('/tools');
    }

    /** @test */
    public function a_tag_can_be_added_to_a_tool()
    {
        $this->post('/tags', [
            'name' => 'my tag'
        ]);

        $this->post('/tags', [
            'name' => 'another tag'
        ]);

        $this->assertCount(2, Tag::all());

        $tag_1 = Tag::where('name', 'my tag')->first();
        $tag_2 = Tag::where('name', 'another tag')->first();

        $this->assertEquals(1, $tag_1->id);
        $this->assertEquals(2, $tag_2->id);

        $tool = Tool::factory()->create();

        $tag_tool_1 = $this->post('/tools/' . $tool->id . '/tag', [
            'tag_id' => $tag_1->id
        ]);
        $tag_tool_1->assertCreated();

        $tag_tool_2 = $this->post('/tools/' . $tool->id . '/tag', [
            'tag_id' => $tag_2->id
        ]);
        $tag_tool_2->assertCreated();

        // assert tools tags
        $tags = Tool::first()->tags();
        $this->assertCount(2, TagTool::all());
        $this->assertCount(2, $tags->get());
        $this->assertEquals('another tag', $tags->find(2)->name);
    }
}
