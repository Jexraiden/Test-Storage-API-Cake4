<?php

namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;

class ProductsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('ProductTypes');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('name', __("Please, fill this field"))
            ->minLength('name', 2, __("The name must have at least two letters"))

            ->notEmpty('product_type_id', __("You must select a product type"));

        return $validator;
    }
}