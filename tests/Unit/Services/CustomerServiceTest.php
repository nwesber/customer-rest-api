<?php

namespace Tests\Unit\Services;

use App\DTO\CustomerDTO;
use App\Entities\Customer;
use App\Services\CustomerService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{

    private $entityManagerMock;
    private $customerService;
    private $customerRepository;

    protected function setUp(): void
    {
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $this->customerRepository = $this->createMock(EntityRepository::class);
        $this->customerService = new CustomerService($this->entityManagerMock);
    }


    public function test_it_can_fetch_all_customers()
    {
        $customer1 = new Customer();
        $customer1->setId(1);
        $customer1->setFirstName('John');
        $customer1->setLastName('Doe');
        $customer1->setEmail('johndoe@example.com');

        $customer2 = new Customer();
        $customer2->setId(2);
        $customer2->setFirstName('Jane');
        $customer2->setLastName('Doe');
        $customer2->setEmail('janedoe@example.com');

        $this->customerRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([$customer1, $customer2]);

        $this->entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Customer::class)
            ->willReturn($this->customerRepository);

        $result = $this->customerService->fetchCustomers();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(Customer::class, $result[0]);
        $this->assertInstanceOf(Customer::class, $result[1]);
        $this->assertEquals($customer1->getId(), $result[0]->getId());
        $this->assertEquals($customer1->getFirstName(), $result[0]->getFirstName());
        $this->assertEquals($customer1->getLastName(), $result[0]->getLastName());
        $this->assertEquals($customer1->getEmail(), $result[0]->getEmail());
        $this->assertEquals($customer2->getId(), $result[1]->getId());
        $this->assertEquals($customer2->getFirstName(), $result[1]->getFirstName());
        $this->assertEquals($customer2->getLastName(), $result[1]->getLastName());
        $this->assertEquals($customer2->getEmail(), $result[1]->getEmail());
    }

    public function test_it_can_fetch_a_single_customer()
    {
        $customer = new Customer();
        $customer->setId(1);
        $customer->setFirstName('John');
        $customer->setLastName('Doe');
        $customer->setEmail('johndoe@example.com');

        $this->customerRepository->expects($this->once())
            ->method('find')
            ->with($this->equalTo($customer->getId()))
            ->willReturn($customer);

        $this->entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Customer::class)
            ->willReturn($this->customerRepository);

        $result = $this->customerService->fetchCustomer($customer->getId());

        $this->assertEquals($customer->getId(), $result->getId());
        $this->assertEquals($customer->getFirstName(), $result->getFirstName());
        $this->assertEquals($customer->getLastName(), $result->getLastName());
        $this->assertEquals($customer->getEmail(), $result->getEmail());
    }

    public function test_it_can_create_or_update_a_single_customer()
    {
        $customerDTO = new CustomerDTO();
        $customerDTO->setEmail('test@example.com');
        $customerDTO->setFirstName('Test');
        $customerDTO->setLastName('User');

        $customer = new Customer();
        $customer->setFirstName($customerDTO->getFirstName());
        $customer->setLastName($customerDTO->getLastName());
        $customer->setEmail($customerDTO->getEmail());

        $this->entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Customer::class)
            ->willReturn($this->customerRepository);

        $result = $this->customerService->createOrUpdateCustomer($customerDTO);
        
        $this->assertInstanceOf(Customer::class, $result);
        $this->assertEquals($customer->getEmail(), $result->getEmail());
        $this->assertEquals($customer->getFirstName(), $result->getFirstName());
        $this->assertEquals($customer->getLastName(), $result->getLastName());
    }
}