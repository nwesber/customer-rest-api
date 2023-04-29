<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomersResource;
use App\Services\CustomerService;

/**
 * CustomersController
 * 
 * @category Controllers
 * @package App\Http\Controllers
 */
class CustomersController extends Controller 
{

    /**
     * Display a listing of the customers.
     * 
     * @param CustomerService $customerService The customer service
     * @return CustomersResource $customers 
     */
    public function index(CustomerService $customerService)
    {
        $customers = $customerService->fetchCustomers();
        return CustomersResource::collection($customers);
    }

    /**
     * Display the specified customer.
     * 
     * @param CustomerService $customerService The customer service
     * @param string $id The customer Id.
     * @return CustomerResource
     */
    public function show(CustomerService $customerService, $id)
    {
        $customer = $customerService->fetchCustomer($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return new CustomerResource($customer);
    }

}
