<?php
// show($data);
?>

<form action="<?=ROOT?>/bulk/add_bulk_req" method="post">
        <div class="field-edit-profile">
            <label for="quantity">Quantity:</label><br>
        </div>
        <div class="input-wrapper">
            <input type="number" class="form-control"  id="quantity" name="quantity" min="<?= $data['bulkmin'] ?>" required><br>
        </div>
        <p class="bulk-description">Please note: The minimum bulk order quantity for a product is 10 units.</p>
            <input type="hidden" id="product_id" name="product_id" value="<?= $data['product_id'] ?>">
            <input type="hidden" id="customer_email" name="customer_email" value="<?= Auth::getCustomerEmail() ?>">
            <input type="hidden" id="user_id" name="user_id" value="<?= Auth::getUserId() ?>">
            
        <div class="buttons-profile">
            <input type="submit" class="bulk-submit" value="Submit">
        </div>
</form>