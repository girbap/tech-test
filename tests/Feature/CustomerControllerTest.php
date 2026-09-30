<?php

namespace Tests\Unit;

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
            '<form>',

            'First name',
            'Last name',
            'Email',
            'Phone',
            'Date of birth',
            'Would you like to receive marketing correspondence?',

        ], escape: false);
    }
}
