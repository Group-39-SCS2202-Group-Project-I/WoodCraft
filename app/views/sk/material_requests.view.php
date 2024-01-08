<?php include "inc/header.view.php"; ?>

<!-- fetch all production  -->
<?php
$url = ROOT . "/fetch/production";
$response = file_get_contents($url);
$productions = json_decode($response, true);

// select pending productions 
$pending_productions = [];
foreach ($productions as $production) {
    if ($production['status'] == 'pending') {
        $pending_productions[] = $production;
    }
}
// show($pending_productions);

// get product_id and quantity from pending productions
$pending_products = [];
foreach ($pending_productions as $production) {
    $pending_products[] = [
        'production_id' => $production['production_id'],
        'product_id' => $production['product_id'],
        'product_name' => $production['product_name'],
        'quantity' => $production['quantity']
    ];
}
// show($pending_products);

// get materials for each product
$materials = [];
foreach ($pending_products as $product) {
    $url = ROOT . "/fetch/product_materials/" . $product['product_id'];
    $response = file_get_contents($url);
    $materials[] = json_decode($response, true);
}
// show($materials);
// map each material to its pending production
$pending_productions_materials = [];
for ($i = 0; $i < count($pending_products); $i++) {
    $pending_productions_materials[] = [
        'production_id' => $pending_products[$i]['production_id'],
        'product_id' => $pending_products[$i]['product_id'],
        'product_name' => $pending_products[$i]['product_name'],
        'quantity' => $pending_products[$i]['quantity'],
        'materials' => $materials[$i]
    ];
}
// show($pending_productions_materials[0]['materials']);
// show($pending_productions_materials);
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


    <h2 class="table-section__title">Material Requests</h2>
    <div class="table-section__search">
        <input type="text" id="searchPendingProductions" placeholder="Search Pending Productions..." class="table-section__search-input">
    </div>

    <table class="table-section__table" id="pending-productions-table">
        <thead>
            <tr>
                <th>Production ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Requested Materials</th>
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
                                let table = document.getElementById('pending-productions-table');

                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }


                                data.forEach(item => {
                                    if (item.status == 'pending') {
                                        let row = table.insertRow();
                                        let production_id = "PXN-" + String(item.production_id).padStart(3, '0');
                                        let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                                        let product_name = item.product_name;
                                        let quantity = item.quantity;

                                        let material_list = '';
                                        let materials = <?php echo json_encode($pending_productions_materials) ?>;
                                        materials.forEach(material => {
                                            if (material.production_id == item.production_id) {
                                                material.materials.forEach(mat => {
                                                    material_list += `<li>${mat.material_name} - ${mat.quantity_needed*quantity}</li>`;
                                                });
                                            }
                                        });

                                        row.insertCell().innerHTML = production_id;
                                        row.insertCell().innerHTML = product_id;
                                        row.insertCell().innerHTML = product_name;
                                        row.insertCell().innerHTML = quantity;
                                        row.insertCell().innerHTML = material_list;
                                        row.insertCell().innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${item.production_id})">Approve</a>`;
                                    }
                                });
                            });
                    }
                    updateTable();

                });
            </script>

        </tbody>
    </table>

    <div class="popup-form" id="approve-item-popup">
        <div class="popup-form__content">
            <form action="" method="POST" class="form">
                <!-- <h2 class="popup-form-title">Delete Item</h2> -->
                <!-- <p>Are you sure you want to delete this item?</p> -->
                <p class="confirmation-text">Approve Materials for </p>

                <div class="form-group frm-btns">
                    <button type="submit" class="form-btn submit-btn">Yes</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        openUpdatePopup = (id) => {
            const popup = document.getElementById('approve-item-popup');
            const confirmationText = document.querySelector('.confirmation-text');
            x = "PXN-" + String(id).padStart(3, '0');
            confirmationText.innerHTML += x + "?";
            popup.classList.add('popup-form--open');
            popup.querySelector('form').action = "<?php echo ROOT ?>/update/approve_mat/" + id;
        }
    </script>

    <script>
        // Function to open popup form
        function openPopup(popupId) {
            const popup = document.getElementById(popupId);
            popup.classList.add('popup-form--open');
        }

        // Function to close popup form
        function closePopup() {
            const popups = document.querySelectorAll('.popup-form');
            confirmText = document.querySelector('.confirmation-text');

            popups.forEach(popup => {
                popup.classList.remove('popup-form--open');
            });

            confirmText.innerHTML = "Approve Materials for ";
            // Clear validation messages
            const validationMessages = document.querySelectorAll('.validate-mzg');
            validationMessages.forEach(message => {
                message.innerHTML = '';
            });

            // Session storage
            // sessionStorage.removeItem('worker_id');

        }
    </script>


</div>











<?php include "inc/footer.view.php"; ?>