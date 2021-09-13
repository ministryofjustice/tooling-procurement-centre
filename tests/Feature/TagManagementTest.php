<?php

namespace Tests\Feature;

use App\Models\Tag;
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
}
