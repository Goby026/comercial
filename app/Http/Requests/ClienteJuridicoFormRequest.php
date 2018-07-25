<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class ClienteJuridicoFormRequest extends Request
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
            'txt_razonSocial'=>'required|max:50',
            'txt_ruc'=>'required|max:12',
            'txt_direccion'=>'required|max:100',
            'txt_codiDistri'=>'required|max:10',
            'txt_codiProvin'=>'required|max:10',
            'txt_codiDepar'=>'required|max:10',
            'idTipocli'=>'required|max:45',
            'txt_web'=>'required|max:70'
            //'imagen'=>'mimes:jpeg,bmp,png' //para validar las imagenes q se suban
        ];
    }
}
