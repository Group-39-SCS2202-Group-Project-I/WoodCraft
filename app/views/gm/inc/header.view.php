<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <!-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script> -->
    <title>WoodCraft Furniture - General Manager</title>
    <link rel="shortcut icon" href="<?php echo ROOT ?>/assets/logo/favicon.ico" type="image/x-icon">
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
                <span style="padding-right:5px">General Manager</span>
                <span class="material-symbols-outlined">
                    account_circle
                </span>
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
                <li class="sidebar-list-item nav-btn selected def-selected" id="dash-nav">
                    <a>
                        <span class="material-icons-outlined">dashboard</span><span style="margin-left: 5px;">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-list-item nav-btn" id="production-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            event_seat
                        </span>
                        <span style="margin-left: 5px;">Productions</span>
                    </a>
                </li>
                <li class="sidebar-list-item nav-btn" id="bulk-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            order_play
                        </span>
                        <span style="margin-left: 5px;">Bulk Order Requests</span>
                    </a>
                </li>

                <li class="sidebar-list-item nav-btn" id="orders-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            order_approve
                        </span>
                        <span style="margin-left: 5px;">Orders</span>
                    </a>
                </li>

                <li class="sidebar-list-item nav-btn" id="workers-nav">
                    <a>
                        <span class="material-icons-outlined">engineering</span>
                        <span style="margin-left: 5px;">Workers</span>
                    </a>
                </li>

            </ul>

            <li class="sidebar-list-item sidebar-logout" id="logoutBtn">
                <a>
                    <span class="material-icons-outlined">logout</span><span style="margin-left: 5px;">Logout</span>
                </a>
            </li>

            <script>
                const dashNav = document.getElementById('dash-nav');
                const productionsNav = document.getElementById('products-nav');
                const ordersNav = document.getElementById('orders-nav');
                const workersNav = document.getElementById('workers-nav');




                // Add event listener to the parent element
                document.querySelector('.sidebar-list').addEventListener('click', (event) => {
                    const target = event.target;
                    const id = target.closest('.sidebar-list-item').id;

                    // Handle different menu items based on their IDs
                    switch (id) {
                        case 'dash-nav':
                            window.location.href = '<?= ROOT ?>/gm/dashboard';
                            break;
                        case 'production-nav':
                            window.location.href = '<?= ROOT ?>/gm/productions';
                            break;
                        case 'orders-nav':
                            window.location.href = '<?= ROOT ?>/gm/orders';
                            break;
                        case 'workers-nav':
                            window.location.href = '<?= ROOT ?>/gm/workers';
                            break;
                        case 'bulk-nav':
                            window.location.href = '<?= ROOT ?>/gm/bulk_order_requests';
                            break;

                        default:
                            break;
                    }
                });
            </script>
            </ul>

            <script>
                const listItems = document.querySelectorAll('.nav-btn');

                listItems.forEach(item => {
                    item.addEventListener('click', () => {
                        listItems.forEach(item => item.classList.remove('selected'));
                        item.classList.add('selected');
                        sessionStorage.setItem('selectedItem', item.id);
                    });
                });

                const selectedItem = sessionStorage.getItem('selectedItem');
                if (selectedItem) {
                    const selectedSidebarItem = document.getElementById(selectedItem);
                    if (selectedSidebarItem) {
                        selectedSidebarItem.classList.add('selected');
                        //remove selected from all other items
                        listItems.forEach(item => {
                            if (item.id !== selectedItem) {
                                item.classList.remove('selected');
                            }
                        });
                    }

                }


                const logoutBtn = document.getElementById('logoutBtn');
                logoutBtn.addEventListener('click', () => {
                    window.location.href = '<?= ROOT ?>/logout';
                    for (let i = 0; i < sessionStorage.length; i++) {
                        const key = sessionStorage.key(i);
                        sessionStorage.removeItem(key);
                    }

                    const defaultSelected = document.querySelector('.def-selected');
                    defaultSelected.classList.add('selected');

                });
            </script>
        </aside>
        <!-- End Sidebar -->

        <!-- Main -->
        <main class="main-container">