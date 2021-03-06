<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;

class StoreItemGroupRequest extends FormRequest
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
            'name'            => 'required|max:255',
            'alias'           => 'required|unique:item_groups|max:255',
            'is_available'    => 'required|boolean',
            'parent_id'       => 'numeric|exists:item_groups,id',
            'item_attributes' => 'array|exists:item_attributes,id'
        ];
    }
}
