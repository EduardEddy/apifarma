<?php

namespace App\Http\Requests\Users\Manager;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'=>'required|string',
            'last_name'=>'required|string',

            'phone'=>'numeric|min:10|nullable',
            'identification'=>'numeric|nullable',
            'country'=>'string|nullable',
            'type_identification'=>'string|nullable'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'last_name.required' => 'El apellido es requerido',

            'phone.numeric'=>'El telefono debe ser numerico',
            'phone.min'=>'el telefono debe tener al menos 10 caracteres',

            'identification.numeric'=>'la identificacion debe ser un valor numerico',
            'country.string'=>'El pais debe ser un string',
            'type_identification.string'=>'La identificacion debe ser un string'
        ];
    }
}
