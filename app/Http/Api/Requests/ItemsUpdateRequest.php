<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;

class ItemsUpdateRequest extends FormRequest
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
