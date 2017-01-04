<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'postal_code'
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createCustomer($createCustomerRequest)
    {
        $customer = new Customer();
        $customer->name = trim(ucwords($createCustomerRequest->get('name'), " "));
        $customer->address = trim(ucwords($createCustomerRequest->get('address'), " "));
        $customer->city = trim(ucfirst($createCustomerRequest->get('city')));
        $customer->postal_code = trim($createCustomerRequest->get('postal_code'));
        $customer->operation_customer_account_no = trim($createCustomerRequest->get('operation_customer_account_no'));

        if($customer->save()) {
            return redirect()->back()->with('message', 'Customer [' . $customer->name . '] was successfully created');
        }
    }
}
