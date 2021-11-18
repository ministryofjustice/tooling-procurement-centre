<?php

namespace Tests\Unit;

use App\Models\Tool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class HealthStatusTest extends TestCase
{
    use WithAuthUser, RefreshDatabase;

    public function test_alert_if_licence_has_invalid_contact_assigned()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        // todo: work through logic and create test
    }

    public function test_alert_if_active_licence_has_expired_date()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        // todo: work through logic and create test
    }

    public function test_alert_if_active_licence_has_close_approaching_expiry_date()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        // todo: work through logic and create test
    }
}
