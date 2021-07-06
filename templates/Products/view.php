<h1><?= $product->name; ?></h1>
<p><?= $this->Format->emptyDescription(h($product->description)); ?></p>
<h2><?= __("Information") ?></h2>
<table>
    <tr>
        <th><?= __("Type") ?></th>
        <td><?= $product->product_type->name; ?></td>
    </tr>
    <tr>
        <th><?= __("Price") ?></th>
        <td><?= $this->Number->currency($product->price); ?></td>
    </tr>
    <tr>
        <th><?= __("Active?") ?></th>
        <td><?= $this->Format->active($product->active); ?></td>
    </tr>
    <tr>
        <th><?= __("Created") ?></th>
        <td><?= $product->created->format(DATE_RFC850); ?></td>
    </tr>
</table>
<p>
    <?= $this->Html->link(__("Edit"), ['action' => 'edit', $product->id]); ?>
</p>
<p>
    <?= $this->Form->postLink(
        __("Change Status"),
        ['action' => 'activateDeactivate', $product->id],
        ['confirm' => __("Are you sure?")]);
    ?>
</p>
