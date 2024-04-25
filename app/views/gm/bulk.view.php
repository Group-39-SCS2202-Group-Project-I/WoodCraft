<?php include "inc/header.view.php"; ?>
<style>
    .top-btn-selected {
        background-color: var(--blk);
        color: white;
    }
</style>


<div class="table-section" style=" padding-bottom:0; padding-top:0;">
    <div class="buttons-container">
        <a href="<?= ROOT ?>/gm/orders" style=" width: 33.2%; " class="btn-section__add-link top-btn-all " id="all-btn">Overview</a>
        <a href="<?= ROOT ?>/gm/orders/retail" style=" width: 33.2%; " class="btn-section__add-link top-btn-pending" id="pen-btn">Retail Orders</a>
        <a href="<?= ROOT ?>/gm/orders/bulk" style=" width: 33.2%; " class="btn-section__add-link top-btn-processing top-btn-selected " id="pro-btn">Bulk Orders</a>
    </div>
    <h2 class="table-section__title" style=" margin-bottom:0">Bulk Orders</h2>
</div>


<div class="table-section">
    <div class="table-section__search">
        <input type="text" id="searchBulk" placeholder="Search Bulk Orders..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="bulk-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Details</th>
                <th>Total</th>
                <th>Type</th>
                <th>Status</th>
                <th>Order Placed</th>
            </tr>
        </thead>
        <tbody>

        </tbody id="table-section__tbody">
    </table>
</div>

<script>
    const searchBulk = document.getElementById('searchBulk');
    const bulkTable = document.getElementById('bulk-table');
    const tbody = document.getElementById('table-section__tbody');

    document.addEventListener('DOMContentLoaded', (event) => {
        const getBulkOrders = async () => {
            const response = await fetch('<?php echo ROOT ?>/fetch/bulk_orders');
            const data = await response.json();

            // console.log(data);

            let table = document.getElementById('bulk-table');

            while (table.rows.length > 1) {
                table.deleteRow(1);
            }

            data.forEach((order) => {
                let row = table.insertRow();
                let order_id = order.bulk_order_details_id
                let order_details = order.product_name+' x '+order.bulk_req.quantity
                let total = order.bulk_req.total
                let type = order.type
                let status = order.status
                let order_placed = order.created_at

                row.innerHTML = `
                    <td>${order_id}</td>
                    <td>${order_details}</td>
                    <td>${total}</td>
                    <td>${type}</td>
                    <td>${status}</td>
                    <td>${order_placed}</td>
                `;
            });
        }

        getBulkOrders();

    });
</script>


<?php include "inc/footer.view.php"; ?>