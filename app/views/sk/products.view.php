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

    <div id="scrollable_sec">
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

                                products.sort((a, b) => {
                                    return new Date(b.updated_at) - new Date(a.updated_at);
                                });

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

                    const searchProducts = document.getElementById('searchProducts');
                    searchProducts.addEventListener('keyup', function() {
                        let filter, table, tr, td, i, txtValue;
                        filter = searchProducts.value.toUpperCase();
                        table = document.getElementById('products-table');
                        tr = table.getElementsByTagName('tr');
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName('td')[1];
                            if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = '';
                                } else {
                                    tr[i].style.display = 'none';
                                }
                            }
                        }
                    });
                });
            </script>
        </tbody>
    </table>
    </div>
</div>

<?php include "inc/footer.view.php"; ?>