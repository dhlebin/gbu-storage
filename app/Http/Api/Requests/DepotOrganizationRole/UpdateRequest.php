<?php

namespace App\Http\Api\Requests\DepotOrganizationRole;

use Dingo\Api\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'depot_id'        => 'numeric|exists:depots,id',
            'organization_id' => 'numeric',
            'user_role_id'    => 'numeric',
            'role'            => 'max:255'
        ];
    }
}
