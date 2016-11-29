<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateApprovedBuyAndSellProposalBySecretary extends Request
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
            "qrc_reference" => 'required|unique:buy_and_sell_proposals,qrc_ref',
            "validity" => 'required',
            "payment_terms" => 'required'
        ];
    }
}
