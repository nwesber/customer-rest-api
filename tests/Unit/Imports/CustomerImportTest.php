<?php

namespace Tests\Unit\Imports;

use Tests\TestCase;
use App\Imports\CustomerImport;
use App\DTO\CustomerDTO;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Mockery;

class CustomerImportTest extends TestCase
{
    public function test_can_fetch_users_from_api_and_map_to_customer_entity()
    {
        $response = [
            'results' => [
                [
                    'name' => [
                        'first' => 'John',
                        'last' => 'Doe',
                    ],
                    'email' => 'johndoe@example.com',
                    'nat' => 'AU',
                    'login' => [
                        'password' => 'password',
                        'username' => 'johndoe457789'
                    ],
                    'location' => [
                        'country' => 'Australia',
                        'city' => 'Sydney'
                    ],
                    'gender' => 'male',
                    'phone' => '1234576'
                ],
                [
                    'name' => [
                        'first' => 'Jane',
                        'last' => 'Doe',
                    ],
                    'email' => 'janedoe@example.com',
                    'nat' => 'AU',
                    'login' => [
                        'password' => 'password',
                        'username' => 'johndoe123456643'
                    ],
                    'location' => [
                        'country' => 'Australia',
                        'city' => 'Sydney'
                    ],
                    'gender' => 'male',
                    'phone' => '1234576'
                ],
            ],
        ];

        Http::fake([
            'https://randomuser.me/*' => Http::response($response, 200)
        ]);

        $customerService = Mockery::mock(CustomerService::class);

        $customerService->shouldReceive('createOrUpdateCustomer')->twice()->andReturn(true);


        $importer = new CustomerImport($customerService);
        $customers = $importer->fetchCustomers('AU', 2);

        $this->assertInstanceOf(Collection::class, $customers);
        $this->assertCount(2, $customers);

        $customer1 = $customers->get(0);
        $this->assertInstanceOf(CustomerDTO::class, $customer1);
        $this->assertEquals('John', $customer1->getFirstName());
        $this->assertEquals('Doe', $customer1->getLastName());
        $this->assertEquals('johndoe@example.com', $customer1->getEmail());

        $customer2 = $customers->get(1);
        $this->assertInstanceOf(CustomerDTO::class, $customer2);
        $this->assertEquals('Jane', $customer2->getFirstName());
        $this->assertEquals('Doe', $customer2->getLastName());
        $this->assertEquals('janedoe@example.com', $customer2->getEmail());

        Http::assertSent(function ($request) {
            return $request->method() == 'GET' &&
                   $request['results'] == 2 &&
                   $request['nat'] == 'AU';
        });
    }

}
