<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title>WoodCraft Furniture - Admin</title>
</head>

<body>

    <div class="grid-container">

        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <!-- <span class="material-icons-outlined">search</span> -->
            </div>
            <div class="header-right" style="display: flex; align-items: center; justify-content: center;">
                <!-- <span class="material-icons-outlined">notifications</span>
          <span class="material-icons-outlined">email</span> -->
                <span style="padding-right:5px">Admin </span>
                <span class="material-icons-outlined">manage_accounts</span>
            </div>
        </header>

        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined" style="font-size: 36px; padding-right:5px"> living </span> WoodCraft
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item selected">
                    <a href="#">
                        <span class="material-icons-outlined">dashboard</span><span style="margin-left: 5px;">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">chair</span>
                        <span style="margin-left: 5px;">Products</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">people</span> <span style="margin-left: 5px;">Customers</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">engineering</span> <span style="margin-left: 5px;">Workers</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">supervised_user_circle</span> <span style="margin-left: 5px;">Staff Members</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#">
                        <span class="material-icons-outlined">local_shipping</span><span style="margin-left: 5px;">Delivery</span>
                    </a>
                </li>
                <!-- <li class="sidebar-list-item">
                <a href="#" >
                    <span class="material-icons-outlined">poll</span> Reports
                </a>
            </li>
            <li class="sidebar-list-item">
                <a href="#" >
                    <span class="material-icons-outlined">settings</span> Settings
                </a>
            </li> -->
                <li class="sidebar-list-item sidebar-logout" id="logoutBtn">
                    <a>
                        <span class="material-icons-outlined">logout</span><span style="margin-left: 5px;">Logout</span>
                    </a>
                </li>

                <script>
                     const logoutBtn = document.getElementById('logoutBtn');
                                logoutBtn.addEventListener('click', () => {
                                    window.location.href = '<?=ROOT?>/login';  
                                });
                </script>
            </ul>




            <script>
                const listItems = document.querySelectorAll('.sidebar-list-item');

                listItems.forEach(item => {
                    item.addEventListener('click', () => {
                        listItems.forEach(item => item.classList.remove('selected'));
                        item.classList.add('selected');
                    });
                });
            </script>
        </aside>
        <!-- End Sidebar -->

        <!-- Main -->
        <main class="main-container">

            <div class="table-section">
                <h2 class="table-section__title">Table Section</h2>

                <div class="table-section__add" onclick="openPopup('add-item-popup')">
                    <a href="#" class="table-section__add-link">Add New Item</a>
                </div>

                <div class="table-section__search">
                    <input type="text" id="search" placeholder="Search..." class="table-section__search-input">
                </div>


                <table class="table-section__table">
                    <thead>
                        <tr>
                            <th data-column="id">ID</th>
                            <th data-column="name">Name</th>
                            <th data-column="images">Images</th>
                            <th data-column="category">Category</th>
                            <th data-column="price">Price</th>
                            <th data-column="details">Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-section__tbody">
                        <tr>
                            <td>1</td>
                            <td>Item 1</td>
                            <td><img src="item1.jpg" alt="Item 1"></td>
                            <td>Category 1</td>
                            <td>$10.00</td>
                            <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                            <td>
                                <a href="#" class="table-section__button">View</a>
                                <a href="#" class="table-section__button">Update</a>
                                <a href="#" class="table-section__button table-section__button-del ">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Item 1</td>
                            <td><img src="item1.jpg" alt="Item 1"></td>
                            <td>Category 1</td>
                            <td>$10.00</td>
                            <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                            <td>
                                <a href="#" class="table-section__button">View</a>
                                <a href="#" class="table-section__button">Update</a>
                                <a href="#" class="table-section__button table-section__button-del">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Item 1</td>
                            <td><img src="item1.jpg" alt="Item 1"></td>
                            <td>Category 1</td>
                            <td>$10.00</td>
                            <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                            <td>
                                <a href="#" class="table-section__button">View</a>
                                <a href="#" class="table-section__button">Update</a>
                                <a href="#" class="table-section__button table-section__button-del">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Item 1</td>
                            <td><img src="item1.jpg" alt="Item 1"></td>
                            <td>Category 1</td>
                            <td>$10.00</td>
                            <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                            <td>
                                <a href="#" class="table-section__button">View</a>
                                <a href="#" class="table-section__button">Update</a>
                                <a href="#" class="table-section__button table-section__button-del">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Item 2</td>
                            <td><img src="item2.jpg" alt="Item 2"></td>
                            <td>Category 2</td>
                            <td>$20.00</td>
                            <td>Material: Metal<br>Weight: 2kg<br>Dimensions: 20x20x20cm</td>
                            <td>
                                <a href="#" class="table-section__button">View</a>
                                <a href="#" class="table-section__button">Update</a>
                                <a href="#" class="table-section__button table-section__button-del">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Item 3</td>
                            <td><img src="item3.jpg" alt="Item 3"></td>
                            <td>Category 3</td>
                            <td>$30.00</td>
                            <td>Material: Plastic<br>Weight: 3kg<br>Dimensions: 30x30x30cm</td>
                            <td>
                                <a href="#" class="table-section__button">View</a>
                                <a href="#" class="table-section__button">Update</a>
                                <a href="#" class="table-section__button table-section__button-del">Delete</a>
                            </td>
                        </tr>
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

                <button onclick="openPopup('delete-item-popup')">Delete Item</button>





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

        </main>
        <script>
            // SIDEBAR TOGGLE

            let sidebarOpen = false;
            const sidebar = document.getElementById('sidebar');

            function openSidebar() {
                if (!sidebarOpen) {
                    sidebar.classList.add('sidebar-responsive');
                    sidebarOpen = true;
                }
            }

            function closeSidebar() {
                if (sidebarOpen) {
                    sidebar.classList.remove('sidebar-responsive');
                    sidebarOpen = false;
                }
            }
        </script>
</body>

</html>