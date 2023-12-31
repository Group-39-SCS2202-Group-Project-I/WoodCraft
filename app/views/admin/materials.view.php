<?php include "inc/header.view.php"; ?>

<?php
if (isset($_SESSION['errors']) && isset($_SESSION['form_data']) && isset($_SESSION['form_id'])) {
    $errors = $_SESSION['errors'];
    $form_data = $_SESSION['form_data'];
    $form_id = $_SESSION['form_id'];
    // unset the session variables so they don't persist on page refresh
    unset($_SESSION['errors']);
    unset($_SESSION['form_data']);
    unset($_SESSION['form_id']);
    // display the errors and repopulate the form with the data
    // show($form_data);
}
?>

<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>


    <h2 class="table-section__title">Materials</h2>

    <div class="table-section__add">
        <a href="#" class="table-section__add-link" onclick="openPopup('add-item-popup')">Add New Material</a>
    </div>

    <div class="table-section__search">
        <input type="text" id="searchMaterials" placeholder="Search Materials..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="material_table">
        <thead>
            <tr>
                <th>Material ID</th>
                <th>Material Name</th>
                <th>Material Description</th>
                <th>Stocks Available</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                            function updateTable() {
                                fetch('<?php echo ROOT ?>/fetch/materials')
                                    .then(response => response.json())
                                    .then(data => {
                                            console.log(data);
                                            let tableBody = document.getElementById('table-section__tbody');
                                            let table = document.getElementById('material_table');
                                            // Clear existing table rows
                                            while (table.rows.length > 1) {
                                                table.deleteRow(1);
                                            }
                                            // Insert new rows with updated data
                                            data.forEach(item => {
                                                let row = table.insertRow();
                                                let material_id = "MAT-" + String(item.material_id).padStart(3, '0');

                                                row.insertCell().innerHTML = material_id;
                                                row.insertCell().innerHTML = item.material_name;
                                                row.insertCell().innerHTML = item.material_description;
                                                row.insertCell().innerHTML = item.stock_available;
                                                row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/admin/materials/edit/${item.material_id}" class="material-symbols-outlined edit-btn"><i class="fas fa-edit"></i></a>
                                                <a href="<?php echo ROOT ?>/admin/materials/delete/${item.material_id}" class="material-symbols-outlined delete-btn"><i class="fas fa-trash-alt"></i></a>`;

                                                
                                            });


                                        })
                                        .catch(error => console.log(error));
                            }
                            updateTable();
                            // setInterval(updateTable, 5000);
                        });
            </script>



            <?php include "inc/footer.view.php"; ?>