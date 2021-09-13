<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\TagTool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TagManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_tag_can_be_created()
    {
        $response = $this->post('/tags', [
            'name' => 'my tag'
        ]);

        $response->assertCreated();
        $this->assertCount(1, Tag::all());
    }

    /** @test */
    public function tag_name_must_not_be_blank()
    {
        $response = $this->post('/tags', [
            'name' => ''
        ]);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function tag_name_must_be_unique()
    {
        $unique_one = $this->post('/tags', [
            'name' => 'non-unique tag'
        ]);
        $unique_one->assertCreated();

        $unique_two = $this->post('/tags', [
            'name' => 'non-unique tag'
        ]);
        $unique_two->assertSessionHasErrors('name');
    }

    /** @test */
    public function tag_name_must_not_exceed_80_chars()
    {
        $response = $this->post('/tags', [
            'name' => Str::random(81)
        ]);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function tags_are_removed_if_tool_is_deleted()
    {
        $this->post('/tags', [ 'name' => 'my tag' ]);
        $this->post('/tags', [ 'name' => 'another tag' ]);
        $this->post('/tags', [ 'name' => 'yet another tag' ]);
        $this->post('/tags', [ 'name' => 'another tag for tool 2' ]);

        $this->assertCount(4, Tag::all());

        $this->post('/tools', [
            'name' => 'My cool tool',
            'description' => 'A wonderful description to enlighten the reader.',
            'link' => 'https:/example.com/remote-management-admin',
            'version' => "1.23.4567",
            'license_id' => "1",
            'contact_id' => "1"
        ]);

        $this->post('/tools', [
            'name' => 'My cool tool number 2',
            'description' => 'A wonderful description ',
            'link' => 'https:/example.com/admin',
            'version' => "1",
            'license_id' => "3",
            'contact_id' => "2"
        ]);

        // attach tags to tool 1
        $this->post('/tools/1/tag', [ 'tag_id' => 1 ]);
        $this->post('/tools/1/tag', [ 'tag_id' => 2 ]);
        // attach tags to tool 2
        $this->post('/tools/2/tag', [ 'tag_id' => 1 ]);
        $this->post('/tools/2/tag', [ 'tag_id' => 2 ]);
        $this->post('/tools/2/tag', [ 'tag_id' => 3 ]);
        $this->post('/tools/2/tag', [ 'tag_id' => 4 ]);

        $this->assertCount(6, TagTool::all());

        $this->delete('/tools/1');
        $this->assertCount(4, TagTool::all());

        $this->delete('/tools/2');
        $this->assertCount(0, TagTool::all());

        // tags still exist
        $this->assertCount(4, Tag::all());
    }
}
