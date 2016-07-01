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
            'item_id' => 'exists:items,id',
            'depot_item_id' => 'exists:depot_items,id',
            'depot_id' => 'exists:depots,id',
            'status' => 'in:in_progress,completed,rejected',
            'type' => 'in:change,move,correct',
            'opposite_operation_id' => 'integer'
        ];
    }
}
