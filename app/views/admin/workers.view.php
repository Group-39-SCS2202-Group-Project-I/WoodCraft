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

    <h2 class="table-section__title">Workers</h2>

    <div class="table-section__add">
        <a href="#" class="table-section__add-link" onclick="openPopup('add-item-popup')">Add New Worker</a>
    </div>

    <div class="table-section__search">
        <input type="text" id="search" placeholder="Search..." class="table-section__search-input">
    </div>


    <table class="table-section__table" id="workers_table">
        <!-- worker_id	first_name	last_name	mobile_number	address_id	availability	created_at	updated_at	deleted_at	 -->
        <thead>
            <tr>
                <th>Worker ID</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Address</th>
                <th>Availability</th>
                <th>Date Added</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function updateTable() {
                        fetch('<?php echo ROOT ?>/fetch/workers')
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);
                                let table = document.getElementById('workers_table');
                                // Clear existing table rows
                                while (table.rows.length > 1) {
                                    table.deleteRow(1);
                                }
                                // Insert new rows with updated data
                                data.forEach(item => {
                                    let row = table.insertRow();
                                    let worker_id = "WRK-" + String(item.worker_id).padStart(3, '0');
                                    let name = item.first_name + ' ' + item.last_name;
                                    item.first_name = item.first_name.charAt(0).toUpperCase() + item.first_name.slice(1).toLowerCase();
                                    item.last_name = item.last_name.charAt(0).toUpperCase() + item.last_name.slice(1).toLowerCase();
                                    name = item.first_name + ' ' + item.last_name;
                                    let mobile_number = item.mobile_number;
                                    let address = item.address_line_1 + ',<br>' + item.address_line_2 + ',<br>' + item.city + '.<br>' + item.zip_code;
                                    let availability = item.availability;
                                    availability = availability.charAt(0).toUpperCase() + availability.slice(1);
                                    let date_added = item.created_at;

                                    row.insertCell().innerHTML = worker_id;
                                    row.insertCell().innerHTML = name;
                                    row.insertCell().innerHTML = mobile_number;
                                    row.insertCell().innerHTML = address;
                                    row.insertCell().innerHTML = availability;
                                    row.insertCell().innerHTML = date_added;

                                    row.insertCell().innerHTML = `<a class="table-section__button" onclick="openUpdatePopup(${item.worker_id})">Update</a><a class="table-section__button table-section__button-del" onclick="openDeletePopup(${item.worker_id})">Delete</a>`;

                                });
                            })
                            .catch(error => console.error(error));
                    }

                    // Initial table update
                    updateTable();

                    // Schedule periodic table updates
                    setInterval(updateTable, 5000); // Update every 5 seconds
                });
            </script>
        </tbody>
    </table>

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
            x = "WRK-" + String(id).padStart(3, '0');
            confirmationText.innerHTML += "Worker ID: " + x + "?";
            popup.classList.add('popup-form--open');
            popup.querySelector('form').action = "<?php echo ROOT ?>/delete/workers/" + id;
        }
    </script>


    <!-- Add new item popup form -->
    <div class="popup-form" id="add-item-popup">
        <div class="popup-form__content">
            <form action="<?php echo ROOT ?>/add/workers" method="POST" class="form">
                <h2 class="popup-form-title">Add New Worker</h2>

                <!-- first_name	last_name	mobile_number	address_line_1	address_line_2	city	zip_code -->

                <?php if (!empty($errors['first_name'])) : ?>
                    <p class="validate-mzg"><?= $errors['first_name'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="first_name" class="form-label label-popup">First Name</label>
                    <input value="<?php echo $form_data['first_name'] ?>" type="text" id="first_name" name="first_name" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['last_name'])) : ?>
                    <p class="validate-mzg"><?= $errors['last_name'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="last_name" class="form-label label-popup">Last Name</label>
                    <input value="<?php echo $form_data['last_name'] ?>" type="text" id="last_name" name="last_name" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['mobile_number'])) : ?>
                    <p class="validate-mzg"><?= $errors['mobile_number'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="mobile_number" class="form-label label-popup">Mobile Number</label>
                    <input value="<?php echo $form_data['mobile_number'] ?>" type="text" id="mobile_number" name="mobile_number" class="form-input input-popup">
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
                    <button type="submit" class="form-btn submit-btn">Add New Worker</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Update item popup form -->
    <div class="popup-form" id="update-item-popup">
        <div class="popup-form__content">
            <form action="<?php echo ROOT ?>/update/workers" method="POST" class="form">
                <h2 class="popup-form-title" id="update_title">Update Worker</h2>

                <?php if (!empty($errors['first_name'])) : ?>
                    <p class="validate-mzg"><?= $errors['first_name'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="first_name" class="form-label label-popup">First Name</label>
                    <input value="<?php echo $form_data['first_name'] ?>" type="text" id="first_name_update" name="first_name" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['last_name'])) : ?>
                    <p class="validate-mzg"><?= $errors['last_name'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="last_name" class="form-label label-popup">Last Name</label>
                    <input value="<?php echo $form_data['last_name'] ?>" type="text" id="last_name_update" name="last_name" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['mobile_number'])) : ?>
                    <p class="validate-mzg"><?= $errors['mobile_number'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="mobile_number" class="form-label label-popup">Mobile Number</label>
                    <input value="<?php echo $form_data['mobile_number'] ?>" type="text" id="mobile_number_update" name="mobile_number" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['address_line_1'])) : ?>
                    <p class="validate-mzg"><?= $errors['address_line_1'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="address_line_1" class="form-label label-popup">Address Line 1</label>
                    <input value="<?php echo $form_data['address_line_1'] ?>" type="text" id="address_line_1_update" name="address_line_1" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['address_line_2'])) : ?>
                    <p class="validate-mzg"><?= $errors['address_line_2'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="address_line_2" class="form-label label-popup">Address Line 2</label>
                    <input value="<?php echo $form_data['address_line_2'] ?>" type="text" id="address_line_2_update" name="address_line_2" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['city'])) : ?>
                    <p class="validate-mzg"><?= $errors['city'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="city" class="form-label label-popup">City</label>
                    <input value="<?php echo $form_data['city'] ?>" type="text" id="city_update" name="city" class="form-input input-popup">
                </div>

                <?php if (!empty($errors['zip_code'])) : ?>
                    <p class="validate-mzg"><?= $errors['zip_code'] ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="zip_code" class="form-label label-popup">Zip Code</label>
                    <input value="<?php echo $form_data['zip_code'] ?>" type="text" id="zip_code_update" name="zip_code" class="form-input input-popup">
                </div>

                <div class="form-group form-btns">
                    <button type="submit" class="form-btn submit-btn">Update Worker</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        openUpdatePopup = (id) => {
            const popupTitle = document.getElementById('update_title');
            popupTitle.innerHTML = "Update Worker (ID: WRK-" + String(id).padStart(3, '0') + ")";

            const popup = document.getElementById('update-item-popup');

            // fetch data from database as json
            fetch('<?php echo ROOT ?>/fetch/workers/' + id)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // populate the update form with the data 
                    document.getElementById('first_name_update').value = data.first_name;
                    document.getElementById('last_name_update').value = data.last_name;
                    document.getElementById('mobile_number_update').value = data.mobile_number;
                    document.getElementById('address_line_1_update').value = data.address_line_1;
                    document.getElementById('address_line_2_update').value = data.address_line_2;
                    document.getElementById('city_update').value = data.city;
                    document.getElementById('zip_code_update').value = data.zip_code;
                })
                .catch(error => console.error(error));
            popup.classList.add('popup-form--open');
            popup.querySelector('form').action = "<?php echo ROOT ?>/update/workers/" + id;
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
            confirmText.innerHTML = "Are you sure you want to delete ";
            popups.forEach(popup => {
                popup.classList.remove('popup-form--open');
            });
        }
    </script>

    <script>
        <?php if (!empty($errors)) : ?>
            if ('<?php echo $form_id; ?>' === 'form1') {
                openPopup('add-item-popup');
            } else if ('<?php echo $form_id; ?>' === 'form2') {
                // code to open your second popup goes here
                openPopup('update-item-popup');
            }
        <?php endif; ?>
    </script>

</div>

<script>
    const searchInput = document.querySelector('#search');
    const tableRows = document.querySelectorAll('#table-section__tbody tr');
    const tableHeaders = document.querySelectorAll('.table-section__table th');

    let sortColumn = null;
    let sortDirection = 'asc';

    function sortTable(column) {
        const rows = Array.from(tableRows);

        rows.sort((a, b) => {
            const aValue = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
            const bValue = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim();

            if (aValue < bValue) {
                return sortDirection === 'asc' ? -1 : 1;
            } else if (aValue > bValue) {
                return sortDirection === 'asc' ? 1 : -1;
            } else {
                return 0;
            }
        });

        rows.forEach(row => {
            document.querySelector('#table-section__tbody').appendChild(row);
        });
    }

    tableHeaders.forEach((header, index) => {
        header.addEventListener('click', () => {
            if (sortColumn === index) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = index;
                sortDirection = 'asc';
            }

            sortTable(sortColumn);
        });
    });

    searchInput.addEventListener('keyup', function(event) {
        const searchTerm = event.target.value.toLowerCase();

        tableRows.forEach(function(row) {
            const itemName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const itemId = row.querySelector('td:nth-child(1)').textContent.toLowerCase();

            if (itemName.includes(searchTerm) || itemId.includes(searchTerm)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

<?php include "inc/footer.view.php"; ?>