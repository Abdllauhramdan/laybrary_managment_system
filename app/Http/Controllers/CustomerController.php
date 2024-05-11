<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\CustomerRequest;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $customers = Customer::all();
            return $this->customeResponse(CustomerResource::collection($customers), "Customers retrieved successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to fetch customers: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to fetch customers", 500);
        }
    }

    public function store(CustomerRequest $request)
    {
        try {
            $customer = Customer::create($request->validated());
            return $this->customeResponse(new CustomerResource($customer), "Customer created successfully", 201);
        } catch (\Throwable $th) {
            Log::error("Failed to create customer: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to create customer", 500);
        }
    }

    public function show(Customer $customer)
    {
        try {
            return $this->customeResponse(new CustomerResource($customer), "Customer details retrieved", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to retrieve customer: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to retrieve customer", 500);
        }
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $customer->update($request->validated());
            return $this->customeResponse(new CustomerResource($customer), "Customer updated successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to update customer: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to update customer", 500);
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return $this->customeResponse(null, "Customer deleted successfully", 204);
        } catch (\Throwable $th) {
            Log::error("Failed to delete customer: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to delete customer", 500);
        }
    }

    public function restore($id)
    {
        try {
            $customer = Customer::withTrashed()->findOrFail($id);
            $customer->restore();
            return $this->customeResponse(new CustomerResource($customer), "Customer restored successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to restore customer: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to restore customer", 500);
        }
    }

    public function forceDelete(Customer $customer)
    {
        try {
            $customer->forceDelete();
            return $this->customeResponse(null, "Customer permanently deleted", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to permanently delete customer: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to permanently delete customer", 500);
        }
    }
}