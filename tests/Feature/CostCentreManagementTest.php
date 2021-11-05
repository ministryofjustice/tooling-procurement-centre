<?php

namespace Tests\Feature;

use App\Models\CostCentre;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class CostCentreManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_no_unauthorised_access_to_cost_centre_crud()
    {
        $this->withoutExceptionHandling();

        CostCentre::factory()->create();
        $this->assertCount(1, CostCentre::all());

        $this->expectException(AuthenticationException::class);
        $response = $this->get(route('cost-centres'));
        $response->assertForbidden();
    }

    public function test_a_cost_centre_can_be_created()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $response = $this->post(route('cost-centres-add'), [
            'name' => 'My Cost Centre',
            'number' => '10044567'
        ]);
        $cost_centre = CostCentre::first();
        $response->assertRedirect(route('cost-centre', $cost_centre->slug));
        $this->assertEquals('10044567', $cost_centre->number);
    }
}
