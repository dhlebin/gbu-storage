<?php

namespace App\Api\Requests;

class ItemsUpdateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'max:255',
            'alias' => 'max:255',
            'group_id' => 'numeric',
            'is_available' => 'boolean'
        ];
    }
}
