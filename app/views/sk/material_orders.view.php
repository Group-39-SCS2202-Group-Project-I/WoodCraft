<?php include "inc/header.view.php"; ?>

<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>


    <h2 class="table-section__title">Received Material Orders</h2>

    <div class="table-section__add">
        <a href="<?php echo ROOT ?>/sk/material_orders/add" class="table-section__add-link">Add Received Material Order</a>
    </div>



    <div class="table-section__search">
        <input type="text" id="searchMatOrd" placeholder="Search Material Orders..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="mat-ord-table">
        <thead>
            <tr>
                <th>Material Order ID</th>
                <th>Material ID</th>
                <!-- <th>Stock No</th> -->
                <th>Material Name</th>
                <th>Supplier ID</th>
                <th>Quantity</th>
                <th>Price Per Unit</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/material_orders')
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                let table = document.getElementById('mat-ord-table');

                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }

                                data.forEach(item => {
                                    let row = table.insertRow();
                                    let material_order_id = "MTO-" + String(item.material_order_id).padStart(3, '0');
                                    let material_id = "MAT-" + String(item.material_id).padStart(3, '0');
                                    let supplier_id = "SUP-" + String(item.supplier_id).padStart(3, '0');
                                    // let stock_id = "STK-" + String(item.material_stk.stock_no).padStart(3, '0');
                                    row.insertCell().innerHTML = material_order_id;
                                    row.insertCell().innerHTML = material_id;
                                    row.insertCell().innerHTML = stock_id;
                                    row.insertCell().innerHTML = item.material_name;
                                    row.insertCell().innerHTML = supplier_id;
                                    row.insertCell().innerHTML = item.quantity;
                                    row.insertCell().innerHTML = item.price_per_unit;
                                    row.insertCell().innerHTML = `<th>${item.total}</th>`
                                });
                            });
                    }

                    updateTable();

                    let searchMatOrd = document.getElementById('searchMatOrd');
                    searchMatOrd.addEventListener('keyup', function() {
                        let input = searchMatOrd.value.toUpperCase();
                        let table = document.getElementById('mat-ord-table');
                        let tr = table.getElementsByTagName('tr');

                        for (var i = 0; i < tr.length; i++) {
                            let td = tr[i].getElementsByTagName('td')[0];
                            if (td) {
                                let txtValue = td.textContent || td.innerHTML;
                                if (txtValue.toUpperCase().indexOf(input) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    });
                });
            </script>
        </tbody>
    </table>
</div>



<?php include "inc/footer.view.php"; ?>