<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ProductStock extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}