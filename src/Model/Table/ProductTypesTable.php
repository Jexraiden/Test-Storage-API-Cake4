<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductTypesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('name', __("Please, fill this field"))
            ->minLength('name', 2, __("The name must have at least two letters"));
        
        return $validator;
    }
}