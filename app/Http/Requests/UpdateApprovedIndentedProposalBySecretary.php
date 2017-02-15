<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateApprovedIndentedProposalBySecretary extends Request
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
            'purchase_order'    => 'required|unique:indented_proposals,purchase_order,'.$this->request->get('indent_proposal_id'),
            'invoice_to'        => 'required',
            'invoice_to_address'   => 'required',
            /*'ship_to'           => 'required',
            'ship_to_address'   => 'required',
            'ship_via'          => 'required',
            'packing'           => 'required',
            'documents'         => 'required',
            'insurance'         => 'required',
            'bank_detail_owner' => 'required',
            'bank_detail_address' => 'required',*/
            'bank_detail_account_number' => 'required',
            /*'bank_detail_swift_code' => 'required',
            'bank_detail_account_name' => 'required',
            'commission_note'   => 'required',
            'commission_address' => 'required',
            'commission_account_number' => 'required',
            'commission_swift_code' => 'required'*/
        ];
    }
}
