<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class IgvFormRequest extends Request
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
            'txt_codiCola'=>'required|max:50',
            'txt_valorIgv'=>'required|max:50',
            'txt_fechaInIgv'=>'required|max:50',
            'txt_fechaFinalIgv'=>'required|max:50'
        ];
    }
}
