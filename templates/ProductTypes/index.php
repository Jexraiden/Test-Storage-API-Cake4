<h1>Product Types</h1>
<?= $this->Html->link("Add New", ['action' => 'add']); ?>
<table>
    <tr>
        <th>Name</th>
        <th>Created</th>
        <th>Active?</th>
        <th>Actions</th>
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
            <?= $this->Html->link("Edit", ['action' => 'edit', $product_type->id]); ?>
            <?= $this->Form->postLink(
                "Change Status",
                ['action' => 'activateDeactivate', $product_type->id],
                ['confirm' => __("Are you sure?")]);
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
