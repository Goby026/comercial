<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class CondicionesComercialesFormRequest extends Request
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
            'txt_descripCondiComer'=>'required|max:200',
            'txt_defecCondiComer'=>'required|max:100'
        ];
    }
}
