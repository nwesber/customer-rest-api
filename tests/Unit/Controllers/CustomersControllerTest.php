<?php

namespace Tests\Unit\Controllers;

use App\Models\Customers;
use Tests\TestCase;

class CustomersControllerTest extends TestCase
{

    public function test_it_can_get_a_list_of_customers()
    {
        $customers = Customers::factory()->count(10)->make();
        $response = $this->get('/api/customers');
        $response->assertStatus(200);
    }

    public function test_it_can_get_a_single_customer()
    {
        $customer = Customers::factory()->make();
        $response = $this->get('/api/customers/' . $customer->id);
        $response->assertStatus(200);
    }

    public function test_it_returns_404_if_customers_is_not_found()
    {
        $nonExistingCustomerId = 999999;
        $response = $this->get('/api/customers/' . $nonExistingCustomerId);
        $response->assertStatus(404);
    }
}