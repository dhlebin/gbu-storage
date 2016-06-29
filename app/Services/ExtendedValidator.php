<?php namespace App\Services;

use App\Contracts\Repositories\ItemAttributesRepository;

class ExtendedValidator extends \Illuminate\Validation\Validator
{
    public function validateAttributeValue($attribute, $value, $parameters)
    {
        $explodedAttribute = explode(".", $attribute);
        if (!isset($explodedAttribute[1])) {
            return false;
        }

        $currentKey = $explodedAttribute[1];
        $itemAttributesRepository = $this->container->make(ItemAttributesRepository::class);
        $itemAttributeId = $this->data['attributes'][$currentKey]['id'];
        $itemAttribute = $itemAttributesRepository->getById($itemAttributeId);
        if (!$itemAttribute) {
            return false;
        }

        if($itemAttribute->type === 'float') {
            $parameters = [8,2];
        }

        return call_user_func_array(
            [$this, 'validate' . ucfirst($itemAttribute->type)],
            [$attribute, $value, $parameters]
        );
    }

    public function validateFloat($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'float');
        list($precision, $scale) = $parameters;
        return preg_match('#^(?=.)(?:[1-9]\d*|0)?(?:\.\d{1,'.$scale.'})?$#', $value);
    }

    public function validateDatetime($attribute, $value)
    {
        return $this->validateDate($attribute, $value);
    }
}