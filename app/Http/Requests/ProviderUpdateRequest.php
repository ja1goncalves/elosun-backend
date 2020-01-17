<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderUpdateRequest extends FormRequest
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
            "provider" => "required",
            "provider.id" => "required|numeric|exists:providers,id",
            "provider.name" => "string|min:7",
            "provider.email" => "email",
            "provider.password" => "required|string|min:8",
            "provider.cpf_cnpj" => "required|string|min:11|unique:providers,cpf_cnpj",
            "provider.phone" => "nullable|string|min:11|max:15",
            "provider.cellphone" => "required|string|min:11|max:15",
            "provider.user_id" => "nullable|numeric",
            "provider.address" => "required",
            "provider.address.id" => "required|numeric|exists:addresses,id",
            "provider.address.state" => "required|string|min:2|max:2",
            "provider.address.zip_code" => "required|string|min:8",
            "provider.address.city" => "required|string|max:50",
            "provider.address.street" => "required|string|max:100",
            "provider.address.number" => "numeric",
            "provider.address.addressable_id" => "required_without:provider.id|numeric",
            "provider.address.addressable_type" => "nullable|string",
            "provider.station" => "required",
            "provider.station.code_gd" => "required|string|min:14|exists:electric_stations,code_gd",
            "provider.station.address" => "nullable",
            "provider.station.address.state" => "string|min:2|max:2",
            "provider.station.address.zip_code" => "string|min:8",
            "provider.station.address.city" => "string|max:50",
            "provider.station.address.street" => "string|max:100",
            "provider.station.address.number" => "numeric",
            "provider.bank" => "required",
            "provider.bank.agency" => "required|string|min:4",
            "provider.bank.account" => "required|string|min:4",
            "provider.bank.account_dv" => "nullable|string|max:2",
            "provider.bank.agency_dv" => "nullable|string|max:2",
            "provider.bank.type" => "string|min:2",
            "provider.bank.bank_id" => "required|numeric|exists:banks,id",
            "provider.bank.segment_id" => "numeric|exists:segments,id",
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'unique'   => ':attribute já cadastrado!',
        ];
    }
}
