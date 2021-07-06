<h1><?= __("Products") ?></h1>
<?= $this->Html->link(__("Add New"), ['action' => 'add']); ?>
<table>
    <tr>
        <th><?= __("Name") ?></th>
        <th><?= __("Type") ?></th>
        <th><?= __("Price") ?></th>
        <th><?= __("Created") ?></th>
        <th><?= __("Active?") ?></th>
        <th><?= __("Actions") ?></th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td>
            <?= $this->Html->link($product->name, ['action' => 'view', $product->id]); ?>
        </td>
        <td>
            <?= $product->product_type->name; ?>
        </td>
        <td>
            <?= $this->Number->currency($product->price); ?>
        </td>
        <td>
            <?= $product->created->format(DATE_RFC850); ?>
        </td>
        <td>
            <?= $this->Format->active($product->active); ?>
        </td>
        <td>
            <?= $this->Html->link(__("Edit"), ['action' => 'edit', $product->id]); ?>
            <?= $this->Form->postLink(
                _("Change Status"),
                ['action' => 'activateDeactivate', $product->id],
                ['confirm' => __("Are you sure?")]);
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
