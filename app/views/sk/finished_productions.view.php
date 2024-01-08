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
                                    if (item.added == "NA") {
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

                                    }

                                });
                            });
                    }
                    updateTable();
                });
            </script>
        </tbody>
    </table>

    <div class="popup-form" id="add-to-stk-popup">
        <div class="popup-form__content">
            <form action="" method="POST" class="form">
                <!-- <h2 class="popup-form-title">Delete Item</h2> -->
                <!-- <p>Are you sure you want to delete this item?</p> -->
                <p class="confirmation-text">Add Product to Stock </p>

                <div class="form-group frm-btns">
                    <button type="submit" class="form-btn submit-btn">Yes</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        openUpdatePopup = (id) => {
            const popup = document.getElementById('add-to-stk-popup');
            const confirmationText = document.querySelector('.confirmation-text');
            //get production id by id
            // var production_id;
            fetch('<?php echo ROOT ?>/fetch/finished_productions/')
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        // console.log(item);
                        if (item.finished_production_id == id) {
                            production_id = item.production_id;
                            console.log(production_id);
                        } else {
                            console.log("not found");
                        }
                    });
                });
            x = "PXN-" + String(production_id).padStart(3, '0');
            confirmationText.innerHTML = "Add Products from " + x + " to Stock?";
            popup.classList.add('popup-form--open');
            popup.querySelector('form').action = "<?php echo ROOT ?>/update/add_fin_pxn/" + id;
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

            confirmText.innerHTML = "Add Products from to Stock";
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