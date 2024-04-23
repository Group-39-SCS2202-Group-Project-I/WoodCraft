<?php
// show($_SESSION);
if (isset($_SESSION['USER_DATA'])) {
    $role = $_SESSION['USER_DATA']->role;
    // show($role);
    if ($role != 'admin' && $role != 'customer') {
        $db = new Database;
        $staff = $db->select('staff', 'user_id = ' . $_SESSION['USER_DATA']->user_id);
        // show($staff);
        $staffID = $staff[0]->staff_id;

        $staffID = "(STF-" . str_pad($staffID, 3, '0', STR_PAD_LEFT) . ")";
    } else {
        $staffID = '';
    }
} else {
    $staffID = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title>WoodCraft Furniture - Stock Keeper</title>
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
                <span style="padding-right:5px">Stock Keeper <?php echo $staffID ?> </span>
                <span class="material-icons-outlined">
                    engineering
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
                <li class="sidebar-list-item nav-btn" id="materials-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            service_toolbox
                        </span><span style="margin-left: 5px;">Material Stock</span>
                    </a>
                </li>

                <li class="sidebar-list-item nav-btn" id="products-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            shelves
                        </span><span style="margin-left: 5px;">Product Stock</span>
                    </a>
                </li>



                <li class="sidebar-list-item nav-btn" id="mat_req-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            hardware
                        </span><span style="margin-left: 5px;">Material Requests</span>
                    </a>
                </li>



                <li class="sidebar-list-item nav-btn" id="mat_ord-nav">
                    <a>
                        <span class="material-icons-outlined">receipt_long</span><span style="margin-left: 5px;">Received Material Orders</span>
                    </a>
                </li>



                <li class="sidebar-list-item nav-btn" id="fin_prod-nav">
                    <a>
                        <span class="material-icons-outlined">inventory</span><span style="margin-left: 5px;">Finished Productions</span>
                    </a>
                </li>

                <li class="sidebar-list-item nav-btn" id="orders-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            order_approve
                        </span><span style="margin-left: 5px;">Orders</span>
                    </a>
                </li>

                <li class="sidebar-list-item nav-btn" id="sup-nav">
                    <a>
                        <span class="material-symbols-outlined">
                            conveyor_belt
                        </span><span style="margin-left: 5px;">Suppliers</span>
                    </a>
                </li>


                <li class="sidebar-list-item sidebar-logout" id="logoutBtn">
                    <a>
                        <span class="material-icons-outlined">logout</span><span style="margin-left: 5px;">Logout</span>
                    </a>
                </li>



                <script>
                    const dashNav = document.getElementById('dash-nav');
                    const matReqNav = document.getElementById('mat_req-nav');
                    const materialsNav = document.getElementById('materials-nav');
                    const productsNav = document.getElementById('products-nav');
                    const finProdNav = document.getElementById('fin_prod-nav');
                    const ordersNav = document.getElementById('orders-nav');
                    const supNav = document.getElementById('sup-nav');
                    const ReceivedMatOrdersNav = document.getElementById('mat_ord-nav');



                    // Add event listener to the parent element
                    document.querySelector('.sidebar-list').addEventListener('click', (event) => {
                        const target = event.target;
                        const id = target.closest('.sidebar-list-item').id;

                        // Handle different menu items based on their IDs
                        switch (id) {

                            case 'dash-nav':
                                window.location.href = '<?= ROOT ?>/sk/dashboard';
                                break;
                            case 'materials-nav':
                                window.location.href = '<?= ROOT ?>/sk/materials';
                                break;
                            case 'products-nav':
                                window.location.href = '<?= ROOT ?>/sk/products';
                                break;
                            case 'mat_req-nav':
                                window.location.href = '<?= ROOT ?>/sk/material_requests';
                                break;

                            case 'mat_ord-nav':
                                window.location.href = '<?= ROOT ?>/sk/material_orders';
                                break;

                            case 'fin_prod-nav':
                                window.location.href = '<?= ROOT ?>/sk/finished_productions';
                                break;
                            case 'orders-nav':
                                window.location.href = '<?= ROOT ?>/sk/orders';
                                break;
                            case 'sup-nav':
                                window.location.href = '<?= ROOT ?>/sk/suppliers';
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