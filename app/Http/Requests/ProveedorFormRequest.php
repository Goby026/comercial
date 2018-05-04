<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class ProveedorFormRequest extends Request
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
            'txt_nombreProveedor'=>'required|max:50',
            'txt_nombreBreveProveedor'=>'required|max:50',
            'txt_RucProveedor'=>'required|max:50',
            'txt_direcProveedor'=>'required|max:50',
            'txt_webProveedor'=>'required|max:50',
            'txt_codiDistri'=>'required|max:9',
            'txt_codiProvin'=>'required|max:9',
            'txt_codiDepar'=>'required|max:9'
        ];
    }
}
