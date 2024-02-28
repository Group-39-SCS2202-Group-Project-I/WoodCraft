    <div class="grid-container">
    
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand"><span class="material-icons-outlined" style="font-size: 36px; padding-right:5px">living </span> WoodCraft
                </div>
                <!-- <span class="material-icons-outlined" onclick="closeSidebar()">close</span> -->
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item nav-btn main-title selected def-selected" id="manage-nav">
                    <a href="<?=ROOT?>/customer/index/<?= Auth::getCustomerId()?>"><span style="margin-left: 5px;">Manage My Account</span></a>

                        <li class="sidebar-list-item nav-btn sub-title" id="profile-nav">
                            <a href="<?=ROOT?>/customer/profile/<?= Auth::getCustomerId()?>"><span style="margin-left: 35px;">My Profile</span></a>
                        </li>
                        <li class="sidebar-list-item nav-btn sub-title" id="address-nav">
                            <a href="<?=ROOT?>/customer/addressbook/<?= Auth::getCustomerId()?>"><span style="margin-left: 35px;">Address Book</span></a>
                        </li>
                </li>
                <li class="sidebar-list-item nav-btn main-title" id="orders-nav">
                    <a href="<?=ROOT?>/customer/orders/<?= Auth::getCustomerId()?>"><span style="margin-left: 5px;">My Orders</span></a>

                        <!-- <li class="sidebar-list-item nav-btn sub-title" id="returns-nav">
                            <a id="toreturns"><span style="margin-left: 35px;">My Returns</span></a>
                        </li>
                        <li class="sidebar-list-item nav-btn sub-title" id="cancellation-nav">
                            <a id="tocancellations"><span style="margin-left: 35px;">My Cancellations</span></a>
                        </li> -->
                </li>
                <!-- <li class="sidebar-list-item nav-btn main-title" id="reviews-nav">
                    <a id="toreviews"><span style="margin-left: 5px;">My Reviews</span></a>
                </li>
                <li class="sidebar-list-item nav-btn main-title" id="wishlist-nav">
                    <a id="towishlist"><span style="margin-left: 5px;">My WishList</span></a>
                </li> -->
           
                <li class="sidebar-list-item sidebar-logout" id="logoutBtn">
                    <a href="<?=ROOT?>/<?= Auth::getCustomerId()?>"><span class="material-icons-outlined">logout</span><span style="margin-left: 5px;">Logout</span></a>
                </li>

                <script>
                    const manageNav = document.getElementById('manage-nav');
                    const profileNav = document.getElementById('profile-nav');
                    const addressNav = document.getElementById('address-nav');
                    const ordersNav = document.getElementById('orders-nav');
                    const returnsNav = document.getElementById('returns-nav');
                    const cancellationNav = document.getElementById('cancellation-nav');
                    const wishlistNav = document.getElementById('wishlist-nav');


                    // Add event listener to the parent element
                    document.querySelector('.sidebar-list').addEventListener('click', (event) => {
                        const target = event.target;
                        const id = target.closest('.sidebar-list-item').id;

                        // Handle different menu items based on their IDs
                        switch (id) {
                            case 'tomanage-acc':
                                window.location.href = '<?= ROOT ?>/customer/index';
                                break;
                            case 'toprofile':
                                window.location.href = '<?= ROOT ?>/customer/myProfile';
                                break;
                            case 'toaddress-book':
                                window.location.href = '<?= ROOT ?>/customer/addressbook';
                                break;
                            case 'toorders':
                                window.location.href = '<?= ROOT ?>/customer/orders';
                                break;
                            case 'toreturns':
                                window.location.href = '<?= ROOT ?>/customer/returns';
                                break;
                            case 'tocancellations':
                                window.location.href = '<?= ROOT ?>/customer/cancellations';
                                break;
                            case 'toreviews':
                                window.location.href = '<?= ROOT ?>/customer/reviews';
                                break;
                            case 'towishlist':
                                window.location.href = '<?= ROOT ?>/customer/wishlist';
                                break;
                            case 'tohome':
                                window.location.href = '<?= ROOT ?>';
                                break;
                            case 'toregister':
                                window.location.href = '<?= ROOT ?>/signup';
                                break;
                            case 'tologin':
                                window.location.href = '<?= ROOT ?>/login';
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