<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class TipoCartaPresenFormRequest extends Request
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
            'txt_tipoCartaPresen'=>'required|max:50',
            'txt_nombreTipoCartaP'=>'required|max:50',
            'txt_nombreBreveTipoCartaP'=>'required|max:50'
        ];
    }
}
