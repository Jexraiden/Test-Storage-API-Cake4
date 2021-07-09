<h1><?= __("Order") ?></h1>
<ul>
    <li><strong><?= __("Shipping Date") ?>: </strong><?= $this->Time->format($order->shipping_date, 'MM/dd/YYYY'); ?></li>
    <li><strong><?= __("Comments") ?>: </strong><?= $this->Format->emptyDescription(h($order->comments)); ?></li>
    <li><strong><?= __("Total Price") ?>: </strong><?= $this->Number->currency($order->total_price); ?></li>
</ul>
<h2><?= __("Details") ?></h2>
<table>
    <tr>
        <th><?= __("Product") ?></th>
        <th><?= __("Type") ?></th>
        <th><?= __("Serial Number") ?></th>
        <th><?= __("Unit Price") ?></th>
        <th><?= __("Created") ?></th>
    </tr>
    <?php foreach ($order->order_details as $detail) : ?>
    <tr>
        <td><?= $detail->product_stock->product->name ?></td>
        <td><?= $detail->product_stock->product->product_type->name ?></td>
        <td><?= $detail->product_stock->serialnumber ?></td>
        <td><?= $detail->unit_price ?></td>
        <td><?= $detail->created->format(DATE_RFC850); ?></td>
    </tr>
    <?php endforeach; ?>
</table>