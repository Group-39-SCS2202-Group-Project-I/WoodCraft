<?php include "inc/header.view.php"; ?>


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


    <a style="text-decoration:none;">
        <div class="card" id="pickup-card">
            <h3 class="card-title">Pickup Orders</h3>
            <span class="material-symbols-outlined card-icon">
                box
            </span>
            <p class="card-text"><?= $data['pickup_count'] ?></p>
        </div>
    </a>


    <a style="text-decoration:none">
        <div class="card" id="delivery_card">
            <h3 class="card-title">Delivery Orders</h3>
            <span class="material-symbols-outlined card-icon">
                local_shipping
            </span>
            <p class="card-text"><?= $data['delivery_count'] ?></p>
        </div>
    </a>

</div>

<div class="table-section">
    <h2 class="table-section__title">Pickup Orders</h2>

    <div id="scrollable_sec">
        <table class="table-section__table" id="pickup-table">
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

        </table>
    </div>
</div>




<div class="table-section">
    <h2 class="table-section__title">Delivery Orders</h2>

    <div id="scrollable_sec">
        <table class="table-section__table" id="delivery-table">
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
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pickupTable = document.getElementById('pickup-table');
        const deliveryTable = document.getElementById('delivery-table');

        const url = '<?= ROOT ?>/fetch/retail_orders_sk';
        fetch(url)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                var pickup_count = 0;
                var delivery_count = 0;

                var deliveries = data.delivery_orders;
                var pickups = data.pickup_orders;

                if (pickups) {
                    pickup_count = pickups.length;
                    document.getElementById('pickup-card').querySelector('.card-text').textContent = pickup_count;
                } else {
                    document.getElementById('pickup-card').style.display = 'none';
                }

                if (deliveries) {
                    delivery_count = deliveries.length;
                    document.getElementById('delivery_card').querySelector('.card-text').textContent = delivery_count;
                } else {
                    document.getElementById('delivery_card').style.display = 'none';
                }

                while (pickupTable.rows.length > 1) {
                    pickupTable.deleteRow(1);
                }

                while (deliveryTable.rows.length > 1) {
                    deliveryTable.deleteRow(1);
                }


                pickups.forEach(item => {
                    let row = pickupTable.insertRow();
                    let order_id = "ORD-" + String(item.order_details_id).padStart(3, '0');
                    let customer_name = item.customer_name;
                    let items = item.items.map(item => item.product_name + ' x ' + item.quantity).join('<br>');
                    let total = item.total;
                    let status = item.status.charAt(0).toUpperCase() + item.status.slice(1);

                    row.insertCell().innerHTML = order_id;
                    row.insertCell().innerHTML = customer_name;
                    row.insertCell().innerHTML = items;
                    row.insertCell().innerHTML = total;
                    row.insertCell().innerHTML = status;

                    let actionCell = row.insertCell();
                    let actionBtn = document.createElement('a');
                    actionBtn.textContent = 'Update Status';
                    actionBtn.classList.add('table-section__button');
                    actionBtn.onclick = function() {
                        openPopup(item.order_details_id, item.status, 'pickup');
                    }
                    actionCell.appendChild(actionBtn);


                });

                console.log(deliveries);
                deliveries.forEach(item => {
                    let row = deliveryTable.insertRow();
                    let order_id = "ORD-" + String(item.order_details_id).padStart(3, '0');
                    let customer_name = item.customer_name;
                    let items = item.items.map(item => item.product_name + ' x ' + item.quantity).join('<br>');
                    let total = item.total;
                    let delivery_address = item.delivery_address.address_line_1 + ',<br>' + item.delivery_address.address_line_2 + ',<br>' + item.delivery_address.city + ',<br>' + item.delivery_address.province + ',<br>' + item.delivery_address.zip_code;
                    let status = item.status.charAt(0).toUpperCase() + item.status.slice(1);

                    row.insertCell().innerHTML = order_id;
                    row.insertCell().innerHTML = customer_name;
                    row.insertCell().innerHTML = items;
                    row.insertCell().innerHTML = total;
                    row.insertCell().innerHTML = delivery_address;
                    row.insertCell().innerHTML = status;

                    let actionCell = row.insertCell();
                    let actionBtn = document.createElement('a');
                    actionBtn.textContent = 'Update Status';
                    actionBtn.classList.add('table-section__button');
                    actionBtn.onclick = function() {
                        openPopup(item.order_details_id, item.status, 'delivery');
                    }
                    actionCell.appendChild(actionBtn);
                });


            });

        // const pickupCard = document.getElementById('pickup-card');
        // const deliveryCard = document.getElementById('delivery_card');

    });
</script>


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