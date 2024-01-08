<?php include "inc/header.view.php"; ?>

<!-- [{"finished_production_id":1,"production_id":2,"added":"NA","product_id":7,"quantity":1,"status":"completed","product_name":"Brooklyn Sofa"}] -->

<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>


    <h2 class="table-section__title">Finished Productions</h2>



    <div class="table-section__search">
        <input type="text" id="searchFinProd" placeholder="Search Finished Productions..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="finprod-table">
        <thead>
            <tr>
                <th>Production ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
        <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/finished_productions')
                            .then(response => response.json())
                            .then(data => {
                                
                                let table = document.getElementById('finprod-table');

                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }

                                data.forEach(item => {
                                    let row = table.insertRow();
                                    let finished_production_id = item.finished_production_id;
                                    // let finished_production_id = "FIN-" + String(item.finished_production_id).padStart(3, '0');
                                    let production_id = "PXN-" + String(item.production_id).padStart(3, '0');
                                    let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                                    let product_name = item.product_name;
                                    let quantity = item.quantity;

                                    row.insertCell().innerHTML = production_id;
                                    row.insertCell().innerHTML = product_id;
                                    row.insertCell().innerHTML = product_name;
                                    row.insertCell().innerHTML = quantity;
                                    row.insertCell().innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${finished_production_id})">Add to Stock</a>`;
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