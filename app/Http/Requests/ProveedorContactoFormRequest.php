<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class ProveedorContactoFormRequest extends Request
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
            'txt_apePaterProveeC'=>'required|max:50',
            'txt_apeMaterProveeC'=>'required|max:50',
            'txt_nombreProveeContac'=>'required|max:50',
            'txt_dniProveeContac'=>'required|max:50',
            'txt_celu01ProveeContac'=>'required|max:50',
            'txt_celu02ProveeContac'=>'required|max:50',
            'txt_tele01ProveeContac'=>'required|max:50',
            'txt_anexoProveeContac'=>'required|max:50',
            'txt_correo01ProveeContac'=>'required|max:50',
            'txt_correo02ProveeContac'=>'required|max:50',
            'txt_skypeProveeContac'=>'required|max:50',
            'txt_codiProveedor'=>'required|max:50',
            'txt_codiMarca'=>'required|max:50',
            'txt_codiCargoContac'=>'required|max:50',
            'txt_detalle'=>'required|max:50'
        ];
    }
}
