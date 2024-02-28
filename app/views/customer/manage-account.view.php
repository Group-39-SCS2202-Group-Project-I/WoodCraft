        
        <?php $this->view('customer/acc-header', $data) ?>
        <br><br>
        <?php $this->view('customer/acc-sidebar', $data) ?>

        <!-- <?= show($data)?> -->
        
        <div class="main-container">
        <!-- <?= show($data) ?> -->

        

        <!-- manage my account -->
            <div class="container">
                <div class="title">
                    <h2>Manage My Account</h2>
                </div>
                    
                <div class="content">
                    <div class="profile">
                        <div class="content-title">
                            <h3>Personal Profile  <span class="highlight">|</span>
                            <a href="<?=ROOT?>/customer/editProfile">EDIT</a></h3>
                        </div>

                        <div class="profile-content">
                            <?php if (isset($data) && $data): ?>
                                <div class="profile-info">
                                    <span class="info-value"><?= esc($data['first_name']) ?> <?= esc($data['last_name']) ?></span>
                                </div>
                                <div class="profile-info">
                                    <span class="info-value"><?= esc($data['email']) ?></span>
                                </div>
                            <?php else: ?>
                                <p>User data not available</p>
                            <?php endif; ?>
                        </div>

                        <a href="#" class="subscribe-link" onclick="showPopup()">Subscribe to our Newsletter</a>
                    </div>
                    
                    <div class="address">
                        <div class="content-title">
                            <h3>Address Book  <span class="highlight">|</span>
                            <a href="<?=ROOT?>/customer/editAddressbook">EDIT</a></h3>
                        </div>
                        <div class="address-content">
                            <?php if (isset($data) && $data && isset($data)): ?>
                                <div class="profile-info">
                                    <span class="info-value"><?= esc($data['first_name']) ?> <?= esc($data['last_name']) ?></span>
                                </div>
                                <div class="profile-info">
                                    <span class="info-value"><?= esc($data['telephone']) ?></span>
                                </div>

                                <!-- Display address information -->
                                <div class="profile-info">
                                    <span class="info-value"><?= esc($data['address_line_1']) ?> <?= esc($data['address_line_2']) ?>.</span>
                                </div>
                            <?php else: ?>
                                <div class="shipping">
                                    DEFAULT SHIPPING ADDRESS
                                </div>
                                <div class="billing">
                                    DEFAULT BILLING ADDRESS
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div> 
            
            <!-- Popup for newsletter subscription -->
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h3>Newsletter subscription</h3>
                    <p>I have read and understood <a href="##">Privacy Policy</a></p>

                    <div class="buttons-popup">
                        <button class="cancel" onclick="closePopup()">Cancel</button>
                        <button class="subscribe" onclick="subscribe()">Subscribe</button>
                    </div>
                </div>
            </div>
        </main>

        <script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>
    </body>

    <?php $this->view('includes/footer', $data) ?>

</html>
</div></div>

    <script>
        document.querySelector('.nav-main').addEventListener('click', (event) => {
            const target = event.target;
            const id = target.id;

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


    </script>


    <!-- styles for sidebar -->
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
            /* grid-template-columns: 260px 1fr 1fr 1fr; */
            /* grid-template-rows: 0.2fr 3fr; */
            /* grid-template-areas:
                "sidebar header header header"
                "sidebar main main main"; */
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
            margin-top: 25px;
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

    </style>
