<?php include "inc/header.view.php"; ?>

<!-- fetch productions and display them here -->
<?php
$url = ROOT . "/fetch/production";
$response = file_get_contents($url);
$productions = json_decode($response, true);
// show($productions);

$ongoing_productions = [];
foreach ($productions as $production) {
    if ($production['status'] != 'completed') {
        $ongoing_productions[] = $production;
    }
}
// show($ongoing_productions);

?>


<?php
if (isset($_SESSION['errors']) && isset($_SESSION['form_data']) && isset($_SESSION['form_id'])) {
    $errors = $_SESSION['errors'];
    $form_data = $_SESSION['form_data'];
    $form_id = $_SESSION['form_id'];
    // $x = $_SESSION['x'];
    // unset the session variables so they don't persist on page refresh
    unset($_SESSION['errors']);
    unset($_SESSION['form_data']);
    unset($_SESSION['form_id']);
    // display the errors and repopulate the form with the data
    // show($form_data);
}
?>


<style>
    .top-btn-selected {
        background-color: var(--blk);
        color: white;
    }
</style>

<div class="table-section">
    <?php if (message()) : ?>
        <div class="mzg-box">
            <div class="messege"><?= message('', true) ?></div>
        </div>
    <?php endif; ?>
    <!-- <?= $x ?> -->
    <h2 class="table-section__title">Productions</h2>
    <div class="table-section__search" style="margin-bottom: 0;">
        <input type="text" id="searchPenProductions" placeholder="Search Pending Productions..." class="table-section__search-input">
    </div>

    <div class="buttons-container">
        <a class="btn-section__add-link top-btn-all top-btn-selected" id="all-btn">All Productions</a>
        <a class="btn-section__add-link top-btn-pending" id="pen-btn">Pending Productions</a>
        <a class="btn-section__add-link top-btn-processing" id="pro-btn">Processing Productions</a>
        <a class="btn-section__add-link top-btn-completed" id="com-btn">Completed Productions</a>
    </div>

    <div id="scrollable_sec">
        <table class="table-section__table" id="pen-productions-table">
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
                        function updateTable(filter) {
                            fetch('<?php echo ROOT ?>/fetch/production')
                                .then(response => response.json())
                                .then(data => {
                                    let table = document.getElementById('pen-productions-table');

                                    while (table.rows.length > 1) {
                                        table.deleteRow(1);
                                    }

                                    data.sort((a, b) => {
                                        return new Date(b.updated_at) - new Date(a.updated_at);
                                    });

                                    data.forEach(item => {
                                        let row = table.insertRow();
                                        let production_id = "PXN-" + String(item.production_id).padStart(3, '0');
                                        let product_id = "PRD-" + String(item.product_id).padStart(3, '0');
                                        let product_name = item.product_name;
                                        let quantity = item.quantity;
                                        let status = item.status;
                                        status = status.charAt(0).toUpperCase() + status.slice(1);
                                        let created_at = item.created_at;
                                        let updated_at = item.updated_at;

                                        data.sort((a, b) => {
                                            return new Date(b.updated_at) - new Date(a.updated_at);
                                        });

                                        if (filter === 'pending' && status !== 'Pending') {
                                            return; // Skip this row if filter is 'pending' and status is not 'Pending'
                                        }

                                        if (filter === 'processing' && status !== 'Processing') {
                                            return; // Skip this row if filter is 'processing' and status is not 'Processing'
                                        }

                                        if (filter === 'completed' && status !== 'Completed') {
                                            return; // Skip this row if filter is 'completed' and status is not 'Completed'
                                        }

                                        row.insertCell().innerHTML = production_id;
                                        row.insertCell().innerHTML = product_id;
                                        row.insertCell().innerHTML = product_name;
                                        row.insertCell().innerHTML = quantity;

                                        if (status == 'Pending') {
                                            row.insertCell().innerHTML = `<a class="table-section__button pending table-section__button-pending">${status}</a>`;
                                        } else if (status == 'Processing') {
                                            row.insertCell().innerHTML = `<a class="table-section__button processing table-section__button-processing">${status}</a>`;
                                        } else if (status == 'Completed') {
                                            row.insertCell().innerHTML = `<a class="table-section__button completed table-section__button-completed">${status}</a>`;
                                        }

                                        row.insertCell().innerHTML = updated_at;

                                        if (status == 'Processing') {
                                            row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/pm/production/${item.production_id}" class="table-section__button">View</a> <a  onclick="openUpdatePopup(${item.production_id})" class="table-section__button">Complete</a>`;
                                        } else {
                                            row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/pm/production/${item.production_id}" class="table-section__button">View</a>`;
                                        }
                                    });
                                }).catch(error => console.error(error));
                        }

                        updateTable('all');

                        if (sessionStorage.getItem('x')) {
                            const penbtn = document.getElementById('pen-btn');
                            const probtn = document.getElementById('pro-btn');

                            let x = sessionStorage.getItem('x');
                            sessionStorage.removeItem('x');
                            if (x == 'pending') {
                                console.log('pen clicked!')
                                updateTable('pending');

                                document.getElementById('pen-btn').classList.add('top-btn-selected');
                                document.getElementById('pro-btn').classList.remove('top-btn-selected');
                                document.getElementById('com-btn').classList.remove('top-btn-selected');
                                document.getElementById('all-btn').classList.remove('top-btn-selected');
                            } else if (x == 'processing') {
                                console.log('pro clicked!')
                                updateTable('processing');

                                document.getElementById('pro-btn').classList.add('top-btn-selected');
                                document.getElementById('pen-btn').classList.remove('top-btn-selected');
                                document.getElementById('com-btn').classList.remove('top-btn-selected');
                                document.getElementById('all-btn').classList.remove('top-btn-selected');

                            }


                        }

                        // Button click event handlers
                        document.getElementById('pen-btn').addEventListener('click', function() {
                            updateTable('pending');

                            document.getElementById('pen-btn').classList.add('top-btn-selected');
                            document.getElementById('pro-btn').classList.remove('top-btn-selected');
                            document.getElementById('com-btn').classList.remove('top-btn-selected');
                            document.getElementById('all-btn').classList.remove('top-btn-selected');

                        });

                        document.getElementById('pro-btn').addEventListener('click', function() {
                            updateTable('processing');

                            document.getElementById('pro-btn').classList.add('top-btn-selected');
                            document.getElementById('pen-btn').classList.remove('top-btn-selected');
                            document.getElementById('com-btn').classList.remove('top-btn-selected');
                            document.getElementById('all-btn').classList.remove('top-btn-selected');
                        });

                        document.getElementById('com-btn').addEventListener('click', function() {
                            updateTable('completed');

                            document.getElementById('com-btn').classList.add('top-btn-selected');
                            document.getElementById('pen-btn').classList.remove('top-btn-selected');
                            document.getElementById('pro-btn').classList.remove('top-btn-selected');
                            document.getElementById('all-btn').classList.remove('top-btn-selected');
                        });

                        document.getElementById('all-btn').addEventListener('click', function() {
                            updateTable('all');

                            document.getElementById('all-btn').classList.add('top-btn-selected');
                            document.getElementById('pen-btn').classList.remove('top-btn-selected');
                            document.getElementById('pro-btn').classList.remove('top-btn-selected');
                            document.getElementById('com-btn').classList.remove('top-btn-selected');
                        });

                


                    });
                </script>
            </tbody>
        </table>
    </div>

    <div class="popup-form" id="complete-item-popup">
        <div class="popup-form__content">
            <form action="" method="POST" class="form">
                <!-- <h2 class="popup-form-title">Delete Item</h2> -->
                <!-- <p>Are you sure you want to delete this item?</p> -->
                <p class="confirmation-text">Complete Production </p>

                <div class="form-group frm-btns">
                    <button type="submit" class="form-btn submit-btn">Yes</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        openUpdatePopup = (id) => {
            const popup = document.getElementById('complete-item-popup');
            const confirmationText = document.querySelector('.confirmation-text');
            x = "PXN-" + String(id).padStart(3, '0');
            confirmationText.innerHTML += x + "?";
            popup.classList.add('popup-form--open');
            popup.querySelector('form').action = "<?php echo ROOT ?>/update/complete_production/" + id;
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