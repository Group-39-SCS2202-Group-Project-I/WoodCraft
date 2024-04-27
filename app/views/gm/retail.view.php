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
        <a href="<?= ROOT ?>/gm/orders/retail" style=" width: 33.2%; " class="btn-section__add-link top-btn-pending top-btn-selected" id="pen-btn">Retail Orders</a>
        <a href="<?= ROOT ?>/gm/orders/bulk" style=" width: 33.2%; " class="btn-section__add-link top-btn-processing  " id="pro-btn">Bulk Orders</a>
    </div>
    <h2 class="table-section__title" style=" margin-bottom:0">Retail Orders</h2>
</div>


<div class="table-section">


    <div class="table-section__search">
        <input type="text" id="searchRetail" placeholder="Search Retail Orders..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="retail-table">
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
    const searchProductions = document.getElementById('searchProductions');
    const productionsTable = document.getElementById('retail-table');
    const tbody = document.getElementById('table-section__tbody');

    document.addEventListener('DOMContentLoaded', (event) => {
        const getProductions = async () => {
            const response = await fetch('<?php echo ROOT ?>/fetch/retail_orders');
            const data = await response.json();

            // console.log(data);

            let table = document.getElementById('retail-table');

            while (table.rows.length > 1) {
                table.deleteRow(1);
            }

            data.sort((a, b) => {
                return new Date(b.created_at) - new Date(a.created_at);
            });

            data.forEach(item => {
                let row = table.insertRow();
                let order_id = "ORD-" + String(item.order_details_id).padStart(3, '0');
                let order_details = ''
                for (let i = 0; i < item.items.length; i++) {
                    order_details += item.items[i].product_name + " x" + item.items[i].quantity + '<br>';
                }
                let total = item.total
                let type = item.type.charAt(0).toUpperCase() + item.type.slice(1);
                let status = item.status.charAt(0).toUpperCase() + item.status.slice(1);
                let order_placed = item.created_at;

                
                row.innerHTML = `
                                <td>${order_id}</td>
                                <td>${order_details}</td>
                                <td>${total}</td>
                                <td>${type}</td>
                                <td>${status}</td>
                                <td>${order_placed}</td>
                            `;
            });
        };

        getProductions();

        searchProductions.addEventListener('input', function() {
            let searchValue = this.value.toLowerCase();
            let rows = productionsTable.rows;
            for (let i = 1; i < rows.length; i++) {
                let order_id = rows[i].cells[0].innerText.toLowerCase();
                let order_details = rows[i].cells[1].innerText.toLowerCase();

                if (order_id.includes(searchValue) || order_details.includes(searchValue)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    });
</script>
<?php include "inc/footer.view.php"; ?>