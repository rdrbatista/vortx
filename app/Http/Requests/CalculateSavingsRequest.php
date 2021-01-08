<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateSavingsRequest extends FormRequest
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
            'areaCodeSource' => 'required|different:areaCodeDestiny',
            'areaCodeDestiny' => 'required',
            'minutes' => 'required',
            'product' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'areaCodeSource.required' => 'O campo do DDD de origem é obrigatório',
            'areaCodeDestiny.required' => 'O campo do DDD de destino é obrigatório',
            'minutes.required' => 'O tempo da ligação (em minutos) é obrigatório',
            'product.required' => 'Escolha o produto',
            'areaCodeSource.different' => 'Os DDDs de origem e destino não podem ser iguais'
        ];
    }
}
