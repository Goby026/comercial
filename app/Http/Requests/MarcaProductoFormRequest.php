<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class MarcaProductoFormRequest extends Request
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
            'txt_nombreMarca'=>'required|max:50',
            'txt_nombreBreveMarca'=>'required|max:50',
            'txt_imagenMarca'=>'mimes:jpeg,bmp,png'
            //'imagen'=>'mimes:jpeg,bmp,png' //para trabajar con imagenes
        ];
    }
}
