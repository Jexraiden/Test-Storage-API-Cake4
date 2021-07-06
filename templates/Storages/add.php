<h1><?= __("Add a Product to Storage") ?></h1>

<?php
    echo $this->Form->create($storage);
    echo $this->Form->control('serialnumber', ['label' => __("Serial Number")]);
    echo $this->Form->control('product_id', ['label' => __("Product"), 'options' => $products, 'empty' => 'Select the product']);
    echo $this->Form->button(__("Add"));
    echo $this->Form->end();
?>