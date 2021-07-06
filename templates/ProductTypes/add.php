<h1><?= __("New Product Type") ?></h1>

<?php
    echo $this->Form->create($product_type);
    echo $this->Form->control('name', ['label' => __("Name")]);
    echo $this->Form->button(__("Add"));
    echo $this->Form->end();
?>