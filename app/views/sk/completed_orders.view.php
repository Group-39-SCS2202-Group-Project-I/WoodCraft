<?php include "inc/header.view.php"; ?>

<?php
// show($data);

$retail_orders = $data['retail_orders'];
$bulk_orders = $data['bulk_orders'];

// show($retail_orders);
// show($bulk_orders);

$retail_count = 0;
$bulk_count = 0;
if (isset($retail_orders)) {
    $retail_count = count($retail_orders);
}
if (isset($bulk_orders)) {
    $bulk_count = count($bulk_orders);
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
        <a href="<?= ROOT ?>/sk/orders" style=" width: 33.2%; " class="btn-section__add-link top-btn-all " id="all-btn">Retail Orders</a>
        <a href="<?= ROOT ?>/sk/orders/bulk" style=" width: 33.2%; " class="btn-section__add-link top-btn-pending" id="pen-btn">Bulk Orders</a>
        <a href="<?= ROOT ?>/sk/orders/completed" style=" width: 33.2%; " class="btn-section__add-link top-btn-processing top-btn-selected" id="pro-btn">Completed Orders</a>
    </div>
    <h2 class="table-section__title" style=" margin-bottom:0">Completed orders</h2>
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
    <?php if ($retail_count != 0) : ?>
        <a href="" style="text-decoration:none;">
            <div class="card" id="pickup-card">
                <h3 class="card-title">Retail Orders</h3>
                <span class="material-symbols-outlined card-icon">
                    box
                </span>
                <p class="card-text"><?= $retail_count ?></p>
            </div>
        </a>
    <?php endif; ?>
    <?php if ($bulk_count != 0) : ?>
        <a href="" style="text-decoration:none">
            <div class="card" id="delivery_card">
                <h3 class="card-title">Bulk Orders</h3>
                <span class="material-symbols-outlined card-icon">
                    local_shipping
                </span>
                <p class="card-text"><?= $bulk_count ?></p>
            </div>
        </a>
    <?php endif; ?>
</div>

<div class="table-section" id="pickup-table">
    <h2 class="table-section__title">Retail Orders</h2>

    <table class="table-section__table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Items</th>
                <th>Order Type</th>
                <th>Total</th>
                <th>Order Completed</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($retail_orders as $order) : ?>
                <tr>
                    <td><?= $order->order_details_id ?></td>
                    <td><?= $order->customer_name ?></td>
                    <td><?php
                        // $order_items = json_decode($order->items);
                        $order_items = $order->items;
                        foreach ($order_items as $item) {
                            echo $item->product_name . " x " . $item->quantity . "<br>";
                        }
                        ?></td>
                       <td><?= $order->type ?></td>
                    <td><?= $order->total ?></td>
                    <td><?= $order->updated_at ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="table-section" id="pickup-table">
    <h2 class="table-section__title">Bulk Orders</h2>

    <table class="table-section__table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Items</th>
                <th>Order Type</th>
                <th>Total</th>
                <th>Order Completed</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($bulk_orders as $order) : ?>
                <tr>
                    <td><?= $order->bulk_order_details_id ?></td>
                    <td><?= $order->customer_name ?></td>
                    <td> <?= $order->bulk_req->product_name .' x '.$order->bulk_req->quantity  ?> </td>
                    <td><?= $order->type ?></td>
                    <td><?= $order->total_cost ?></td>
                    <td><?= $order->updated_at ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php include "inc/footer.view.php"; ?>