<?php

namespace Tests\Feature;

use App\Models\Organisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithAuthUser;

class OrganisationManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_the_new_organisation_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();

        // authentication needed
        $this->authorisedUser();

        $response = $this->get('/dashboard/organisations/create');
        $response->assertStatus(200);
    }

    public function test_an_organisation_can_be_created()
    {
        // authentication needed
        $this->authorisedUser();

        $response = $this->post('/dashboard/organisations', [
            'name' => 'Ministry of Justice HQ',
            'address' => '102 Petty France, London SW1H 9AJ'
        ]);
        $response->assertRedirect('/dashboard/organisations');

        $this->assertCount('1', Organisation::all());
    }

    public function test_organisations_can_be_listed()
    {
        $this->withoutExceptionHandling();

        // authentication needed
        $this->authorisedUser();

        $response = $this->get('/dashboard/organisations');
        $response->assertStatus(200);
    }
}
