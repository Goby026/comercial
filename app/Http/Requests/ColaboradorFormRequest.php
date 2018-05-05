<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class ColaboradorFormRequest extends Request
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
            'txt_apePaterCola'=>'required|max:50',
            'txt_apeMaterCola'=>'required|max:50',
            'txt_nombreCola'=>'required|max:100',
            'txt_dniCola'=>'required|max:10',
            'txt_fechaNaciCola'=>'required|max:50',
            'txt_correoCorpoCola'=>'required|max:50',
            'txt_correoPersoCola'=>'required|max:50',
            'txt_celuCorpoCola'=>'required|max:50',
            'txt_celuPersoCola'=>'required|max:50',
            'txt_codiDepar'=>'required|max:50',
            'txt_codiProvin'=>'required|max:50',
            'txt_codiDistri'=>'required|max:50',
            'txt_direcCola'=>'required|max:50',
            'txt_fotoCola'=>'required|max:50',
            'txt_fechaRegisCola'=>'required|max:50',
            'txt_contraCola'=>'required|max:50'
        ];
    }
}
