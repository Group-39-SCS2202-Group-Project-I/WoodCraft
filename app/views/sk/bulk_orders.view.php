<?php include "inc/header.view.php"; ?>
<!-- <a href="<?= ROOT ?>/sk/orders/completed"> completed orders</a> -->
<?php
// show($data);
?>
<?php
// show($data);
$pickup_count = 0;
$delivery_count = 0;
if (isset($data['pickup_count'])) {
    $pickup_count = $data['pickup_count'];
}
if (isset($data['delivery_count'])) {
    $delivery_count = $data['delivery_count'];
}
?>

<style>
    .top-btn-selected {
        background-color: var(--blk);
        color: white;
    }
</style>


<div class="table-section" style=" padding-bottom:0; padding-top:0;">
    <div class="buttons-container">
        <a href="<?= ROOT ?>/sk/orders" style=" width: 33.2%; " class="btn-section__add-link top-btn-all" id="all-btn">Retail Orders</a>
        <a href="<?= ROOT ?>/sk/orders/bulk" style=" width: 33.2%; " class="btn-section__add-link top-btn-pending top-btn-selected" id="pen-btn">Bulk Orders</a>
        <a href="<?= ROOT ?>/sk/orders/completed" style=" width: 33.2%; " class="btn-section__add-link top-btn-processing" id="pro-btn">Completed Orders</a>
    </div>
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>

    <h2 class="table-section__title" style=" margin-bottom:0">Bulk Orders</h2>
</div>

<style>
    .top-btn-selected {
        background-color: var(--blk);
        color: white;
    }

    .card-icon {
        font-size: 70px;
        /* color: #333; */
        font-variation-settings:
            'FILL' 0,
            'wght' 100,
            'GRAD' 0,
            'opsz' 24;
    }

    .card-selected {
        background-color: var(--blk);
        color: white;
    }
</style>

<div class="dashboard">
    <?php if ($pickup_count != 0) : ?>
        <a href="" style="text-decoration:none;">
            <div class="card" id="pickup-card">
                <h3 class="card-title">Pickup Orders</h3>
                <span class="material-symbols-outlined card-icon">
                    box
                </span>
                <p class="card-text"><?= $data['pickup_count'] ?></p>
            </div>
        </a>
    <?php endif; ?>

    <?php if ($delivery_count != 0) : ?>
        <a href="" style="text-decoration:none">
            <div class="card" id="delivery_card">
                <h3 class="card-title">Delivery Orders</h3>
                <span class="material-symbols-outlined card-icon">
                    local_shipping
                </span>
                <p class="card-text"><?= $data['delivery_count'] ?></p>
            </div>
        </a>
    <?php endif; ?>
</div>

<?php if ($pickup_count != 0) : ?>
    <div class="table-section" id="pickup-table">
        <h2 class="table-section__title">Pickup Orders</h2>

        <table class="table-section__table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Details</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-section__tbody">
                <?php foreach ($data['pickups'] as $order) : ?>
                    <tr>
                        <td><?= 'BOD-' . str_pad($order->bulk_order_details_id, 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= $order->customer_name ?></td>
                        <td>
                            <?php
                            echo $order->bulk_req->product_name . " x " . $order->bulk_req->quantity;
                            ?>
                        </td>
                        <td><?= $order->total_cost ?></td>
                        <td><?= $order->status ?></td>
                        <td>
                            <a class="table-section__button" onclick="openPopup('<?= $order->order_details_id ?>','<?= $order->status ?>','<?= $order->type ?>')">Update</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>

<?php if ($delivery_count != 0) : ?>
    <div class="table-section" id="delivery-table">
        <h2 class="table-section__title">Delivery Orders</h2>

        <table class="table-section__table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Details</th>
                    <th>Total Cost</th>
                    <th>Delivery Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-section__tbody">
                <?php foreach ($data['deliveries'] as $order) : ?>
                    <tr>
                        <td><?= 'BOD-' . str_pad($order->bulk_order_details_id, 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= $order->customer_name ?></td>
                        <td>
                            <?php
                             echo $order->bulk_req->product_name . " x " . $order->bulk_req->quantity;
                            ?>
                        </td>
                        <td><?= $order->total_cost ?></td>
                        <td>
                            <?php
                            $address = $order->delivery_address;
                            echo $address->address_line_1 . ",<br>" .
                                $address->address_line_2 . ",<br>" .
                                $address->city . ".<br>" .
                                $address->province . " Province<br>" .
                                $address->zip_code;
                            ?>
                        </td>
                        <td><?= $order->status ?>
                        </td>
                        <td>
                            <a class="table-section__button" onclick="openPopup('<?= $order->order_details_id ?>','<?= $order->status ?>','<?= $order->type ?>')">Update</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>











<?php include "inc/footer.view.php"; ?>