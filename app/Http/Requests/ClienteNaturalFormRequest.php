<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class ClienteNaturalFormRequest extends Request
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
            'apePaterClienN'=>'txt_apePaterClienN|max:50',
            'apeMaterClienN'=>'txt_apeMaterClienN|max:50',
            'nombreClienNatu'=>'txt_nombreClienNatu|max:50',
            'dniClienNatu'=>'txt_dniClienNatu|max:50',
            'direcClienNatu'=>'txt_direcClienNatu|max:50',
            'codiDistri'=>'txt_codiDistri|max:50',
            'codiProvin'=>'txt_codiProvin|max:50',
            'codiDepar'=>'txt_codiDepar|max:50',
            'fechaNaciClienN'=>'txt_fechaNaciClienN|max:50',
            'correoClienNatu'=>'txt_correoClienNatu|max:50',
            'tele01ClienNatu'=>'txt_tele01ClienNatu|max:50',
            'tele02ClienNatu'=>'txt_tele02ClienNatu|max:50',
            'fechaRegisClien'=>'txt_fechaRegisClien|max:50'
        ];
    }
}
