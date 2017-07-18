<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;

class UpdateProjectInformationRequest extends Request
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
         'customer_id' => 'required',
         'name' => 'required',
         'terms' => 'required',
         'source' => 'required',
         'address_1' => 'required',
         'contact_person_1' => 'required',
         'contact_number_1' => 'required',
         'email_1' => 'required|unique:email_1,projects',
         'consultant' => 'required',
         'address_2' => 'required',
         'contact_person_2' => 'required',
         'contact_number_2' => 'required',
         'email_2' => 'required|unique:email_2,projects',
         'shorted_list_epc' => 'required',
         'address_3' => 'required',
         'contact_person_3' => 'required',
         'contact_number_3' => 'required',
         'email' => 'required|unique:email_3,projects',
         'approved_vendors_list' => 'required',
         'requirement' => 'required',
         'epc_award' => 'required',
         'award_Date' => 'date:Y-m-d',
         'implementation_date' => 'required|date:Y-m-d',
         'execution_date' => 'date:Y-m-d',
         'bu' => 'required',
         'bu_reference' => 'required',
         'wpc_reference' => 'required|unique:projects,wpc_reference',
         'affinity_reference' => 'required',
         'value' => 'required',
         'status' => 'required',
         'material_number' => 'required|unique:projects,material_number',
         'serial_number' => 'required|unique:projects,serial_number',
         'tag_number' => 'required|unique:projects,tag_number',
         'drawing_number' => 'required',
         'reference_number' => 'required|unique:projects,drawing_number',
         'epc' => 'required',
         'vendors' => 'required',
         'final_result' => 'required',
         'scanned_file' => 'mimes:pdf'
      ];
   }
}
