<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProjectRequest extends Request
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
         'project_terms' => 'required',
         'source' => 'required',
         'address_1' => 'required',
         'contact_person_1' => 'required',
         'contact_number_1' => 'required',
         'email_1' => 'required|unique:projects,email_1',
         'consultant' => 'required',
         'address_2' => 'required',
         'contact_person_2' => 'required',
         'contact_number_2' => 'required',
         'email_2' => 'required|unique:projects,email_2',
         'shorted_list_epc' => 'required',
         'address_3' => 'required',
         'contact_person_3' => 'required',
         'contact_number_3' => 'required',
         'email_3' => 'required|unique:projects,email_3',
         'approved_vendors_list' => 'required',
         'requirement' => 'required',
         'epc_award' => 'required',
         'award_date' => 'required|date:Y-m-d',
         'implementation_date' => 'required|date:Y-m-d',
         'execution_date' => 'required|date:Y-m-d',
         'bu' => 'required',
         'bu_reference' => 'required',
         'wpc_reference' => 'required',
         'affinity_reference' => 'required',
         'value' => 'required',
         'status' => 'required',
         'material_number' => 'required|unique:projects,material_number',
         'serial_number' => 'required|unique:projects,serial_number',
         'tag_number' => 'required|unique:projects,tag_number',
         'drawing_number' => 'required|unique:projects,drawing_number',
         'reference_number' => 'required|unique:projects,drawing_number',
         'epc' => 'required',
         'vendors' => 'required',
         'final_result' => 'required'
      ];
   }

   public function messages()
   {
      return [
         'address_1.required' => 'The 1st address field is required.',
         'address_2.required' => 'The 2nd address field is required.',
         'address_3.required' => 'The 3rd address field is required.',

         'email_1.required' => 'The 1st e-mail field is required.',
         'email_2.required' => 'The 2nd e-mail field is required.',
         'email_3.required' => 'The 3rd e-mail field is required.',

         'contact_person_1.required' => 'The 1st contact person field is required.',
         'contact_person_2.required' => 'The 2nd contact person field is required.',
         'contact_person_3.required' => 'The 3rd contact person field is required.',

         'contact_number_1.required' => 'The 1st contact number field is required.',
         'contact_number_2.required' => 'The 2nd contact number field is required.',
         'contact_number_3.required' => 'The 3rd contact number field is required.',
      ];
   }
}
