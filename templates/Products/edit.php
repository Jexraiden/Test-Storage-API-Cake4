<h1><?= __("Update Product") ?></h1>

<?php
    echo $this->Form->create($product);
    echo $this->Form->control('name', ['label' => __("Name")]);
    echo $this->Form->control('description', ['label' => __("Description"), 'rows' => '3']);
    echo $this->Form->control('price', ['label' => __("Price")]);
    echo $this->Form->control('product_type_id', ['label' => __("Type"), 'options' => $product_types, 'empty' => 'Select the product type']);
    echo $this->Form->button(__("Update"));
    echo $this->Form->end();
?>