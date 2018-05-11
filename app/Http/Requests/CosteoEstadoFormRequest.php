<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class CosteoEstadoFormRequest extends Request
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
            'txt_nombreCosteoEsta'=>'required|max:50',
            'txt_nombreBreveCosteoEsta'=>'required|max:50',
            'txt_ordenCosteoEsta'=>'required|max:100'
        ];
    }
}
