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


    <h2 class="table-section__title">Suppliers</h2>

    <div class="table-section__add">
        <a href="#" class="table-section__add-link" onclick="openPopup('add-item-popup')">Add New Supplier</a>
    </div>

    <div class="table-section__search">
        <input type="text" id="searchSuppliers" placeholder="Search Suppliers..." class="table-section__search-input">
    </div>


    <div id="#scrollable_sec">
        <table class="table-section__table" id="suppliers_table">
            <!-- supplier_id	name	email	telephone	brn	address_id	created_at	updated_at -->
            <thead>
                <tr>
                    <th onclick="sortTable(0)">Supplier ID</th>
                    <th onclick="sortTable(1)">Name</th>
                    <th onclick="sortTable(2)">Email</th>
                    <th onclick="sortTable(3)">Telephone</th>
                    <th onclick="sortTable(4)">BRN</th>
                    <th onclick="sortTable(5)">Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-section__tbody">
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        function updateTable() {
                            fetch('<?php echo ROOT ?>/fetch/suppliers')
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                    let table = document.getElementById('suppliers_table');
                                    // Clear existing table rows
                                    while (table.rows.length > 1) {
                                        table.deleteRow(1);
                                    }
                                    // Insert new rows with updated data
                                    data.forEach(item => {
                                        let row = table.insertRow();
                                        let supplier_id = "SUP-" + String(item.supplier_id).padStart(3, '0');
                                        let name = item.name;
                                        let email = item.email;
                                        let telephone = item.telephone;
                                        let brn = item.brn;
                                        let address = item.address_line_1 + ',<br>' + item.address_line_2 + ',<br>' + item.city + '.<br>' + item.zip_code;

                                        row.insertCell().innerHTML = supplier_id;
                                        row.insertCell().innerHTML = name;
                                        row.insertCell().innerHTML = email;
                                        row.insertCell().innerHTML = telephone;
                                        row.insertCell().innerHTML = brn;
                                        row.insertCell().innerHTML = address;


                                        row.insertCell().innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${item.supplier_id})">Update</a><a class="table-section__button table-section__button-del" onclick="openDeletePopup(${item.supplier_id})">Delete</a>`;

                                    });
                                })
                                .catch(error => console.error(error));
                        }

                        // Initial table update
                        updateTable();

                        // Schedule periodic table updates
                        // setInterval(updateTable, 5000); // Update every 5 seconds
                    });
                </script>
            </tbody>
        </table>
    </div>

    <div class="popup-form" id="delete-item-popup">
        <div class="popup-form__content">
            <form action="" method="POST" class="form">
                <!-- <h2 class="popup-form-title">Delete Item</h2> -->
                <!-- <p>Are you sure you want to delete this item?</p> -->
                <p class="confirmation-text">Are you sure you want to delete </p>

                <div class="form-group frm-btns">
                    <button type="submit" class="form-btn submit-btn">Yes</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        openDeletePopup = (id) => {
            const popup = document.getElementById('delete-item-popup');
            const confirmationText = document.querySelector('.confirmation-text');
            x = "SUP-" + String(id).padStart(3, '0');
            confirmationText.innerHTML += "Supplier ID: " + x + "?";
            popup.classList.add('popup-form--open');
            popup.querySelector('form').action = "<?php echo ROOT ?>/delete/supplier/" + id;
        }
    </script>


    <!-- Add new item popup form -->
    <div class="popup-form" id="add-item-popup">
        <div class="popup-form__content">
            <form action="<?php echo ROOT ?>/add/supplier" method="POST" class="form">
                <h2 class="popup-form-title">Add New Supplier</h2>

                <!-- supplier_id	name	email	telephone	brn	address_id	created_at	updated_at -->

                <?php if (!empty($errors['name'])) : ?>
                    <p class="validate-mzg"><?= $errors['name'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name" class="form-label label-popup">Name</label>
                    <input value="<?php echo $form_data['name'] ?>" type="text" id="name" name="name" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['email'])) : ?>
                    <p class="validate-mzg"><?= $errors['email'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="email" class="form-label label-popup">Email</label>
                    <input value="<?php echo $form_data['email'] ?>" type="text" id="email" name="email" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['telephone'])) : ?>
                    <p class="validate-mzg"><?= $errors['telephone'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="telephone" class="form-label label-popup">Telephone</label>
                    <input value="<?php echo $form_data['telephone'] ?>" type="text" id="telephone" name="telephone" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['brn'])) : ?>
                    <p class="validate-mzg"><?= $errors['brn'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="brn" class="form-label label-popup">BRN</label>
                    <input value="<?php echo $form_data['brn'] ?>" type="text" id="brn" name="brn" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['address_line_1'])) : ?>
                    <p class="validate-mzg"><?= $errors['address_line_1'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="address_line_1" class="form-label label-popup">Address Line 1</label>
                    <input value="<?php echo $form_data['address_line_1'] ?>" type="text" id="address_line_1" name="address_line_1" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['address_line_2'])) : ?>
                    <p class="validate-mzg"><?= $errors['address_line_2'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="address_line_2" class="form-label label-popup">Address Line 2</label>
                    <input value="<?php echo $form_data['address_line_2'] ?>" type="text" id="address_line_2" name="address_line_2" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['city'])) : ?>
                    <p class="validate-mzg"><?= $errors['city'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="city" class="form-label label-popup">City</label>
                    <input value="<?php echo $form_data['city'] ?>" type="text" id="city" name="city" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['zip_code'])) : ?>
                    <p class="validate-mzg"><?= $errors['zip_code'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="zip_code" class="form-label label-popup">Zip Code</label>
                    <input value="<?php echo $form_data['zip_code'] ?>" type="text" id="zip_code" name="zip_code" class="form-input input-popup">
                </div>

                <div class="form-group form-btns">
                    <button type="submit" class="form-btn submit-btn">Add New Supplier</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Update item popup form -->
    <div class="popup-form" id="update-item-popup">
        <div class="popup-form__content">
            <form action="<?php echo ROOT ?>/update/supplier" method="POST" class="form">
                <h2 class="popup-form-title" id="update_title">Update Supplier</h2>

                <?php if (!empty($errors['name'])) : ?>
                    <p class="validate-mzg"><?= $errors['name'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name" class="form-label label-popup">Name</label>
                    <input value="<?php echo $form_data['name'] ?>" type="text" id="name-upd" name="name" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['email'])) : ?>
                    <p class="validate-mzg"><?= $errors['email'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="email" class="form-label label-popup">Email</label>
                    <input value="<?php echo $form_data['email'] ?>" type="text" id="email-upd" name="email" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['telephone'])) : ?>
                    <p class="validate-mzg"><?= $errors['telephone'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="telephone" class="form-label label-popup">Telephone</label>
                    <input value="<?php echo $form_data['telephone'] ?>" type="text" id="telephone-upd" name="telephone" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['brn'])) : ?>
                    <p class="validate-mzg"><?= $errors['brn'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="brn" class="form-label label-popup">BRN</label>
                    <input value="<?php echo $form_data['brn'] ?>" type="text" id="brn-upd" name="brn" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['address_line_1'])) : ?>
                    <p class="validate-mzg"><?= $errors['address_line_1'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="address_line_1" class="form-label label-popup">Address Line 1</label>
                    <input value="<?php echo $form_data['address_line_1'] ?>" type="text" id="address_line_1-upd" name="address_line_1" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['address_line_2'])) : ?>
                    <p class="validate-mzg"><?= $errors['address_line_2'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="address_line_2" class="form-label label-popup">Address Line 2</label>
                    <input value="<?php echo $form_data['address_line_2'] ?>" type="text" id="address_line_2-upd" name="address_line_2" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['city'])) : ?>
                    <p class="validate-mzg"><?= $errors['city'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="city" class="form-label label-popup">City</label>
                    <input value="<?php echo $form_data['city'] ?>" type="text" id="city-upd" name="city" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['zip_code'])) : ?>
                    <p class="validate-mzg"><?= $errors['zip_code'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="zip_code" class="form-label label-popup">Zip Code</label>
                    <input value="<?php echo $form_data['zip_code'] ?>" type="text" id="zip_code-upd" name="zip_code" class="form-input input-popup">
                </div>

                <div class="form-group form-btns">
                    <button type="submit" class="form-btn submit-btn">Update Supplier</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        openUpdatePopup = (id) => {
            sessionStorage.setItem('supplier_id', id);

            const popupTitle = document.getElementById('update_title');
            popupTitle.innerHTML = "Update Supplier (ID: SUP-" + String(id).padStart(3, '0') + ")";

            const popup = document.getElementById('update-item-popup');

            // fetch data from database as json
            fetch('<?php echo ROOT ?>/fetch/suppliers/' + id)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // populate the update form with the data 
                    document.getElementById('name-upd').value = data.name;
                    document.getElementById('email-upd').value = data.email;
                    document.getElementById('telephone-upd').value = data.telephone;
                    document.getElementById('brn-upd').value = data.brn;
                    document.getElementById('address_line_1-upd').value = data.address_line_1;
                    document.getElementById('address_line_2-upd').value = data.address_line_2;
                    document.getElementById('city-upd').value = data.city;
                    document.getElementById('zip_code-upd').value = data.zip_code;

                    // document.getElementById('zip_code_update').disabled = true;
                })
                .catch(error => console.error(error));
            popup.classList.add('popup-form--open');
            popup.querySelector('form').action = "<?php echo ROOT ?>/update/supplier/" + id;
        }
    </script>






    <!-- <button onclick="openPopup('delete-item-popup')">Delete Item</button> -->

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

            confirmText.innerHTML = "Are you sure you want to delete ";
            // Clear validation messages
            const validationMessages = document.querySelectorAll('.validate-mzg');
            validationMessages.forEach(message => {
                message.innerHTML = '';
            });

            // Session storage
            sessionStorage.removeItem('worker_id');

        }
    </script>

    <script>
        <?php if (!empty($errors)) : ?>
            if ('<?php echo $form_id; ?>' === 'form1') {
                openPopup('add-item-popup');
            } else if ('<?php echo $form_id; ?>' === 'form2') {
                // code to open your second popup goes here
                supplier_id = sessionStorage.getItem('supplier_id');
                openUpdatePopup(supplier_id);
                //print id
            }
        <?php endif; ?>
    </script>

</div>

<script>
    document.getElementById('searchSuppliers').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('searchSuppliers');
        filter = input.value.toUpperCase();
        table = document.getElementById('suppliers_table');
        tr = table.getElementsByTagName('tr');

        for (i = 0; i < tr.length; i++) {
            var idTd = tr[i].getElementsByTagName('td')[0];
            var nameTd = tr[i].getElementsByTagName('td')[1];

            if (idTd || nameTd) {
                var idTxtValue = idTd ? idTd.textContent || idTd.innerText : '';
                var nameTxtValue = nameTd ? nameTd.textContent || nameTd.innerText : '';

                if (idTxtValue.toUpperCase().indexOf(filter) > -1 || nameTxtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    });


    // Keep track of the current sort direction for each column
    var sortDirections = Array.from(document.getElementsByTagName('th')).map(() => 'asc');

    function sortTable(n) {
        var table = document.getElementById("suppliers_table");
        var rows = Array.from(table.rows).slice(1); // Get all rows, excluding the header

        // Sort rows based on the content of the nth column
        rows.sort((rowA, rowB) => {
            var textA = rowA.cells[n].textContent;
            var textB = rowB.cells[n].textContent;

            // If the content of the cells are numbers, convert them
            if (!isNaN(textA) && !isNaN(textB)) {
                textA = Number(textA);
                textB = Number(textB);
            }

            return (textA < textB ? -1 : (textA > textB ? 1 : 0)) * (sortDirections[n] === 'asc' ? 1 : -1);
        });

        // Reverse sort direction
        sortDirections[n] = sortDirections[n] === 'asc' ? 'desc' : 'asc';

        // Remove all rows from the table, then append the sorted rows
        for (var i = table.rows.length - 1; i > 0; i--) {
            table.deleteRow(i);
        }
        for (var row of rows) {
            table.appendChild(row);
        }
    }
</script>


<?php include "inc/footer.view.php"; ?>