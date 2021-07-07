<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrderDetailsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Orders');
        $this->hasOne('ProductStocks');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmpty('product_stock_id', __("Your order must have a product"));

        return $validator;
    }
}