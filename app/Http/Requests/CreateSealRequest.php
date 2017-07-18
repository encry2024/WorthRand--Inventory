<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateSealRequest extends Request
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
            'drawing_number' => 'required',
            'bom_number' => 'required',
            'end_user' => 'required',
            'seal_type' => 'required',
            'size' => 'required',
            'material_number' => 'required',
            'code' => 'required',
            'model' => 'required',
            'serial_number' => 'required',
            'tag' => 'required',
            'scanned_file' => 'mimes:pdf'
        ];
    }
}
