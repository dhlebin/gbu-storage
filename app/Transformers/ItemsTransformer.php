<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class ItemsTransformer extends TransformerAbstract
{
    public function transform(Model $item) {
        return $item->toArray();
    }
}