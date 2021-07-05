<h1>Update Product Type</h1>

<?php
    echo $this->Form->create($product_type);
    echo $this->Form->control('id', ['type' => 'hidden']);
    echo $this->Form->control('name');
    echo $this->Form->button(__("Update"));
    echo $this->Form->end();
?>