<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class PrecioProductoProveedorFormRequest extends Request
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
            'txt_codiProducProveedor'=>'required|max:50',
            'txt_codiProveedor'=>'required|max:50',
            'txt_precioProducDolar'=>'required|max:50',
            'txt_stockProduc'=>'required|max:50',
            'txt_tiempoEntreProduc'=>'required|max:50'
            //'imagen'=>'mimes:jpeg,bmp,png' //para trabajar con imagenes
        ];
    }
}
