<?php

namespace Tests\Unit\Services;

use App\Entities\Customer;
use App\DTO\CustomerDTO;
use App\Services\CustomerService;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    protected CustomerService $customerService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerService = app(CustomerService::class);
    }

    public function test_it_can_create_customer()
    {
        $customerData = new CustomerDTO(
            'John',
            'Doe',
            'john.doe@example.com',
            md5('password'),
            'Australia',
            'Sydney',
            'johndoe4574567',
            'male',
            '01-8334-6552'
        );

        $customer = $this->customerService->createOrUpdateCustomer($customerData);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals('john.doe@example.com', $customer->getEmail());
        $this->assertEquals('John', $customer->getFirstName());
        $this->assertEquals('Doe', $customer->getLastName());
        $this->assertEquals('male', $customer->getGender());
    }
}