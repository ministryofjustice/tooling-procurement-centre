<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\TagTool;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tool;
use Tests\TestCase;
use Tests\WithAuthUser;

class ToolingManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    /** @test */
    public function a_new_tool_form_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get('/tools/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function existing_tools_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get('/tools');
        $response->assertStatus(200);
    }

    /** @test */
    public function a_tool_can_be_added_to_the_tpc()
    {
        $this->authorisedUser();

        $response = $this->post('/tools', [
            'name' => 'My cool tool',
            'description' => 'A wonderful description to enlighten the reader.',
            'link' => 'https:/example.com/remote-management-admin',
            'contact_id' => "1"
        ]);

        $response->assertRedirect('/tools');
        $this->assertCount('1', Tool::all());
    }

    /** @test */
    public function tool_data_must_not_be_blank()
    {
        $this->authorisedUser();

        $response = $this->post('/tools', [
            'name' => '',
            'description' => '',
            'link' => 'https:/example.com/remote-management-admin',
            'contact_id' => "1"
        ]);

        $response->assertSessionHasErrors(['name', 'description']);
    }

    /** @test */
    public function a_tool_can_be_updated()
    {
        $this->authorisedUser();

        Tool::factory()->create();

        $response = $this->patch('tools/1', [
            'name' => 'Even cooler tool',
            'description' => 'So boom!',
            'link' => 'https:/tool.com/login',
            'contact_id' => "3"
        ]);

        $tool = Tool::first();

        $this->assertEquals('Even cooler tool', $tool->name);
        $this->assertEquals('So boom!', $tool->description);
        $this->assertEquals('https:/tool.com/login', $tool->link);
        $this->assertEquals('3', $tool->contact_id);
        $response->assertRedirect($tool->fresh()->path());
    }

    /** @test */
    public function a_tool_can_be_deleted()
    {
        Tool::factory()->create();
        $this->assertCount(1, Tool::all());

        $this->authorisedUser();
        $response = $this->delete('tools/1');

        $this->assertCount(0, Tool::all());
        $response->assertRedirect('/tools');
    }

    /** @test */
    public function a_tool_cannot_be_deleted_by_unknown_user()
    {
        $this->withoutExceptionHandling();

        Tool::factory()->create();
        $this->assertCount(1, Tool::all());

        $this->expectException(AuthenticationException::class);
        $response = $this->delete('tools/1');
        $response->assertForbidden();
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

    /** @test */
    public function a_tool_can_be_displayed()
    {
        $this->authorisedUser();
        $tool = Tool::factory()->create();

        $response = $this->get($tool->path());
        $response->assertStatus(200);
    }

    /** @test */
    public function a_tool_can_be_found_using_tool_search()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();
        $search = $tool->slug;
        $response = $this->post('/tools/search/' . substr($search, 0, 4) . '/');
        $results = $response->getData()->results;

        $this->assertCount(1, $results);
        $this->assertEquals($tool->name, $results[0]->name);
    }

    /** @test */
    public function a_tool_cannot_be_searched_by_unknown_user()
    {
        $this->withoutExceptionHandling();

        $tool = Tool::factory()->create();

        $this->expectException(AuthenticationException::class);

        $search = $tool->slug;
        $response = $this->post('/tools/search/' . substr($search, 0, 4) . '/');
        $response->assertForbidden();
    }
}
