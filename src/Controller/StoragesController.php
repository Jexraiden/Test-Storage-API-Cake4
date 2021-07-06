<?php

namespace App\Controller;

class StoragesController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        
        $query = $this->Storages
            ->find()
            ->contain(['Products.ProductTypes']);

        $storages = $this->Paginator->paginate($query);

        $this->set(compact('storages'));
    }

    public function add()
    {
        $storage = $this->Storages->newEmptyEntity();

        if ($this->request->is('post')) {
            $storage = $this->Storages->patchEntity($storage, $this->request->getData());

            if ($this->Storages->save($storage)) {
                $this->Flash->success(__("A new product has been added to storage."));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__("Unable to add the product to storage."));
        }

        $products = $this->Storages->Products->find('list')->all();

        $this->set('products', $products);
        $this->set('storage', $storage);
    }

    public function deactivate($id)
    {
        $storage = $this->Storages
            ->findById($id)
            ->contain(["Products"])
            ->firstOrFail();
        
        if ($this->request->is(['post', 'put'])) {

            if ($storage->active == true) {
                $this->Storages->newEmptyEntity($storage);

                $storage->active = 0;

                if ($this->Storages->save($storage)) {
                    $this->Flash->success(
                        __("{0} ({1}) has been deactivated.",
                        $storage->product->name,
                        $storage->serialnumber
                    ));
                    return $this->redirect($this->referer());
                }
            }

            if ($storage->active == false) {
                $this->Flash->error(
                    __("{0} ({1}) has already been deactivated.",
                    $storage->product->name,
                    $storage->serialnumber
                ));
                return $this->redirect($this->referer());
            }
        }
    }
}