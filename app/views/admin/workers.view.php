<?php include "inc/header.view.php"; ?>

<div class="table-section">
    <h2 class="table-section__title">Workers</h2>

    <div class="table-section__add">
        <a href="#" class="table-section__add-link" onclick="openPopup('add-item-popup')">Add A Worker</a>
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

                                    row.insertCell().innerHTML = `<a href="<?php echo ROOT ?>/admin/workers/${item.worker_id}">View</a> | <a href="<?php echo ROOT ?>/delete/workers/${item.worker_id}">Delete</a>`;

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


    <!-- Add new item popup form -->
    <div class="popup-form" id="add-item-popup">
        <div class="popup-form__content">
            <form action="#" method="POST" class="form">
                <h2 class="popup-form-title">Add New Item</h2>
                <div class="form-group">
                    <label for="item-name" class="form-label label-popup">Item Name</label>
                    <input type="text" id="item-name" name="item-name" class="form-input input-popup" required>
                </div>
                <div class="form-group">
                    <label for="item-image" class="form-label label-popup">Item Image</label>
                    <input type="file" id="item-image" name="item-image" class="form-input input-popup" required>
                </div>
                <div class="form-group">
                    <label for="item-category" class="form-label label-popup">Item Category</label>
                    <select id="item-category" name="item-category" class="form-select input-popup" required>
                        <option value="">Select a category</option>
                        <option value="category1">Category 1</option>
                        <option value="category2">Category 2</option>
                        <option value="category3">Category 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="item-price" class="form-label label-popup">Item Price</label>
                    <input type="number" id="item-price" name="item-price" class="form-input input-popup" required>
                </div>
                <div class="form-group">
                    <label for="item-details" class="form-label label-popup">Item Details</label>
                    <textarea id="item-details" name="item-details" class="form-textarea input-popup" required></textarea>
                </div>
                <div class="form-group form-btns">
                    <button type="submit" class="form-btn submit-btn">Add Item</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Update item popup form -->


    <!-- Delete item popup form -->
    <!-- Delete item popup form -->
    <div class="popup-form" id="delete-item-popup">
        <div class="popup-form__content">
            <form action="#" method="POST" class="form">
                <!-- <h2 class="popup-form-title">Delete Item</h2> -->
                <p>Are you sure you want to delete this item?</p>

                <div class="form-group frm-btns">
                    <button type="submit" class="form-btn submit-btn">Yes</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
                </div>
            </form>
        </div>
    </div>

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
            popups.forEach(popup => {
                popup.classList.remove('popup-form--open');
            });
        }
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