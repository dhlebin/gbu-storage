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
            'name' => 'required|max:255',
            'alias' => 'required|max:255',
            'group_id' => 'required|numeric|exists:item_groups,id',
            'is_available' => 'boolean',
			'unit_id' => 'required|numeric|exists:units,id'
        ];
    }
}
