<h1><?= __("Products in Stock") ?></h1>
<?= $this->Html->link(__("Add a New Product"), ['action' => 'add']); ?>
<table>
    <tr>
        <th><?= __("Serial Number") ?></th>
        <th><?= __("Product") ?></th>
        <th><?= __("Type") ?></th>
        <th><?= __("Price") ?></th>
        <th><?= __("Created") ?></th>
        <th><?= __("Active?") ?></th>
        <th><?= __("Actions") ?></th>
    </tr>
    <?php foreach ($product_stocks as $product_stock): ?>
    <tr>
        <td>
            <?= $product_stock->serialnumber; ?>
        </td>
        <td>
            <?= $this->Html->Link(
                $product_stock->product->name,
                ['controller' => 'Products', 'action' => 'view', $product_stock->product->id]);
            ?>
        </td>
        <td>
            <?= $product_stock->product->product_type->name; ?>
        </td>
        <td>
            <?= $this->Number->currency($product_stock->product->price); ?>
        </td>
        <td>
            <?= $product_stock->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Format->active($product_stock->active); ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                __("Deactivate"),
                ['action' => 'deactivate', $product_stock->id],
                ['confirm' => __("Are you sure?")]);
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>