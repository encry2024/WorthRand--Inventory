<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddProjectPricingHistoryRequest extends Request
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
            'po_number' => 'required|unique:project_pricing_histories',
            'pricing_date' => 'required|digits:4|integer|min:1900|max:'.\Carbon\Carbon::tomorrow()->year,
            'price' => 'required',
            'terms' => 'required',
            'delivery' => 'required',
            'fpd_reference' => 'required',
            'wpc_reference' => 'required'
        ];
    }
}
