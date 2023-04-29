<?php

namespace App\Services;

use App\Entities\Customer;
use App\DTO\CustomerDTO;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use PhpParser\Node\Expr\Cast\Bool_;

/**
 * CustomerService Class
 * 
 * This class handles operations related to the customers.
 */
class CustomerService {

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CustomerService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Fetch all customers
     * @return Collection $customers
     */
    public function fetchCustomers()
    {
        $customers = $this->entityManager
            ->getRepository(Customer::class)
            ->findAll();

        return $customers;
    }

    /**
     * Fetch customer by their ID
     * @param int $id The ID of the customer to fetch.
     * @return Customer $customer The customer with the given ID or null if customer does not exist.
     */
    public function fetchCustomer($id): ?Customer
    {
        $customer = $this->entityManager
            ->getRepository(Customer::class)
            ->find($id);

        return $customer;
    }

    /**
     * Creates or updates a customer record.
     * @param CustomerDTO $customerDTO The customers data in data transfer object.
     * @return Customer $customer The created or updated customer.
     * @throws ORMException if an error occurs while persisting the entity
     * @throws OptimisticLockException If a version check on an entity that makes use of optimistic locking fails.
     */
    public function createOrUpdateCustomer(CustomerDTO $customerDTO): Customer|Bool
    {

        $customerRepository = $this->entityManager
            ->getRepository(Customer::class);

        $customer = $customerRepository
            ->findOneBy(['email' => $customerDTO->getEmail()]);

        if ($customer) {
            $customer->setFirstName($customerDTO->getFirstName());
            $customer->setLastName($customerDTO->getLastName());
            $customer->setPassword($customerDTO->getPassword());
            $customer->setGender($customerDTO->getGender());
            $customer->setCountry($customerDTO->getCountry());
            $customer->setCity($customerDTO->getCity());
            $customer->setUsername($customerDTO->getUsername());
            $customer->setPhone($customerDTO->getPhone());
           
        } else {
            $customer = new Customer();
            $customer->setEmail($customerDTO->getEmail());
            $customer->setFirstName($customerDTO->getFirstName());
            $customer->setLastName($customerDTO->getLastName());
            $customer->setPassword($customerDTO->getPassword());
            $customer->setGender($customerDTO->getGender());
            $customer->setCountry($customerDTO->getCountry());
            $customer->setCity($customerDTO->getCity());
            $customer->setUsername($customerDTO->getUsername());
            $customer->setPhone($customerDTO->getPhone());
        }

        $this->entityManager->persist($customer);
        $this->entityManager->flush();  
        
        return $customer;
    }

}