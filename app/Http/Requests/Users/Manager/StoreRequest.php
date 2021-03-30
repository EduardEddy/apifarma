<?php

namespace App\Http\Requests\Users\Manager;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email'=>'required|string|unique:users,email|email',
            'password'=>'required|string',
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
            'email.required' => 'El email es requerido',
            'password.required' => 'la contraseña es requerido',
            'email.unique'=>'El email ya esta registrado',
            'email.email'=>'El email debe ser un email valido'
        ];
    }
}
