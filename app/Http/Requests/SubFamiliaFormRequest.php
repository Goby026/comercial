<?php

namespace appComercial\Http\Requests;

use appComercial\Http\Requests\Request;

class SubFamiliaFormRequest extends Request
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
            'txt_codiFamilia'=>'required|max:50',
            'txt_nombreSubFamilia'=>'required|max:50',
            'txt_nombreBreveSubFamilia'=>'required|max:50'
        ];
    }
}
