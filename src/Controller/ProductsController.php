<?php

namespace App\Controller;

class ProductsController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        
        $query = $this->Products
            ->find()
            ->contain(['ProductTypes']);

        $products = $this->Paginator->paginate($query);

        $this->set(compact('products'));
    }

    public function view($id)
    {
        $product = $this->Products
            ->findById($id)
            ->contain('ProductTypes')
            ->firstOrFail();

        $this->set(compact('product'));
    }

    public function add()
    {
        $product = $this->Products->newEmptyEntity();

        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());

            if ($this->Products->save($product)) {
                $this->Flash->success(__("A new product has been added."));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__("Unable to add the product."));
        }

        $product_types = $this->Products->ProductTypes->find('list')->all();

        $this->set('product_types', $product_types);
        $this->set('product', $product);
    }

    public function edit($id)
    {
        $product = $this->Products
            ->findById($id)
            ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {
            $this->Products->patchEntity($product, $this->request->getData());
            
            if ($this->Products->save($product)) {
                $this->Flash->success(__("The product has been updated."));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to update the product.'));
        }

        $product_types = $this->Products->ProductTypes->find('list')->all();

        $this->set('product_types', $product_types);
        $this->set('product', $product);
    }

    public function activateDeactivate($id)
    {
        $product = $this->Products
            ->findById($id)
            ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {

            if ($product->active == true) {
                $product->active = false;
            } else {
                $product->active = true;
            }
            
            $this->Products->newEmptyEntity($product);

            if ($this->Products->save($product)) {
                $this->Flash->success(
                    __("{0} has been {1}.",
                    $product->name,
                    ($product->active == true ? "activated" : "deactivated")
                ));
                return $this->redirect($this->referer());
            }
        }
    }
}