    <div class="grid-container">

        <?php
            // check if a page is the current page
            function isCurrentPage($pageName) {
                // Get the path part of the URL
                $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                // Check if the current path starts with the given page name
                return strncmp($currentPath, $pageName, strlen($pageName)) === 0;
            }            
        ?>
    
        <!-- Sidebar -->
        <aside id="sidebar">
            <ul class="sidebar-list">
                <li class="sidebar-list-item nav-btn main-title  <?= isCurrentPage('profile') ? 'selected' : '' ?>" id="profile-nav">
                    <a href="<?=ROOT?>/profile"><span style="margin-left: 5px;">My Profile</span></a>
                </li>
                        <li class="sidebar-list-item nav-btn sub-title <?= isCurrentPage('editProfile') ? 'selected' : '' ?>" id="editp-nav">
                            <a href="<?=ROOT?>/profile/editProfile">Edit Profile<span style="margin-left: 35px;"></span></a>
                        </li>
                        <li class="sidebar-list-item nav-btn sub-title <?= isCurrentPage('editAddress') ? 'selected' : '' ?>" id="edita-nav">
                            <a href="<?=ROOT?>/profile/editAddress">Edit Address<span style="margin-left: 35px;"></span></a>
                        </li>
                        <li class="sidebar-list-item nav-btn sub-title <?= isCurrentPage('password') ? 'selected' : '' ?>" id="password-nav">
                            <a href="<?=ROOT?>/profile/password">Change Password<span style="margin-left: 35px;"></span></a>
                        </li>
                <li class="sidebar-list-item nav-btn main-title <?= isCurrentPage('orders') ? 'selected' : '' ?>" id="orders-nav">
                    <a href="<?=ROOT?>/orders/orders"><span style="margin-left: 5px;">My Orders</span></a>
                </li>
                <li class="sidebar-list-item nav-btn main-title <?= isCurrentPage('bulkOrders') ? 'selected' : '' ?>" id="bulk-nav">
                    <a href="<?=ROOT?>/orders/bulkOrders"><span style="margin-left: 5px;">My Bulk Orders</span></a>
                </li>
                <li class="sidebar-list-item nav-btn main-title <?= isCurrentPage('review') ? 'selected' : '' ?>" id="review-nav">
                    <a href="<?=ROOT?>/review"><span style="margin-left: 5px;">My Reviews</span></a>
                </li>
           
                <!-- <li class="sidebar-list-item sidebar-logout" id="logoutBtn">
                    <a href="<?=ROOT?>/<?= Auth::getCustomerId()?>"><span class="material-icons-outlined">logout</span><span style="margin-left: 5px;">Logout</span></a>
                </li> -->
            </ul>
        </aside>

    <script>
        document.querySelector('.sidebar-list').addEventListener('click', (event) => {
            const clickedItem = event.target.closest('.nav-btn');
            console.log(clickedItem); // Check if clickedItem is correctly identified
            if (clickedItem) {
                // Remove 'selected' class from all items
                document.querySelectorAll('.nav-btn').forEach(item => item.classList.remove('selected'));
                // Add 'selected' class to the clicked item
                clickedItem.classList.add('selected');
                console.log(clickedItem.classList); // Check if 'selected' class is added
                // Navigate to the corresponding page
                const link = clickedItem.querySelector('a');
                if (link) {
                    window.location.href = link.getAttribute('href');
                }
            }
        });
    </script>
