<?php include "inc/header.view.php"; ?>
<!-- <a href="<?= ROOT ?>/sk/orders/completed"> completed orders</a> -->

<?php
show($data);
?>

<style>
    .top-btn-selected {
        background-color: var(--blk);
        color: white;
    }
</style>


<div class="table-section" style=" padding-bottom:0; padding-top:0;">
    <div class="buttons-container">
        <a href="<?=ROOT?>/sk/orders" style=" width: 33.2%; " class="btn-section__add-link top-btn-all top-btn-selected" id="all-btn">Retail Orders</a>
        <a href="<?=ROOT?>/sk/orders/bulk" style=" width: 33.2%; " class="btn-section__add-link top-btn-pending" id="pen-btn">Bulk Orders</a>
        <a href="<?=ROOT?>/sk/orders/completed" style=" width: 33.2%; " class="btn-section__add-link top-btn-processing" id="pro-btn">Completed Orders</a>
    </div>

    <h2 class="table-section__title" style=" margin-bottom:0">Retail orders ready for delivery or pickup</h2>
</div>



<?php include "inc/footer.view.php"; ?>