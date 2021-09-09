<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\Tool;
use App\Models\TagTool;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
