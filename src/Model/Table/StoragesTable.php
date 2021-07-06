<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class StoragesTable extends Table
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
                    $storages_table = $context['providers']['table'];

                    $same_product = $storages_table
                    ->find()
                    ->where([
                        'Storages.serialnumber' => $serialnumber,
                        'Storages.product_id' => $product_id,
                        'Storages.active' => 1])
                    ->first();

                    if (empty($same_product)) {
                        return true;
                    }

                    return false;
                },
                'message' => __("This product has already been added to storage, please choose a different serial number")
            ]);

        return $validator;
    }
}