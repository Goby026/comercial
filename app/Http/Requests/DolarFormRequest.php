<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class DolarFormRequest extends Request
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
            'txt_dolarCompra'=>'required|max:50',
            'txt_dolarVenta'=>'required|max:50',
            'txt_fechaCambio'=>'required|max:50',
            'txt_codiDolarProveedor'=>'required|max:50',
            'txt_codiCola'=>'required|max:50'
        ];
    }
}
