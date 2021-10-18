<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusInvoiceRequest extends FormRequest
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
            'status'=>'required|string|in:aceptado,cancelado tienda,cancelado usuario,enviado,entregado',
        ];
    }

    public function messages()
    {
        return [
            'status.required'=>'El estatus es requerido',
            'status.string'=>'El tipo de datos del status es invalido',
            'status.id'=>'Estatus invalido'
        ];
    }
}
