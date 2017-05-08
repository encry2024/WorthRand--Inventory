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
         'name' => 'required',
         'model' => 'required',
         'ccn_number' => 'required',
         'part_number' => 'required',
         'reference_number' => 'required',
         'material_number' => 'required',
         'serial_number' => 'required',
         'tag_number' => 'required',
         'drawing_number' => 'required|unique:projects,drawing_number,'.Input::get('project_id'),
         'address' => 'required',
         'contact_person' => 'required',
         'consultant' => 'required',
         'epc' => 'required',
         'vendors' => 'required',
         'epc_award' => 'required',
         'implementation_date' => 'required|date:Y-m-d',
         'bu' => 'required',
         'status' => 'required',
         'final_result' => 'required',
         'value' => 'required',
         'scanned_file' => 'mimes:pdf'
      ];
   }
}
