<?php

namespace App\Http\Requests\Products;

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
            'name'=>'string|required',
            'description'=>'string|nullable',
            'components'=>'string|required',
            'cant'=>'string|required',
            'price'=>'numeric|required',
            'store_id'=>'exists:stores,id',
            'file'=>'nullable|mimes:jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'El formato para nombre es invalido',
            'name.required'=>'El nombre es requerido',
            'description.string'=>'El formato de la descripcion es invalido',
            'components.string'=>'El formato de los componentes es invalido',
            'components.required'=>'Los componentes son requeridos',
            'cant.string'=>'El formato cantidad es invalido',
            'cant.required'=>'La cantidad es invalida',
            'price.numeric'=>'El precio es invalido',
            'price.required'=>'El precio es requerido',
            'store_id.exists'=>'La tienda es invalida',
            'image.mimes'=>'El formato de imagen es invalido debe ser jpeg, jpg o png'
        ];
    }
}
