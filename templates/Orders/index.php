<h1><?= __("Orders") ?></h1>
<?= $this->Html->link(__("Make a new Order"), ['action' => 'add']); ?>
<table>
    <tr>
        <th><?= __("Shipping Date") ?></th>
        <th><?= __("Product") ?></th>
        <th><?= __("Type") ?></th>
        <th><?= __("Qtd") ?></th>
        <th><?= __("Total Price") ?></th>
        <th><?= __("Created") ?></th>
        <th colspan="2"><?= __("Actions") ?></th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td>
            <?= $this->Time->format($order->shipping_date, 'MM/dd/YYYY'); ?>
        </td>
        <td><?= $order->product_name ?></td>
        <td><?= $order->product_type ?></td>
        <td><?= $order->product_qtd ?></td>
        <td><?= $this->Number->currency($order->total_price); ?></td>
        <td>
            <?= $order->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->Link(__("Details"), ['action' => 'view', $order->id]); ?>
        </td>
        <td>
            <?= $this->Html->Link(__("Edit"), ['action' => 'edit', $order->id]); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>