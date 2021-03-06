<?php

namespace App\Http\Api\Requests;

use Dingo\Api\Http\FormRequest;

class StoreDepotItemRequest extends FormRequest
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
            'depot_id' => 'required|exists:depots,id',
            'item_id'  => 'required|exists:items,id',
            'amount'   => 'required|numeric',
        ];
    }
}
