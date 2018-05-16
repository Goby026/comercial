<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class CosteoFormRequest extends Request
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
            'txt_codiMarca'=>'required|max:50',
            'txt_nombreProducProveedor'=>'required|max:50',
            'txt_nombreBreveProducP'=>'required|max:50',
            'txt_codiProducMarca'=>'required|max:50',
            'txt_codInterno'=>'required|max:50',
            'txt_decripProduc'=>'required|max:400'
        ];
    }
}
