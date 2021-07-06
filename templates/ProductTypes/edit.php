<h1><?= __("Update Product Type") ?></h1>

<?php
    echo $this->Form->create($product_type);
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('name', ['label' => __("Name")]);
    echo $this->Form->button(__("Update"));
    echo $this->Form->end();
?>