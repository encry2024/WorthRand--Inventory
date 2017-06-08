<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResendDraftIndentedProposal extends Request
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
         'fileField'         => 'mimes:pdf,xlsx,xls|max:10000',
      ];
   }
}
