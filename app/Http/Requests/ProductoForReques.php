<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoForReques extends FormRequest
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
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'clave' => 'required|max:255',
            'codigo' => 'required|max:255',
            'compra' => 'required|max:255',
            'venta' => 'required|max:255',
        ];
    }
}
