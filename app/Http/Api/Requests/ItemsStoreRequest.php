<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;

class ItemsStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'               => 'required|max:255',
            'alias'              => 'required|max:255|unique:items',
            'group_id'           => 'required|numeric|exists:item_groups,id',
            'is_available'       => 'boolean',
            'attributes.*.id'    => 'required|numeric|exists:item_attributes,id',
            'attributes.*.value' => 'required|attributeValue',
            'unit_id' => 'numeric|exists:units,id'
        ];
    }
}
