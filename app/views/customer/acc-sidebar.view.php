    <div class="grid-container">

        <?php
        // check if a page is the current page
        function isCurrentPage($pageName) {
            return strpos($_SERVER['REQUEST_URI'], $pageName) !== false;
        }
        ?>
    
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand"><span class="material-icons-outlined" style="font-size: 36px; padding-right:5px">living </span> WoodCraft
                </div>
                <!-- <span class="material-icons-outlined" onclick="closeSidebar()">close</span> -->
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item nav-btn main-title  <?= isCurrentPage('index') ? 'selected' : '' ?>" id="manage-nav">
                    <a href="<?=ROOT?>/customer/index/<?= Auth::getCustomerId()?>"><span style="margin-left: 5px;">Manage My Account</span></a>

                        <li class="sidebar-list-item nav-btn sub-title <?= isCurrentPage('profile') || isCurrentPage('edit') || isCurrentPage('changepassword') ? 'selected' : '' ?>" id="profile-nav">
                            <a href="<?=ROOT?>/customer/profile/<?= Auth::getCustomerId()?>"><span style="margin-left: 35px;">My Profile</span></a>
                        </li>
                        <li class="sidebar-list-item nav-btn sub-title <?= isCurrentPage('addressbook') || isCurrentPage('address') || isCurrentPage('addaddress') ? 'selected' : '' ?>" id="address-nav">
                            <a href="<?=ROOT?>/customer/addressbook/<?= Auth::getCustomerId()?>"><span style="margin-left: 35px;">Address Book</span></a>
                        </li>
                </li>
                <li class="sidebar-list-item nav-btn main-title <?= isCurrentPage('orders') ? 'selected' : '' ?>" id="orders-nav">
                    <a href="<?=ROOT?>/customer/orders/<?= Auth::getCustomerId()?>"><span style="margin-left: 5px;">My Orders</span></a>

                        <!-- <li class="sidebar-list-item nav-btn sub-title" id="returns-nav">
                            <a id="toreturns"><span style="margin-left: 35px;">My Returns</span></a>
                        </li>
                        <li class="sidebar-list-item nav-btn sub-title" id="cancellation-nav">
                            <a id="tocancellations"><span style="margin-left: 35px;">My Cancellations</span></a>
                        </li> -->
                </li>
                <!-- <li class="sidebar-list-item nav-btn main-title <?= isCurrentPage('wishlist') ? 'selected' : '' ?>" id="wishlist-nav">
                    <a href="<?=ROOT?>/customer/wishlist/<?= Auth::getCustomerId()?>"><span style="margin-left: 5px;">My Wishlist</span></a>
                </li> -->
                <!-- <li class="sidebar-list-item nav-btn main-title" id="reviews-nav">
                    <a id="toreviews"><span style="margin-left: 5px;">My Reviews</span></a>
                </li>-->
           
                <li class="sidebar-list-item sidebar-logout" id="logoutBtn">
                    <a href="<?=ROOT?>/<?= Auth::getCustomerId()?>"><span class="material-icons-outlined">logout</span><span style="margin-left: 5px;">Logout</span></a>
                </li>
            </ul>
        </aside>

    <script>
        document.querySelector('.sidebar-list').addEventListener('click', (event) => {
            const clickedItem = event.target.closest('.nav-btn');
            if (clickedItem) {
                // Remove 'selected' class from all items
                document.querySelectorAll('.nav-btn').forEach(item => item.classList.remove('selected'));
                // Add 'selected' class to the clicked item
                clickedItem.classList.add('selected');

                // Navigate to the corresponding page
                const link = clickedItem.querySelector('a');
                if (link) {
                    window.location.href = link.getAttribute('href');
                }
            }
        });
    </script>
