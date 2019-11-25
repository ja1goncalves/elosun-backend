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
            'start_watts'       => 'required_without:end_watts|numeric',
            'end_watts'         => 'required_without:start_watts|numeric',
            'name'              => 'required|min:10|max:100',
            'email'             => 'required|email|max:150',
            'cpf_cnpj'          => 'nullable|max:20|min:11',
            'phone'             => 'nullable|max:15|min:9',
            'cellphone'         => 'required|max:15|min:9',
            'address'           => 'required',
            'address.state'     => 'required_without:zip_code|max:2',
            'address.zip_code'  => 'nullable|min:8|max:12'
        ];
    }
}
