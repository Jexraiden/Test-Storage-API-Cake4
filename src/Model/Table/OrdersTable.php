<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;
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
            ->notEmptyDate('shipping_date', __("Please, fill this field"));

        return $validator;
    }

    public function validationOrderProducts(Validator $validator): Validator
    {
        $validator
            ->notEmpty('product_id', __("You must select a product"));
        
        $validator
            ->notEmpty('product_qtd', __("The quantity must be over zero (0)"))
            ->add('product_qtd', 'custom', [
                'rule' => function($value, $context){
                    $product_qtd = $value;
                    $product_id = $context['data']['product_id'];

                    $productStocksTable = TableRegistry::get('ProductStocks');

                    $product_in_stock = $productStocksTable
                        ->find()
                        ->where(['active' => true, 'product_id' => $product_id])
                        ->count();

                    if ($product_qtd <= $product_in_stock) {
                        return true;
                    }

                    return __("Insufficient products in stock (".$product_in_stock." in total)");
                },
                'message' => __("Insufficient products in stock")
            ]);

        return $validator;
    }

    public function prepareOrderForSaving($data)
    {
        $shipping_date = $data['shipping_date'];
        $comments = $data['comments'];
        $product_id = $data['product_id'];
        $product_qtd = $data['product_qtd'];

        $stock_available = $this->OrderDetails->ProductStocks
            ->find()
            ->contain(['Products.ProductTypes'])
            ->where(['ProductStocks.active' => true, 'product_id' => $product_id])
            ->order(['ProductStocks.created' => 'ASC'])
            ->limit($product_qtd)
            ->all();

        $order = $this->newEntity([
            'shipping_date' => $shipping_date,
            'comments' => $comments,
            'order_details' => []
        ]);
        $order->setDirty('order_details', true);

        $order_detail_data = [];

        foreach ($stock_available as $data) {
            $product_stock = $this->OrderDetails->ProductStocks->get($data->id);
            $product_stock->active = false;

            $order_detail = $this->OrderDetails->newEntity([
                'product_stock_id' => $product_stock->id,
                'unit_price' => $data->product->price,
                'product_stock' => []
            ]);
            $order_detail->product_stock = $product_stock;
            $order_detail->setDirty('product_stock', true);

            $order_detail_data[] = $order_detail;
        }

        $order->order_details = $order_detail_data;

        return $order;
    }
}