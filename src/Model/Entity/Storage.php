<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class StorageType extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}