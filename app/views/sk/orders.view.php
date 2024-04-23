<?php include "inc/header.view.php"; ?>
<!-- <a href="<?= ROOT ?>/sk/orders/completed"> completed orders</a> -->

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

<div class="table-section" style=" padding-bottom:0; padding-top:0;">
    <div class="buttons-container">
        <a href="<?= ROOT ?>/sk/orders" style=" width: 33.2%; " class="btn-section__add-link top-btn-all top-btn-selected" id="all-btn">Retail Orders</a>
        <a href="<?= ROOT ?>/sk/orders/bulk" style=" width: 33.2%; " class="btn-section__add-link top-btn-pending" id="pen-btn">Bulk Orders</a>
        <a href="<?= ROOT ?>/sk/orders/completed" style=" width: 33.2%; " class="btn-section__add-link top-btn-processing" id="pro-btn">Completed Orders</a>
    </div>

    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>

    <h2 class="table-section__title" style=" margin-bottom:0">Retail Orders</h2>
</div>

<div class="dashboard">
    <?php if (isset($data['pickup_orders'])) : ?>
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
    <?php endif; ?>
    <?php if (isset($data['delivery_orders'])) : ?>
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
    <?php endif; ?>
</div>

<?php if (isset($data['pickup_orders']) && !empty($data['pickup_orders'])) : ?>
    <?php if ($pickup_count != 0) : ?>
        <div class="table-section" id="pickup-table">
            <h2 class="table-section__title">Pickup Orders</h2>

            <table class="table-section__table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Order Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-section__tbody">
                    <?php foreach ($data['pickup_orders'] as $order) : ?>
                        <tr>
                            <td><?= 'ORD-' . str_pad($order->order_details_id, 3, '0', STR_PAD_LEFT) ?></td>
                            <td><?= $order->customer_name ?></td>
                            <td>
                                <?php
                                // $order_items = json_decode($order->items);
                                $order_items = $order->items;
                                foreach ($order_items as $item) {
                                    echo $item->product_name . " x " . $item->quantity . "<br>";
                                }
                                ?>
                            </td>
                            <td><?= $order->total ?></td>
                            <td><?= $order->status ?></td>
                            <td>
                                <a class="table-section__button" onclick="openPopup('<?= $order->order_details_id ?>','<?= $order->status ?>','<?= $order->type ?>')">Update</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
<?php endif; ?>


<?php if (isset($data['delivery_orders']) && !empty($data['delivery_orders'])) : ?>
    <?php if ($delivery_count != 0) : ?>
        <div class="table-section" id="pickup-table">
            <h2 class="table-section__title">Delivery Orders</h2>

            <table class="table-section__table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Order Items</th>
                        <th>Total</th>
                        <th>Delivery Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-section__tbody">
                    <?php foreach ($data['delivery_orders'] as $order) : ?>
                        <tr>
                            <td><?= 'ORD-' . str_pad($order->order_details_id, 3, '0', STR_PAD_LEFT) ?></td>
                            <td><?= $order->customer_name ?></td>
                            <td>
                                <?php
                                // $order_items = json_decode($order->items);
                                $order_items = $order->items;
                                foreach ($order_items as $item) {
                                    echo $item->product_name . " x " . $item->quantity . "<br>";
                                }
                                ?>
                            </td>
                            <td><?= $order->total ?></td>
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
<?php endif; ?>

<div class="popup-form" id="update-popup">
    <div class="popup-form__content">
        <form action="" method="POST" class="form">
            <!-- <h2 class="popup-form-title">Delete Item</h2> -->
            <!-- <p>Are you sure you want to delete this item?</p> -->
            <p class="confirmation-text"> </p>

            <input type="hidden" name="status" value="" id="hidden-inp">


            <div class="form-group frm-btns">
                <button type="submit" class="form-btn submit-btn">Yes</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
            </div>
        </form>
    </div>
</div>

<script>
    openPopup = (id, status, type) => {
        const popup = document.getElementById('update-popup');
        const confirmationText = document.querySelector('.confirmation-text');
        x = "ORD-" + String(id).padStart(3, '0');
        if (type == "pickup") {
            if (status == "processing") {
                status = "ready to pick up";
            } else if (status == "ready to pick up") {
                status = "completed";
            }
        } else if (type == "delivery") {
            if (status == "processing") {
                status = "delivering";
            } else if (status == "delivering") {
                status = "completed";
            }
        }

        confirmationText.innerHTML += "Are you sure you want to update the status of order " + x + " to " + status + " ?";
        document.getElementById('hidden-inp').value = status;

        popup.classList.add('popup-form--open');
        popup.querySelector('form').action = "<?php echo ROOT ?>/sk/update_order_status/" + id;
    }

    closePopup = () => {
        const popup = document.getElementById('update-popup');
        popup.classList.remove('popup-form--open');
        const confirmationText = document.querySelector('.confirmation-text');
        confirmationText.innerHTML = "";
    }
</script>







<?php include "inc/footer.view.php"; ?>