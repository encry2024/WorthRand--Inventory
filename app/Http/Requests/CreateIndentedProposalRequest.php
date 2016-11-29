<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateIndentedProposalRequest extends Request
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
            'indent_proposal_id' => 'required',
            'wpc_reference'    => 'required|unique:indented_proposals,wpc_reference',
            'customer_id'       => 'required|exists:customers,id',
            'rfq_number'        => 'required',
            'quantity.*'        => 'required',
            'price.*'           => 'required',
            'delivery.*'        => 'required',
            'fileField'         => 'mimes:pdf|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Branch '. $this->request->get('branch') . ' has no Main Office',
            'branch_id.required' => 'Please provide a legal Branch',
            'terms_of_payment_1.required' => 'The terms of payment note field is required'
        ];
    }
}
