<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase;

class CustomerControllerTest extends TestCase
{
    public function test_create_thenCreateFormShown(): void
    {
        // Arrange.

        // Act.
        $response = $this->get(route('customer.create'));

        // Assert.
        $response->assertOk();
        $response->assertViewIs('customer.create');

        $response->assertSeeInOrder([

            'New customer form',
            '<form method="POST" action="'.route('customer.store').'">',

            'First name',
            'Last name',
            'Email',
            'Phone',
            'Date of birth',
            'Would you like to receive marketing correspondence?',

        ], escape: false);
    }


    // -------- //


    public function test_store_whenRequiredDataGiven_thenRequestAccepted(): void
    {
        // Arrange.
        $data = [
            'first_name'        => 'Aaron',
            'last_name'         => 'Aaronson',
            'email'             => 'aaron@email.com',
            'phone'             => '+0123456789',
            'date_of_birth'     => '2008-09-30',
            'marketing_consent' => true,
        ];

        // Act.
        $response = $this->from(route('customer.create'))
            ->post(route('customer.store'), $data);

        // Assert.
        $response->assertSessionHasNoErrors();
    }

    public function test_store_whenRequiredDataMissing_thenErrorsReturned(): void
    {
        // Arrange.
        $this->withExceptionHandling();

        $data = [];

        // Act.
        $response = $this->from(route('customer.create'))
            ->post(route('customer.store'), $data);

        // Assert.
        $response->assertRedirect(route('customer.create'));
        $response->assertSessionHasErrors([
            'first_name'    => 'The first name field is required.',
            'last_name'     => 'The last name field is required.',
            'email'         => 'The email field is required.',
            'phone'         => 'The phone field is required.',
            'date_of_birth' => 'The date of birth field is required.',
        ]);
    }

    public function test_store_whenDataAreInvalid_thenErrorsReturned(): void
    {
        // Arrange.
        $this->withExceptionHandling();

        $data = [
            'first_name'        => 100,
            'last_name'         => 100,
            'email'             => 'aaronemail.com',
            'phone'             => '0123+456789',
            'date_of_birth'     => Carbon::tomorrow()->format('Y-m-d'),
            'marketing_consent' => 'maybe',
        ];

        // Act.
        $response = $this->from(route('customer.create'))
            ->post(route('customer.store'), $data);

        // Assert.
        $response->assertRedirect(route('customer.create'));
        $response->assertSessionHasErrors([
            'first_name'        => 'The first name field must be a string.',
            'last_name'         => 'The last name field must be a string.',
            'email'             => 'The email field must be a valid email address.',
            'phone'             => 'The phone field format is invalid.',
            'date_of_birth'     => 'The date of birth field must be a date before today.',
            'marketing_consent' => 'The marketing consent field must be true or false.',
        ]);
    }

    public function test_store_whenErrorsReturned_thenErrorsDisplayed(): void
    {
        // Arrange.
        $this->withExceptionHandling();

        $data = [];

        // Act.
        $response = $this->followingRedirects()
            ->from(route('customer.create'))
            ->post(route('customer.store'), $data);

        // Assert.
        $response->assertViewIs('customer.create');

        $response->assertSeeInOrder([
            'name="first_name"',        '<div>The first name field is required.</div>',
            'name="last_name"',         '<div>The last name field is required.</div>',
            'name="email"',             '<div>The email field is required.</div>',
            'name="phone"',             '<div>The phone field is required.</div>',
            'name="date_of_birth"',     '<div>The date of birth field is required.</div>',
        ], escape: false);
    }
}
