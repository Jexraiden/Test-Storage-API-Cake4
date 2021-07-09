<?php
/**
 * * The commented code was my attempt at Ajax that I will revisit later.
 * * This template + folder (ajax) were created to separate the response from the normal view.
 * * Remove both later if it is not needed anymore.
 * TODO: correct AJAX-Js.
 */
?>

<table>
    <tr>
        <th><?= __("In Stock") ?></th>
        <th><?= __("Unit Price") ?></th>
    </tr>
    <tr>
        <td><?= $productInfo['in_stock'] ?></td>
        <td><?= $productInfo['unit_price'] ?></td>
    </tr>
</table>
