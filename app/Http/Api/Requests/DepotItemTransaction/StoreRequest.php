<?

namespace App\Http\Api\Requests\DepotItemTransaction;

use Dingo\Api\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @todo depot_item_operation exists
     * @todo add user_id 
     *
     * @return array
     */
    public function rules()
    {
        return [
            'depot_item_operation_id' => 'required|numeric',
            'operation' => 'in:basic,correction,loss',
            'status' => 'in:hold,accepted,declined',
            'delta' => 'required|numeric',
            'date' => 'required|date',
        ];
    }
}
