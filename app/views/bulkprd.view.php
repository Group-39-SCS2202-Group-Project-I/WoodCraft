<?php
// show($data);
?>

<form action="<?=ROOT?>/bulk/add_bulk_req" method="post">
    <label for="quantity">Quantity:</label><br>
    <input type="number" id="quantity" name="quantity" min="<?= $data['bulkmin'] ?>" required><br>
    <input type="hidden" id="product_id" name="product_id" value="<?= $data['product_id'] ?>">
    <input type="hidden" id="customer_email" name="customer_email" value="<?= Auth::getCustomerEmail() ?>">
    <input type="submit" value="Submit">
</form>