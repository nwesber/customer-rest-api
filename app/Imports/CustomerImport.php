<?php

namespace App\Imports;

use App\DTO\CustomerDTO;
use App\Services\CustomerService;
use App\Utilities\ArrayUtil;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Illuminate\Support\Facades\Log;

/**
 * Imports data from Random User API into the database
 * 
 * Usage: yourFunction(CustomerImport $customerImport)
 * $customerImport->fetchCustomers()
 */
class CustomerImport {

    /**
     * The customer service
     * 
     * @var $customerService
     */
    private $customerService;

    /**
     * CustomerImport Constructor
     * 
     * @param CustomerService $customerService The customer service
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Fetch Customers from Random User API
     * 
     * @param string $nationality The Nationality of the Customers to Fetch. Optional, defaults to AU.
     * @param int $minUsers The amount of customers to fetch. Optional, defaults to 100.
     * @return Collection $customers The list of customers fetched.
     */
    public function fetchCustomers(
        $nationality = 'AU',
        $minUsers = 100): Collection
    {
        $response = Http::get(config('datasource.random_user_api_url'), [
            'nat' => $nationality,
            'results' => $minUsers
        ]);

        $data = $response->json();

        $customers = collect($data['results'])->map(function ($customerData) {
            $customer = new CustomerDTO(
                ArrayUtil::fetchNestedArrayValues($customerData, 'name', 'first'),
                ArrayUtil::fetchNestedArrayValues($customerData, 'name', 'last'),
                ArrayUtil::fetchNestedArrayValues($customerData, 'email'),
                md5(ArrayUtil::fetchNestedArrayValues($customerData, 'login', 'password')),
                ArrayUtil::fetchNestedArrayValues($customerData, 'location', 'country'),
                ArrayUtil::fetchNestedArrayValues($customerData, 'location', 'city'),
                ArrayUtil::fetchNestedArrayValues($customerData, 'login', 'username'),
                ArrayUtil::fetchNestedArrayValues($customerData, 'gender'),
                ArrayUtil::fetchNestedArrayValues($customerData, 'phone')
            );
            
            try {
                $this->customerService->createOrUpdateCustomer($customer);
                return $customer;
            } catch (ORMException | OptimisticLockException $exception){
                Log::error('Error importing data: ' . $exception->getMessage());
                throw new \RuntimeException('Sorry, we could not create or update the customer. Please try again later.', 500);
            }
    
        });

        return $customers;
    }
}