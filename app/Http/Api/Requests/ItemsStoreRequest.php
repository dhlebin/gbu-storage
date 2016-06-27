<?php

namespace App\Http\Api\Requests;

class ItemsStoreRequest extends Request
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
            'group_id' => 'required|numeric',
            'is_available' => 'boolean',
			'unit_id' => 'required|numeric'
        ];
    }
}
