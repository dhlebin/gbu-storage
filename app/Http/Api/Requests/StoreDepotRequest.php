<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;

class StoreDepotRequest extends FormRequest
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
            'name'                  => 'required|max:255',
            'owner_organization_id' => 'required|integer'
        ];
    }
}
