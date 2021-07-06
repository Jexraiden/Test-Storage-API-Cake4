<h1><?= __("Storage") ?></h1>
<?= $this->Html->link(__("Add New Product"), ['action' => 'add']); ?>
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
    <?php foreach ($storages as $storage): ?>
    <tr>
        <td>
            <?= $storage->serialnumber; ?>
        </td>
        <td>
            <?= $this->Html->Link(
                $storage->product->name,
                ['controller' => 'Products', 'action' => 'view', $storage->product->id]);
            ?>
        </td>
        <td>
            <?= $storage->product->product_type->name; ?>
        </td>
        <td>
            <?= $this->Number->currency($storage->product->price); ?>
        </td>
        <td>
            <?= $storage->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Format->active($storage->active); ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                __("Deactivate"),
                ['action' => 'deactivate', $storage->id],
                ['confirm' => __("Are you sure?")]);
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>