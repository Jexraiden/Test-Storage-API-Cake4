<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductStocksTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Products');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->minLength('serialnumber', 1, __("The serial number must have at least one character"))
            
            ->notEmpty('product_id', __("You must select a product"))

            ->add('serialnumber', 'custom', [
                'rule' => function ($value, $context) {
                    $serialnumber = $value;
                    $product_id = $context['data']['product_id'];
                    $product_stocks_table = $context['providers']['table'];

                    $same_product = $product_stocks_table
                    ->find()
                    ->where([
                        'ProductStocks.serialnumber' => $serialnumber,
                        'ProductStocks.product_id' => $product_id,
                        'ProductStocks.active' => 1])
                    ->first();

                    if (empty($same_product)) {
                        return true;
                    }

                    return false;
                },
                'message' => __("This product has already been added to stock, please choose a different serial number")
            ]);

        return $validator;
    }
}