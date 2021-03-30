<?php

namespace App\Http\Requests\Password;

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
            'password'=>'required|min:6|string|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=>'required'
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
            'password.required' => 'La contraseña es requerida',
            'password.min'=>'Debe tener al menos 6 caracteres',
            'password.string'=>'Debe ser un campo string',
            'password_confirmation.required'=>'la confirmacion es requerida',
            'password.same'=>'Las contraseñas son diferentes'
        ];
    }
}
