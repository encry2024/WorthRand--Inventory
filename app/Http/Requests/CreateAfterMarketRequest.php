<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAfterMarketRequest extends Request
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
         'model' => 'required',
         'stock_number' => 'max:50',
         'sap_number' => 'max:50',
         'description' => 'max:191',
         'part_number' => 'required',
         'reference_number' => 'required',
         'material_number' => 'required|unique:after_markets,material_number',
         'serial_number' => 'required',
         'tag_number' => 'required',
         'drawing_number' => 'required',
         'ccn_number' => 'required',
         'company_name' => 'required'
      ];
   }
}
