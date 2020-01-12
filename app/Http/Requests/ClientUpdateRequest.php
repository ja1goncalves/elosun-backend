<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "client" => "required",
            "client.id" => "required|numeric|exists:clients,id",
            "client.name" => "string|min:7",
            "client.email" => "email|unique",
            "client.password" => "required|string|min:8",
            "client.cpf_cpnj" => "required|string|min:11|unique:clients",
            "client.phone" => "nullable|string|min:15",
            "client.cellphone" => "required|string|min:15",
            "client.user_id" => "nullable|numeric",
            "client.address" => "required",
            "client.address.id" => "required|numeric|exists:addresses,id",
            "client.address.state" => "required|string|min:2|max:2",
            "client.address.zip_code" => "required|string|min:8",
            "client.address.city" => "required|string|max:50",
            "client.address.street" => "required|string|max:100",
            "client.address.number" => "numeric",
            "client.address.addressable_id" => "required_without:client.id|numeric",
            "client.address.addressable_type" => "nullable|numeric",
            "client.electric_account" => "required",
            "client.electric_account.number" => "required|string",
            "client.electric_account.consumption_type_id" => "required|numeric|exists:production_types,id",
            "client.electric_account.distributor_initials" => "required|string",
            "client.electric_account.phase" => "required|string|min:2|max:4",
            "client.electric_account.address" => "required",
            "client.electric_account.address.state" => "required|string|min:2|max:2",
            "client.electric_account.address.zip_code" => "required|string|min:8",
            "client.electric_account.address.city" => "required|string|max:50",
            "client.electric_account.address.street" => "required|string|max:100",
            "client.electric_account.address.number" => "numeric",
            "client.bank" => "nullable",
            "client.bank.agency" => "required|string|min:4",
            "client.bank.account" => "required|string|min:4",
            "client.bank.account_dv" => "nullable|string|max:2",
            "client.bank.agency_dv" => "nullable|string|max:2",
            "client.bank.type" => "string|min:2",
            "client.bank.bank_id" => "required|numeric|exists:banks,id",
            "client.bank.segment_id" => "required|numeric|exists:segments,id",
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
