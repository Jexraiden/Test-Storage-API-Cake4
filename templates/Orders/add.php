<?php
/**
 * * The commented code was my attempt at Ajax that I will revisit later.
 * TODO: correct AJAX-Js.
 */
?>

<h1><?= __("New Order") ?></h1>

<?= $this->Form->create($order); ?>

<?= $this->Form->control('shipping_date', ['label' => __("Shipping Date")]); ?>

<?=
    $this->Form->control('product_id', [
        //'id' => 'product',
        'label' => __("Product"),
        'type' => 'select',
        'options' => $products,
        'empty' => __("(choose one)")
    ]);
?>

<!--
<div id="product-info">
</div>
-->

<?=
    $this->Form->control('product_qtd', [
        //'id' => 'order-qtd',
        'label' => __("Quantity"),
        'type' => 'number'
    ]);
?>

<?= $this->Form->control('comments', ['label' => __("Comments"), 'rows' => '3']); ?>

<?= $this->Form->submit(__("Finish"), ['id' => 'finishbutton']); ?>

<?= $this->Form->end(); ?>

<!--
<script>
    $(function(){
        $('#product').on('change', function(){
            alert('product id: ' + this.value);
            $.ajax({
                method: "POST",
                url:"<?= $this->Url->build(['controller' => 'Orders', 'action' => 'productInfoAjax']); ?>",
                data: {
                    product_id: this.value
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(response){
                    if (response.result) {
                        alert('success');
                        var result = response.result;
                        $('#product-info').html(result.productInfo);
                    }
                },
                error: function(e){
                    alert("An error has occurred: " + e.responseText.message);
                    console.log(e)
                }
            });
        });
    });
</script>
-->