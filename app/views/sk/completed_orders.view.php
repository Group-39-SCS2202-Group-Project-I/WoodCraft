<?php include "inc/header.view.php"; ?>



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
    <div id="retail-card">
        <a href="" style="text-decoration:none;">
            <div class="card">
                <h3 class="card-title">Retail Orders</h3>
                <span class="material-symbols-outlined card-icon">
                    box
                </span>
                <p class="card-text" id="retail-count"></p>
            </div>
        </a>
    </div>
    <div id="bulk-card">
        <a href="" style="text-decoration:none">
            <div class="card" >
                <h3 class="card-title">Bulk Orders</h3>
                <span class="material-symbols-outlined card-icon">
                    local_shipping
                </span>
                <p class="card-text" id="bulk-count"></p>
            </div>
        </a>
    </div>
</div>


<div class="table-section">
    <h2 class="table-section__title">Completed Orders</h2>

    <table class="table-section__table" id="com-orders">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Type</th>
                <th>Order Items</th>
                <th>Order Completed</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tbody = document.getElementById('table-section__tbody');
                    const retailCard = document.getElementById('retail-card');
                    const bulkCard = document.getElementById('bulk-card');
                    const retailCount = document.getElementById('retail-count');
                    const bulkCount = document.getElementById('bulk-count');

                    const url = '<?= ROOT ?>/fetch/completed_retail_and_bulk_orders';
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);

                            retailCount.textContent = data.retail_count;
                            bulkCount.textContent = data.bulk_count;


                            if (data.retail_count == 0) {
                                retailCard.style.display = 'none';
                            }

                            if (data.bulk_count == 0) {
                                bulkCard.style.display = 'none';
                            }

                            var orders = data.orders;
                            let table = document.getElementById('com-orders');

                            while (table.rows.length > 1) {
                                table.deleteRow(1);
                            }

                            let items = ''
                            orders.forEach(item => {
                                let row = table.insertRow();
                                if (item.type == 'Retail/Delivery' || item.type == 'Retail/Pickup') {
                                    x = item.items;
                                    items = x.map(item => item.product_name + ' x' + item.quantity).join(', ');
                                } else if (item.type == 'Bulk/Delivery' || item.type == 'Bulk/Pickup') {
                                    items = item.items.product_name + ' x' + item.items.quantity;
                                }

                                row.insertCell().innerHTML = item.order_id;
                                row.insertCell().innerHTML = item.customer_name;
                                row.insertCell().innerHTML = item.type;
                                row.insertCell().innerHTML = items;
                                row.insertCell().innerHTML = item.updated_at;
                            });
                        });
                });
            </script>
        </tbody>
    </table>
</div>








<?php include "inc/footer.view.php"; ?>