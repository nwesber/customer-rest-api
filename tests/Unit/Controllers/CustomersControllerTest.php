<?php

namespace Tests\Unit\Controllers;

use App\Models\Customers;
use Tests\TestCase;
use Illuminate\Http\Response;

class CustomersControllerTest extends TestCase
{

    public function test_it_can_get_a_list_of_customers()
    {
        $this->json('get', 'api/customers')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'full_name',
                        'email',
                        'country'
                    ]
                ]
            ]);
    }
    public function test_it_can_get_a_single_customer()
    {
        $customer = Customers::factory()->make();
        $response = $this->get('api/customers/' . $customer->id);
        $response->assertStatus(200);
    }

    public function test_it_returns_404_if_customers_is_not_found()
    {
        $nonExistingCustomerId = 999999;
        $response = $this->get('/api/customers/' . $nonExistingCustomerId);
        $response->assertStatus(404);
    }
}