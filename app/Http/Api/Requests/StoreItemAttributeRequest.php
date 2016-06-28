<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;

class StoreItemAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required|max:255',
            'alias' => 'required|max:255',
            'type'  => 'required',
			'unit_id' => 'exists:units,id'
		];
    }

}
