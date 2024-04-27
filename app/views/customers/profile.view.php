        <style>
            /* -- my profile -- */
            .content-profile {
                width: 80%;
                padding: 30px;
                background-color: var(--bg2);
                border-radius: 20px;
                margin-left: 60px;
            }

            .content-profile a {
                text-decoration: none;
                color: var(--green2);
                font-size: 12px;
            }

            .profile-info {
                margin-bottom: 10px;
            }

            .info-value {
                margin: 10px;
                padding: 10px;
                background-color: var(--light);
                align-content: center;
                width: 70%;
                border-radius: 10px;
            }

            .info-label {
                width: 15%;
            }

            .bottom-profile {
                display: flex;
                flex-direction: column;
                align-items:flex-end; 
            }

            .buttons-profile {
                text-align: center;
                margin-top: 20px;
                display: flex;
                justify-content: flex-end;
                flex-direction: column;
            }

            .buttons-profile a {
                display: block;
                margin-bottom: 10px;
                width: 250px;
                font-size: 1em;

                background-color: var(--coal_black);
                color: var(--white);
                border: none;
                border-radius: 10px;
                padding: 8px 12px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .buttons-profile a:hover {
                background-color: var(--green1);
            }

            /* .profile-subscribe-link {
                margin-top: 10px;
                cursor: pointer;
                width: 220px;
            } */
        </style>


        <?php $this->view('customers/acc-header', $data) ?>

        <div class="main-container"> 

            <!-- side bar -->
            <?php
            // Define the isCurrentPage function
            function isCurrentPage($pageName) {
                // Get the path part of the URL
                $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                // Check if the current path starts with the given page name
                return strncmp($currentPath, $pageName, strlen($pageName)) === 0;
            }
            ?>

            <div class="side-bar-customer">
                    <ul class="customer-sidebar-list">
                        <li class="customer-sidebar-list-item main-title selected <?= isCurrentPage('profile') ? 'selected' : '' ?>" id="profile-nav">
                            <a href="<?=ROOT?>/profile"><span style="margin-left: 5px;">My Profile</span></a>
                        </li>
                            <!-- <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editProfile') ? 'selected' : '' ?>" id="editp-nav">
                                <a href="<?=ROOT?>/profile/editProfile">Edit Profile<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editAddress') ? 'selected' : '' ?>" id="edita-nav">
                                <a href="<?=ROOT?>/profile/editAddress">Edit Address<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('password') ? 'selected' : '' ?>" id="password-nav">
                                <a href="<?=ROOT?>/profile/password">Change Password<span style="margin-left: 35px;"></span></a>
                            </li> -->
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('orders') ? 'selected' : '' ?>" id="orders-nav">
                            <a href="<?=ROOT?>/orders"><span style="margin-left: 5px;">My Orders</span></a>
                        </li>
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('bulkOrders') ? 'selected' : '' ?>" id="bulk-nav">
                            <a href="<?=ROOT?>/orders/bulk"><span style="margin-left: 5px;">My Bulk Orders</span></a>
                        </li>
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('review') ? 'selected' : '' ?>" id="review-nav">
                            <a href="<?=ROOT?>/review"><span style="margin-left: 5px;">My Reviews</span></a>
                        </li>
                    </ul>
            </div>

        <!-- my profile -->
        <div class="container">
            <div class="title">
                <h2>My Profile</h2>
            </div>

            <div class="content-profile">
                <div class="profile-info">
                    <span class="info-label">Full Name</span>
                    <span class="info-value"><?= $data['first_name'] ?> <?= $data['last_name'] ?></span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?= $data['email'] ?></span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Mobile</span>
                    <span class="info-value"><?= $data['telephone'] ?></span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Address</span>
                    <span class="info-value"><?= $data['address_line_1'] ?>, <?= $data['address_line_2'] ?></span>
                </div>
                <div class="profile-info">
                    <span class="info-label">City</span>
                    <span class="info-value"><?= $data['city'] ?></span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Zip Code</span>
                    <span class="info-value"><?= $data['zip_code'] ?></span>
                </div>
                <!-- <div class="profile-info">
                    <span class="info-label">Birthday</span>
                    <?php if (!empty($data['birth_day'])) : ?>
                        <span class="info-value"><?= $data['birth_day'] ?> - <?= $data['birth_month'] ?> - <?= $data['birth_year'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="profile-info">
                    <span class="info-label">Gender</span>
                    <span class="info-value"><?= $data['gender'] ?></span>
                </div> -->

                <div class="bottom-profile">
                    <!-- <div class="profile-subscribe-link">
                        <a href="#" class="subscribe-link" onclick="showPopup()">Subscribe to our Newsletter</a>
                    </div> -->

                    <div class="buttons-profile">
                        <a href="<?=ROOT?>/profile/editProfile" class="edit-profile">EDIT PROFILE</a>
                        <a href="<?=ROOT?>/profile/editAddress">EDIT ADDRESS</a>
                        <!-- <a href="<?=ROOT?>/profile/password" class="change-password">CHANGE PASSWORD</a> -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Popup for newsletter subscription -->
        <!-- <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h3>Newsletter subscription</h3>
                <p>I have read and understood <a href="##">Privacy Policy</a></p>

                <div class="buttons">
                    <button class="cancel" onclick="closePopup()">Cancel</button>
                    <button class="subscribe" onclick="subscribe()">Subscribe</button>
                </div>
            </div>
        </div> -->
    </main>

    <script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>