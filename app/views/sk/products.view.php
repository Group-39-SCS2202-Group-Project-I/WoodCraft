<?php include "inc/header.view.php"; ?>
<!-- product_id	
name	
description	
product_category_id	
product_inventory_id	
product_measurement_id	
price	
created_at	
updated_at	
deleted_at	 -->
<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>


    <h2 class="table-section__title">Products Stock</h2>



    <div class="table-section__search">
        <input type="text" id="searchProducts" placeholder="Search Products..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="products-table">
        <thead>
            <tr>
                <th>Products ID</th>
                <th>Product Name</th>
                <th>Stock Available</th>
                <!-- <th>No of Products</th> -->
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
        <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/product')
                            .then(response => response.json())
                            .then(data => {
                                var products = data['products'];
                                console.log(products);
                                let table = document.getElementById('products-table');

                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }

                                products.forEach(item => {
                                    let row = table.insertRow();
                                    let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                                    

                                    row.insertCell().innerHTML = product_id;
                                    row.insertCell().innerHTML = item.name;
                                    row.insertCell().innerHTML = item.quantity;

                                    row.insertCell().innerHTML = item.updated_at;
                                });
                            });
                    }
                    updateTable();
                });
            </script>
        </tbody>
    </table>
</div>

<?php include "inc/footer.view.php"; ?>