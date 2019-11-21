<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'start_watts' => 'required',
            'end_watts' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'start_watts.required' => 'É necessário um início de intervalo em Watts.',
            'end_watts.required' => 'É necessário um fim de intervalo em Watts.'
        ];
    }
}
