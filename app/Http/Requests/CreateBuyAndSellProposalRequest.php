<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBuyAndSellProposalRequest extends Request
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
            'buy_and_sell_proposal_id' => 'required',
            // 'purchase_order' => 'required|unique:buy_and_sell_proposals,purchase_order',
            'terms' => 'required',
            'validity' => 'required',
            'invoice_to' => 'required',
            'invoice_address' => 'required',
            'qrc_reference' => 'required',
            'quantity.*' => 'required',
            'price.*' => 'required',
            'delivery.*' => 'required',
            'wpc_reference' => 'required|unique:buy_and_sell_proposals,wpc_reference',
            'customer_id' => 'required|exists:customers,id',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Please provide a legal Customer',
        ];
    }
}
