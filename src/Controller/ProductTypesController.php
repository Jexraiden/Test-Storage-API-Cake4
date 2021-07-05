<?php

namespace App\Controller;

class ProductTypesController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $product_types = $this->Paginator->paginate($this->ProductTypes->find());
        $this->set(compact('product_types'));
    }

    public function add()
    {
        $product_type = $this->ProductTypes->newEmptyEntity();

        if ($this->request->is('post')) {
            $product_type = $this->ProductTypes->patchEntity($product_type, $this->request->getData());

            if ($this->ProductTypes->save($product_type)) {
                $this->Flash->success(__("A new product type has been added."));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__("Unable to add the product type."));
        }

        $this->set('product_type', $product_type);
    }

    public function edit($id)
    {
        $product_type = $this->ProductTypes
            ->findById($id)
            ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {
            $this->ProductTypes->patchEntity($product_type, $this->request->getData());
            
            if ($this->ProductTypes->save($product_type)) {
                $this->Flash->success(__("The product type has been updated."));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Unable to update the product type.'));
        }

        $this->set('product_type', $product_type);
    }

    public function activateDeactivate($id)
    {
        $product_type = $this->ProductTypes
            ->findById($id)
            ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {

            if ($product_type->active == true) {
                $product_type->active = false;
            } else {
                $product_type->active = true;
            }
            
            $this->ProductTypes->newEmptyEntity($product_type);

            if ($this->ProductTypes->save($product_type)) {
                $this->Flash->success(
                    __("{0} has been {1}.",
                    $product_type->name,
                    ($product_type->active == true ? "activated" : "deactivated")
                ));
                return $this->redirect(['action' => 'index']);
            }
        }
    }
}