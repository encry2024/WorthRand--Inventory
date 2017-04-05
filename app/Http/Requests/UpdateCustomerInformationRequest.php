<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCustomerInformationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
            'position_of_contact_person' => 'required',
            'plant_site_address' => 'required'
        ];
    }
}
