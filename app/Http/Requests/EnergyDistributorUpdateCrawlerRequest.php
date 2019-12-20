<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnergyDistributorUpdateCrawlerRequest extends FormRequest
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
            'distributors'              => 'required',
            'distributors.*.company'    => 'required|string',
            'distributors.*.amount'     => 'required|numeric',
            'distributors.*.ucs'        => 'required|numeric',
            'distributors.*.potency'    => 'required',
            'distributors.*.link_ucs'   => 'sometimes|string'
        ];
    }
}
