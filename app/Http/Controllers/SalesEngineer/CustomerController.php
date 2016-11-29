<?php

namespace App\Http\Controllers\SalesEngineer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use Auth;
use App\Branch;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $ctr = 0;
        $customers = Customer::whereUserId(Auth::user()->id)->paginate(50);
        $customers->setPath('customers');

        return view('customer.sales_engineer.index', compact('customers', 'ctr'));
    }

    public function show(Customer $customer)
    {
        return view('customer.sales_engineer.show', compact('customer'));
    }

    public function customerBranchList(Customer $customer)
    {
        $ctr = 0;
        $branches = Branch::whereCustomerId($customer)->paginate(50);
        $branches->setPath('branches');

        return view('customer.sales_engineer.branch.index', compact('branches', 'ctr', 'customer'));
    }

    public function fetchCustomers()
    {
        $jsonData = [];
        $customers = Customer::whereUserId(Auth::user()->id)->get();

        foreach($customers as $customer) {
            $jsonData['suggestions'][] = [
                'id' => $customer->id,
                'value' => $customer->name,
                'address' => $customer->address,
                'customer_id' => $customer->id
            ];
        }

        return json_encode($jsonData);
    }

    /*public function fetchCustomers()
    {
        $jsonified = [];
        $branches = Customer::all();

        foreach($branches as $branch) {
            $jsonified['suggestions'][] = [
                'id' => $branch->id,
                'value' => $branch->name,
                'address' => $branch->address,
                'customer_id' => $branch->customer_id
            ];
        }

        return json_encode($jsonified);
    }*/
}
