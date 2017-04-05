<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Branch;
use App\Customer;
use App\Http\Requests\CreateCustomerBranchRequest;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
   //
   public function adminCreateBranch(Customer $customer)
   {
      return view('customer.admin.branch.create', compact('customer'));
   }

   public function adminPostCreateBranch(CreateCustomerBranchRequest $createCustomerBranchRequest, Customer $customer)
   {
      $branch = new Branch();
      $branch->customer_id = $createCustomerBranchRequest->get('customer_id');
      $branch->name = ucwords($createCustomerBranchRequest->get('name'), ' ');
      $branch->address = ucwords($createCustomerBranchRequest->get('address'), ' ');
      $branch->city = ucwords($createCustomerBranchRequest->get('city'), ' ');
      $branch->postal_code = $createCustomerBranchRequest->get('postal_code');

      if($branch->save()) {
         return redirect()->back()->with('message', 'Branch ['. $branch->name .'] was successfully created');
      }
   }

   public function adminBranchIndex()
   {
      $ctr = 0;
      $branches = Branch::paginate(30);

      return view('customer.admin.branch.index', compact('branches', 'ctr'));
   }

   public function adminBranchEdit(Branch $branch)
   {
      return view('customer.admin.branch.edit', compact('branch'));
   }

   public function adminBranchShow(Branch $branch)
   {
      return view('customer.admin.branch.show', compact('branch'));
   }

}
