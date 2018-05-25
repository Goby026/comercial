<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class TipoClienteFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//importante activar a true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //las reglas se escriben sobre los campos del formulario HTML, no tienen nada que ver con los campos de la tabla en la base de datos
        return [
            'txtNombre'=>'required|max:50',
            'txtNombreBreve'=>'required|max:50',
            'txtEntidad'=>'required|max:50'
        ];
    }
}
