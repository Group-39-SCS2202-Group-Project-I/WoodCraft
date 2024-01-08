<?php include "inc/header.view.php"; ?>
<?php
$url = ROOT . "/fetch/production";
$response = file_get_contents($url);
$productions = json_decode($response, true);
// show($productions);

$finished_productions = [];
foreach ($productions as $production) {
    if ($production['status'] == 'completed') {
        $finished_productions[] = $production;
    }
}
// show($finished_productions);
?>

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
    <h2 class="table-section__title">Completed Productions</h2>
    <div class="table-section__search">
        <input type="text" id="searchFinProductions" placeholder="Search Completed Productions..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="fin-productions-table">
        <!-- [production_id] => 2
            [product_id] => 7
            [quantity] => 1
            [status] => completed
            [created_at] => 2024-01-01 22:46:18
            [updated_at] => 2024-01-01 22:46:18
            [product_name] => Brooklyn Sofa -->
        <thead>
            <tr>
                <th>Production ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <!-- <th>Created At</th> -->
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/production')
                            .then(response => response.json())
                            .then(data => {
                                // console.log(data);
                                let table = document.getElementById('fin-productions-table');

                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }

                                data.forEach(item => {
                                    if (item.status == 'completed') {
                                        let row = table.insertRow();
                                        let production_id = "PXN-" + String(item.production_id).padStart(3, '0');
                                        let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                                        let product_name = item.product_name;
                                        let quantity = item.quantity;
                                        let status = item.status;
                                        status = status.charAt(0).toUpperCase() + status.slice(1);
                                        let created_at = item.created_at;
                                        let updated_at = item.updated_at;

                                        row.insertCell().innerHTML = production_id;
                                        row.insertCell().innerHTML = product_id;
                                        row.insertCell().innerHTML = product_name;
                                        row.insertCell().innerHTML = quantity;
                                        row.insertCell().innerHTML = `<a class="table-section__button table-section__button-completed">${status}</a>`;
                                        // row.insertCell().innerHTML = created_at;
                                        row.insertCell().innerHTML = updated_at;
                                        row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/pm/production/${item.production_id}" class="table-section__button">View</a>`;

                                    }
                                });

                            }).catch(error => console.error(error));
                    }
                    updateTable();
                });
            </script>
        </tbody>
    </table>
</div>





<?php include "inc/footer.view.php"; ?>