<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class CotizacionFormRequest extends Request
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
            // 'txt_fechaCoti'=>'required|max:50',
            // 'txt_codiCosteo'=>'required|max:50',
            // 'txt_asuntoCoti'=>'required|max:20',
            // 'txt_codiClien'=>'required|max:20',
            // 'txt_codiTipoCliente'=>'required|max:20',
            // 'txt_codiCola'=>'required|max:20',
            // 'txt_tiemCoti'=>'required|max:20',
            // 'txt_codiCotiEsta'=>'required|max:20',
            // 'txt_estado'=>'required|max:20'
        ];
    }
}
