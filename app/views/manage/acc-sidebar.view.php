    <div class="grid-container">
    

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
                       <span style="margin-left: 5px;">Manage My Account</span>
                    </a>
                </li>
                <li class="sidebar-list-item nav-btn" id="production-nav">
                    <a>
                       
                       
                        <span style="margin-left: 5px;">My Orders</span>
                    </a>
                </li>

                <li class="sidebar-list-item nav-btn" id="orders-nav">
                    <a>
                        
                        <span style="margin-left: 5px;">My Reviews</span>
                    </a>
                </li>

                <li class="sidebar-list-item nav-btn" id="workers-nav">
                    <a>
                       
                        <span style="margin-left: 5px;">My WishList & Followed Store</span>
                    </a>
                </li>

            </ul>

            <li class="sidebar-list-item sidebar-logout" id="logoutBtn">
                <a>
                    <span class="material-icons-outlined">logout</span><span style="margin-left: 5px;">Logout</span>
                </a>
            </li>

            <!-- <script>
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
            </script> -->
        </aside>
        <div class="main-container"></div>
    </div>










        <style>
            *,
*::before,
*::after {
    box-sizing: border-box;
}

body,
h1,
h2,
h3,
h4,
p,
figure,
blockquote,
dl,
dd {
    margin: 0;
}

ul,
ol {
    margin: 0;
    padding: 0;
    list-style: none;
}

figure,
blockquote,
dl,
dd {
    padding: 0;
}

body {
    min-height: 100vh;
    scroll-behavior: smooth;
    text-rendering: optimizeSpeed;
    line-height: 1.5;
}

ul,
ol {
    list-style: none;
}

a:not([class]) {
    text-decoration-skip-ink: auto;
}

img {
    max-width: 100%;
    display: block;
}

article> {
    margin-top: 1em;
}

input,
button,
textarea,
select {
    font: inherit;
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}

/* Variables */
:root {
    --primary: #6D9886;
    --secondary: #D9CAB3;
    --blk: #212121;
    --light: #F6F6F6;

    --danger: #DD4A48;
    --dangerlight: #F2B6A0;

    --pending: #FCEEBA;
    --processing: #D5E9C5;
    --completed: #C1E5ED;
}

/* Base */
html {
    font-family: 'Montserrat', sans-serif;
    font-size: 16px;
    /* font-weight: 400; */
    color: var(--blk);
}

body {
    background-color: var(--light);
}

h1,
h2,
h3,
h4,
h5,
h6 {
    color: var(--blk);
    font-weight: 600;
}


.grid-container {
    display: flex;
    flex-direction: row;
    grid-template-columns: 260px 1fr 1fr 1fr;
    grid-template-rows: 0.2fr 3fr;
    grid-template-areas:
        "sidebar header header header"
        "sidebar main main main";
    height: 100vh;
   
}

#sidebar {
    grid-area: sidebar;
    height: 100%;
    background-color: var(--primary);
    color: var(--blk);
    overflow-y: auto;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    border-radius: .5rem;
}

.sidebar-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 20px 20px 20px;
    margin-bottom: 30px;
}

.sidebar-title>span {
    display: none;
}

.sidebar-brand {
    margin-top: 15px;
    font-size: 26px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sidebar-list {
    padding: 0;
    margin-top: 15px;
    list-style-type: none;
}

.sidebar-list-item {
    padding: 20px 20px 20px 20px;
    color: var(--blk);
    text-decoration: none;
    /* transition: all 0.4s ease-in-out; */
    display: flex;
    align-items: center;
    font-weight: 500;
    /* justify-content: center; */
}

.sidebar-list-item>a {
    text-decoration: none;
    color: var(--blk);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sidebar-list-item:hover {
    color: var(--light);
    background-color: var(--blk);
    cursor: pointer;
}

.sidebar-list-item:hover>a {
    color: var(--light);
}

.selected {
    color: var(--light);
    background-color: var(--blk);
}

.selected>a {
    color: var(--light);
}

.sidebar-responsive {
    display: inline !important;
    position: absolute;
    /*
      the z-index of the ApexCharts is 11
      we want the z-index of the sidebar higher so that
      the charts are not showing over the sidebar 
      on small screens
    */
    z-index: 12 !important;
}

.sidebar-logout
{
    position: absolute;
    bottom: 0;
    width: 260px;
    cursor: pointer;
}
.sidebar-logout:hover
{
    background-color: var(--danger);
    cursor: pointer;
}
.sidebar-logout:hover > a
{
    color: var(--blk);
}