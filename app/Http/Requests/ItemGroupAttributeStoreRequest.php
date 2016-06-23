<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class ItemGroupAttributeStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'alias' => 'required|max:255',
            'group_id' => 'required|numeric',
            'unit_id' => 'required|numeric'
        ];
    }

}
