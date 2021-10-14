<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithAuthUser;
use function Couchbase\fastlzCompress;

class ContactManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_a_contact_can_be_added()
    {
        $this->authorisedUser();

        $response = $this->post('dashboard/contacts', [
            'name' => 'New tooling contact',
            'email' => 'tooling.contact@justice.gov.uk'
        ]);

        $response->assertCreated();
        $this->assertCount(1, Contact::all());
    }

    /** @test */
    public function test_a_contact_cannot_be_added_by_unknown_user()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $response = $this->post('dashboard/contacts', [
            'name' => 'New tooling contact',
            'email' => 'tooling.contact@justice.gov.uk'
        ]);
        $response->assertForbidden();
    }

    public function test_a_contact_can_be_updated()
    {
        $this->authorisedUser();

        $contact = Contact::factory()->create();
        $this->assertCount(1, Contact::all());

        $patch_name = 'James McNally';
        $patch_email = 'tooling.contact@justice.gov.uk';
        $response = $this->patch('dashboard/contacts/' . $contact->id, [
            'name' => $patch_name,
            'email' => $patch_email
        ]);

        $contact = Contact::first();
        $this->assertEquals($patch_name, $contact->name);
        $this->assertEquals($patch_email, $contact->email);

        $response->assertRedirect($contact->path());
    }

    public function test_a_contact_can_be_removed()
    {
        $this->authorisedUser();

        $contact = Contact::factory()->create();
        $response = $this->delete('dashboard/contacts/' . $contact->id);
        $response->assertRedirect('dashboard/contacts');

        $this->assertCount(0, Contact::all());
    }

    public function test_a_contact_create_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $response = $this->get('/dashboard/contacts/create');
        $response->assertStatus(200);
    }
}
