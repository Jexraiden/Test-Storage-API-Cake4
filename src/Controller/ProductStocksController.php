<?php

namespace App\Controller;

class ProductStocksController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        
        $query = $this->ProductStocks
            ->find()
            ->contain(['Products.ProductTypes']);

        $product_stocks = $this->Paginator->paginate($query);

        $this->set(compact('product_stocks'));
    }

    public function add()
    {
        $product_stock = $this->ProductStocks->newEmptyEntity();

        if ($this->request->is('post')) {
            $product_stock = $this->ProductStocks->patchEntity($product_stock, $this->request->getData());

            if ($this->ProductStocks->save($product_stock)) {
                $this->Flash->success(__("A new product has been added to stock."));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__("Unable to add the product to stock."));
        }

        $products = $this->ProductStocks->Products->find('list')->all();

        $this->set('products', $products);
        $this->set('product_stock', $product_stock);
    }

    public function deactivate($id)
    {
        $product_stock = $this->ProductStocks
            ->findById($id)
            ->contain(["Products"])
            ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {

            if ($product_stock->active == true) {
                $this->ProductStocks->newEmptyEntity($product_stock);

                $product_stock->active = 0;

                if ($this->ProductStocks->save($product_stock)) {
                    $this->Flash->success(
                        __("{0} ({1}) has been deactivated.",
                        $product_stock->product->name,
                        $product_stock->serialnumber
                    ));
                    return $this->redirect($this->referer());
                }
            }

            if ($product_stock->active == false) {
                $this->Flash->error(
                    __("{0} ({1}) has already been deactivated.",
                    $product_stock->product->name,
                    $product_stock->serialnumber
                ));
                return $this->redirect($this->referer());
            }
        }
    }
}