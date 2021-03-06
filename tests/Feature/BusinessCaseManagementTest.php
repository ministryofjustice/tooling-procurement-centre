<?php

namespace Tests\Feature;

use App\Models\BusinessCase;
use App\Models\Tool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class BusinessCaseManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_business_cases_can_be_listed()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        BusinessCase::factory()->create();
        BusinessCase::factory()->create();
        $this->assertCount(2, BusinessCase::all());

        $response = $this->get(route('business-cases'));
        $response->assertStatus(200);

        // check response data exists and contains only the records we
        // created above with factory
        $this->assertArrayHasKey('0', $response['business_cases']);
        $this->assertArrayHasKey('1', $response['business_cases']);
        $this->assertArrayNotHasKey('2', $response['business_cases']);
    }

    public function test_a_business_case_can_be_added()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();

        $response = $this->post('dashboard/business-cases', [
            'name' => 'A solid little business case for a lovely little tool',
            'text' => 'A business case is developed during the early stages of a project and outlines the why, what,
                        how, and who necessary to decide if it is worthwhile continuing a project. One of the first
                        things you need to know when starting a new project are the benefits of the proposed business
                        change and how to communicate those benefits to the business.',
            'tool_id' => $tool->id
        ]);
        $response->assertRedirect(route('business-cases'));
        $this->assertCount(1, BusinessCase::all());
    }

    public function test_a_business_case_can_be_added_with_link_and_without_text()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();

        $response = $this->post('dashboard/business-cases', [
            'name' => 'A solid little business case for a lovely little tool',
            'link' => 'https://my-business-case-documentation.doc',
            'tool_id' => $tool->id
        ]);
        $response->assertRedirect(route('business-cases'));
        $this->assertCount(1, BusinessCase::all());
    }

    public function test_a_business_case_cannot_be_added_without_link_and_text()
    {
        $this->withoutExceptionHandling(); // required to perform test
        $this->authorisedUser();

        $tool = Tool::factory()->create();

        $this->expectException('Illuminate\Validation\ValidationException');

        $response = $this->post('dashboard/business-cases', [
            'name' => 'A solid little business case for a lovely little tool',
            'tool_id' => $tool->id
        ]);
        $response->assertSessionHasErrors(['link', 'text']);
        $this->assertCount(0, BusinessCase::all());
    }

    public function test_a_business_case_add_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();

        $this->authorisedUser();

        $tool = Tool::factory()->create();

        $response = $this->get(route('business-cases-create', $tool->slug));
        $response->assertStatus(200);
    }

    public function test_a_business_case_can_be_removed()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $business_case = BusinessCase::factory()->create();
        $response = $this->delete('dashboard/business-cases/' . $business_case->id);
        $response->assertRedirect('dashboard/business-cases');

        $this->assertCount(0, BusinessCase::all());
    }
}
