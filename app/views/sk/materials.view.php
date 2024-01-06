<?php include "inc/header.view.php"; ?>

<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>


    <h2 class="table-section__title">Materials</h2>

   

    <div class="table-section__search">
        <input type="text" id="searchMaterials" placeholder="Search Materials..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="materials-table">
        <thead>
            <tr>
                <th>Material ID</th>
                <th>Material Name</th>
                <th>Stock Available</th>
                <!-- <th>No of Products</th> -->
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/materials')
                            .then(response => response.json())
                            .then(data => {
                                // console.log(data);
                                let table = document.getElementById('materials-table');

                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }


                                



                                data.forEach(item => {
                                    let row = table.insertRow();
                                    let material_id = "MAT-" + String(item.material_id).padStart(3, '0');
                                    row.insertCell().innerHTML = material_id;
                                    row.insertCell().innerHTML = item.material_name;
                                    row.insertCell().innerHTML = item.stock_available;
                                   
                                    row.insertCell().innerHTML = item.updated_at;
                                });
                            });
                    }

                    updateTable();

                    
                });
            </script>

        
   


<?php include "inc/footer.view.php"; ?>