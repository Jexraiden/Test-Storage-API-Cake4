<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class Order extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * * Maybe this is not the ideal way to customize fields in CakePHP or maybe
     * * retrieving virtualFields with queries will make the application slower
     * * but for simplicity this doest work until now.
     * TODO: Check the best way to handle these cases.
     */
    protected function _getProductQtd()
    {
        if ($this->has('id')) {
            $orderDetailsTable = TableRegistry::get('OrderDetails');
            $order_details = $orderDetailsTable->find()->where(['order_id' => $this->id])->count();
            return $order_details;
        }
    }

    protected function _getProductName()
    {
        if ($this->has('id')) {
            $orderDetailsTable = TableRegistry::get('OrderDetails');
            $order_details = $orderDetailsTable
                ->find()
                ->where(['order_id' => $this->id])
                ->contain(['ProductStocks.Products'])
                ->first();
            
            return $order_details->product_stock->product->name;
        }
    }

    protected function _getProductType()
    {
        if ($this->has('id')) {
            $orderDetailsTable = TableRegistry::get('OrderDetails');
            $order_details = $orderDetailsTable
                ->find()
                ->where(['order_id' => $this->id])
                ->contain(['ProductStocks.Products.ProductTypes'])
                ->first();

            return $order_details->product_stock->product->product_type->name;
        }
    }

    protected function _getTotalPrice()
    {
        if ($this->has('id')) {
            $orderDetailsTable = TableRegistry::get('OrderDetails');
            $order_details = $orderDetailsTable
                ->find('list', ['valueField' => 'unit_price'])
                ->where(['order_id' => $this->id])
                ->toArray();
            
            return array_sum($order_details);
        }
    }
}