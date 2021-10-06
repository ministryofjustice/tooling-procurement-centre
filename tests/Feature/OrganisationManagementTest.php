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

    public function test_an_organisation_can_be_created()
    {
        // authentication needed
        $this->authorisedUser();

        $response = $this->post('/organisations', [
            'name' => 'Ministry of Justice HQ',
            'address' => '102 Petty France, London SW1H 9AJ'
        ]);
        $response->assertCreated();

        $this->assertCount('1', Organisation::all());
    }
}
