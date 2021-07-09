<?php

namespace App\Controller;

class OrdersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        $this->loadComponent('Paginator');

        $query = $this->Orders
            ->find()
            ->contain('OrderDetails.ProductStocks.Products.ProductTypes');

        $orders = $this->Paginator->paginate($query);

        $this->set(compact('orders'));
    }

    public function view($id)
    {
        $order = $this->Orders
            ->findById($id)
            ->contain('OrderDetails.ProductStocks.Products.ProductTypes')
            ->firstOrFail();

        $this->set(compact('order'));
    }

    public function add()
    {
        $order = $this->Orders->newEmptyEntity();

        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData(), ['validate' => 'orderProducts']);

            if (!$order->getErrors()) {
                $order = $this->Orders->prepareOrderForSaving($this->request->getData());

                if ($this->Orders->save($order, ['associated' => ['OrderDetails.ProductStocks']])) {
                    $this->Flash->success(__("The order has been saved."));
                    return $this->redirect(['action' => 'index']);
                }
            }

            $this->Flash->error(__("Unable to finish the order."));
        }
        
        $products = $this->Orders->OrderDetails->ProductStocks->Products->find('list')->all();

        $this->set('order', $order);
        $this->set('products', $products);
    }

    /**
     * * The commented code was my attempt at Ajax that I will revisit later.
     * TODO: correct AJAX-Js.
     */
    /*
    public function productInfoAjax()
    {
        $this->request->allowMethod('ajax');

        $product_id = $this->request->getData('product_id');

        if (!$product_id) {
            throw new NotFoundException();
        }

        $this->loadModel('ProductStocks');

        $qtd_in_stock = $this->ProductStocks
            ->find()
            ->where(['active' => true, 'product_id' => $product_id])
            ->count();

        $product = $this->ProductStocks->Products
            ->find()
            ->where(['active' => true, 'id' => $product_id])
            ->first();

        $productInfo = ['in_stock' => $qtd_in_stock, 'unit_price' => $product->price];
        
        $this->set(compact('productInfo'));
        //$this->set('_serialize', ['productInfo']);
        
        //$this->RequestHandler->renderAs($this, 'ajax');
    }
    */
}