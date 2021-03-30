<?php

namespace App\Http\Requests\Stores;

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
            'business_name'=>'required|string',
            'bussiness_id'=>'nullable|string',
            'country'=>'required|string',
            'city'=>'required|string',
            'address'=>'required|string',
            'lat'=>'required|string',
            'lng'=>'required|string',
        ];
    }

    public function messages()
    {
        return [
            'business_name.required'=>'El nombre es requerido',
            'country.required'=>'El pais es requerido',
            'address.required'=>'La direccion es requerido',
            'lat.required'=>'La latitud es requerido',
            'lng.required'=>'La longitud es requerido',

            'business_name.string'=>'El tipo de datos es incorrecto',
            'business_id.string'=>'El tipo de datos es incorrecto',
            'country.string'=>'El tipo de datos es incorrecto',
            'address.string'=>'El tipo de datos es incorrecto',
            'lat.string'=>'El tipo de datos es incorrecto',
            'lng.string'=>'El tipo de datos es incorrecto',
            'city.string'=>'El tipo de datos es incorrecto',
            'city.required'=>'La ciudad es requerida',
        ];
    }
}
