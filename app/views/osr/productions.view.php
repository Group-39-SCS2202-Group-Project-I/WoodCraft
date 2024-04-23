<?php include "inc/header.view.php"; ?>
<div class="table-section">
    <h2 class="table-section__title">Ongoing Productions</h2>

    <div class="table-section__search">
        <input type="text" id="searchProductions" placeholder="Search Productions..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="productions-table">
        <thead>
            <tr>
                <th>Production ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Production Started</th>
            </tr>
        </thead>
        <tbody>

        </tbody id="table-section__tbody">
    </table>
</div>

<script>
    const searchProductions = document.getElementById('searchProductions');
    const productionsTable = document.getElementById('productions-table');
    const tbody = document.getElementById('table-section__tbody');

    

    document.addEventListener('DOMContentLoaded', (event) => {
        const getProductions = async () => {
            const response = await fetch('<?php echo ROOT ?>/fetch/ongoing_pxns');
            const data = await response.json();

            console.log(data);

            let table = document.getElementById('productions-table');

            while (table.rows.length > 1) {
                table.deleteRow(1);
            }

            data.forEach(item => {
                let row = table.insertRow();
                let production_id = "PXN-" + String(item.production_id).padStart(3, '0');
                let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                row.innerHTML = `
                                <td>${production_id}</td>
                                <td>${product_id}</td>
                                <td>${item.product_name}</td>
                                <td>${item.quantity}</td>
                                <td>${item.created_at}</td>
                            `;
            });
        };


        getProductions();
    });

</script>





<?php include "inc/footer.view.php"; ?>