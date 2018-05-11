<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class ContactoClienteFormRequest extends Request
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
            'apePaterContacC'=>'txt_apePaterContacC|max:50',
            'apeMaterContacC'=>'txt_apeMaterContacC|max:50',
            'nombreContacClien'=>'txt_nombreContacClien|max:50',
            'correoContacClien'=>'txt_correoContacClien|max:50',
            'direcContacClien'=>'txt_direcContacClien|max:50',
            'codiDistri'=>'txt_codiDistri|max:50',
            'codiProvin'=>'txt_codiProvin|max:50',
            'codiDepar'=>'txt_codiDepar|max:50',
            'celu01ContacClien'=>'txt_celu01ContacClien|max:50',
            'celu02ContacClien'=>'txt_celu02ContacClien|max:50',
            'teleContacClien'=>'txt_teleContacClien|max:50',
            'aneContacClien'=>'txt_aneContacClien|max:50',
            'aRegisContacClien'=>'fechaRegisContacClien|max:50',
            'codiClienJuri'=>'txt_codiClienJuri|max:50',
            'codiCola'=>'txt_codiCola|max:50'
        ];
    }
}
