<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;

class UpdateDepotItemRequest extends FormRequest
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
            'depot_id' => 'exists:depots,id',
            'item_id'  => 'exists:items,id',
            'amount'   => 'numeric',
        ];
    }
}
