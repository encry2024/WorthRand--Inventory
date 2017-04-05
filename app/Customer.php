<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Customer extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'name', 'address', 'city', 'postal_code', 'user_id', 'contact_person', 'contact_number', 'position_of_contact_person', 
      'plant_site_address'
   ];

   protected $dates = ['deleted_at'];

   public function branches()
   {
      return $this->hasMany(Branch::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function indented_proposals()
   {
      return $this->hasMany(IndentedProposal::class);
   }

   public function buy_and_sell_proposals()
   {
      return $this->hasMany(BuyAndSellProposal::class);
   }

   public static function createCustomer($createCustomerRequest)
   {
      $customer = new Customer();
      $customer->name = trim(ucwords($createCustomerRequest->get('name'), " "));
      $customer->address = trim(ucwords($createCustomerRequest->get('address'), " "));
      $customer->city = trim(ucfirst($createCustomerRequest->get('city')));
      $customer->postal_code = trim($createCustomerRequest->get('postal_code'));
      $customer->contact_person = trim($createCustomerRequest->get('contact_person'));
      $customer->plant_site_address = trim($createCustomerRequest->get('plant_site_address'));
      $customer->contact_number = trim($createCustomerRequest->get('contact_number'));
      $customer->position_of_contact_person = trim($createCustomerRequest->get('position_of_contact_person'));

      if($customer->save()) {
         return redirect()->back()->with('message', 'Customer "' . $customer->name . '" was successfully created');
      }
   }

   public static function adminCustomerIndex($request)
   {
      $ctr = 0;
      $customers = DB::table('customers')
      ->select('customers.*');

      if($request->has('filter')) {
         $customers = $customers->where('name', 'LIKE', '%'.$request->get('filter').'%')
         ->orWhere('city', 'LIKE', '%'.$request->get('filter').'%')
         ->orWhere('postal_code', 'LIKE', '%'.$request->get('filter').'%')
         ->orWhere('contact_person', 'LIKE', '%'.$request->get('filter').'%');
      }

      $customers = $customers->paginate(30);
      $customers->setPath('customers');

      return view('customer.admin.index', compact('customers', 'ctr'));
   }
}
