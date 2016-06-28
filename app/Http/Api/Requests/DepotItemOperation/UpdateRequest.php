<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 28.06.2016
 * Time: 14:11
 */

namespace App\Http\Api\Requests\DepotItemOperation;

use Dingo\Api\Http\FormRequest;

class UpdateRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'item_id' => 'required|exists:items,id',
            'depot_item_id' => 'required|exists:depot_items,id',
            'depot_id' => 'required|exists:depots,id',
            'status' => 'required|in:in_progress,completed,rejected',
            'type' => 'required|in:change,move,correct',
            'delta' => 'required|numeric',
            'opposite_operation_id' => 'required|integer'
        ];
    }
}
