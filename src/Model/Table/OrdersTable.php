<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrdersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        
        $this->hasMany('OrderDetails');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyDate('ship_date', __("Please, fill this field"));

        return $validator;
    }
}