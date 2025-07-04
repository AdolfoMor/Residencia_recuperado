<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Estado' => 'required',
            'Ciudad' => 'required',
            'Calle' => 'required',
            'Colonia' => 'required',
            'Numero' => 'required',
            'Telefono' => 'required',
            'afiliado_id' => 'required',
        ];
    }
}
