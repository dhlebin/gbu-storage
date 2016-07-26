<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;


class UnitsUpdateRequest extends FormRequest
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
            'name' => 'max:255',
            'designation' => 'max:50',
            'decimal_symbol_count' => 'numeric',
            'min_value' => 'numeric'
        ];
    }
}
