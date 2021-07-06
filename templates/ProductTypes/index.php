<h1><?= __("Product Types") ?></h1>
<?= $this->Html->link(__("Add New"), ['action' => 'add']); ?>
<table>
    <tr>
        <th><?= __("Name") ?></th>
        <th><?= __("Created") ?></th>
        <th><?= __("Active?") ?></th>
        <th><?= __("Actions") ?></th>
    </tr>
    <?php foreach ($product_types as $product_type): ?>
    <tr>
        <td>
            <?= $product_type->name; ?>
        </td>
        <td>
            <?= $product_type->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Format->active($product_type->active); ?>
        </td>
        <td>
            <?= $this->Html->link(__("Edit"), ['action' => 'edit', $product_type->id]); ?>
            <?= $this->Form->postLink(
                __("Change Status"),
                ['action' => 'activateDeactivate', $product_type->id],
                ['confirm' => __("Are you sure?")]);
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
