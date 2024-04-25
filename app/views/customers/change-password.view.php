        <style>
            /* -- change password -- */
            .content-change-password {
                padding: 30px;
                background-color: var(--bg2);
                border-radius: 20px;
                padding-top: 50px;
                margin-left: 60px;
            }

            .field-change-password {
                margin-bottom: 10px;
            }

            .info-label {
                width: 20%;
                margin: 10px;
            }

            .label-with-eye {
                display: flex;
                margin-bottom: 10px;
            }

            .label-with-eye .eye-icon {
                cursor: pointer;
                margin-left: 5px;
                display: flex;
                align-items: center;
            }

            .input-wrapper {
                width: 70%;
                border-radius: 10px;
                display: flex;
            }

            .form-control {
                border: 1px solid var(--bg2);
                transition: border-color 0.3s ease;
                border-radius: 10px;
                padding: 10px;
            }

            .form-control:focus {
                border-color: var(--green2);
                outline: none;
                box-shadow: 0 0 5px var(--green2);
            }

            .eye-icon {
                cursor: pointer;
            }

            .eye-icon .material-icons {
                font-size: 20px;
                color: var(--bg1);
            }

            .save-changes-edit-profile, .cancel-edit-profile {
                background-color: var(--coal_black);
                color: var(--white);
                border: none;
                border-radius: 10px;
                padding: 8px 12px;
                cursor: pointer;
                transition: background-color 0.3s;
                width: 250px;
                font-size: 1em;
                margin-bottom: 10px;
            }

            .save-changes-edit-profile:hover, .cancel-edit-profile:hover {
                background-color: var(--green1);
            }

            .bottom-profile {
                display: flex;
                flex-direction: column;
                align-items:flex-end; 
                margin-top: 60px;
            }
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
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('profile') ? 'selected' : '' ?>" id="profile-nav">
                            <a href="<?=ROOT?>/profile"><span style="margin-left: 5px;">My Profile</span></a>
                        </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editProfile') ? 'selected' : '' ?>" id="editp-nav">
                                <a href="<?=ROOT?>/profile/editProfile">Edit Profile<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editAddress') ? 'selected' : '' ?>" id="edita-nav">
                                <a href="<?=ROOT?>/profile/editAddress">Edit Address<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title selected <?= isCurrentPage('password') ? 'selected' : '' ?>" id="password-nav">
                                <a href="<?=ROOT?>/profile/password">Change Password<span style="margin-left: 35px;"></span></a>
                            </li>
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('orders') ? 'selected' : '' ?>" id="orders-nav">
                            <a href="<?=ROOT?>/orders/orders"><span style="margin-left: 5px;">My Orders</span></a>
                        </li>
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('bulkOrders') ? 'selected' : '' ?>" id="bulk-nav">
                            <a href="<?=ROOT?>/orders/bulkOrders"><span style="margin-left: 5px;">My Bulk Orders</span></a>
                        </li>
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('review') ? 'selected' : '' ?>" id="review-nav">
                            <a href="<?=ROOT?>/review"><span style="margin-left: 5px;">My Reviews</span></a>
                        </li>
                    </ul>
            </div>

        <!-- change password -->
        <div class="container">
            <div class="title">
                <h2>Change Password</h2>
            </div>

            <div class="content-change-password">
                <form method="post" action="<?= ROOT ?>/profile/editPW">
                    <div class="field-change-password">
                        <label class="label-with-eye" for="current-password">
                            <span class="info-label">Current Password</span>
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Enter your current password">
                                <div class="eye-icon" onclick="togglePasswordVisibility('current-password')">
                                    <i class="material-icons closed-eye">visibility_off</i>
                                    <i class="material-icons open-eye" style="display: none;">visibility</i>
                                </div>
                            </div>
                        </label>
                    </div>
        
                    <div class="field-change-password">
                        <label class="label-with-eye" for="new-password">
                            <span class="info-label">New Password</span>
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Enter your new password">
                                <div class="eye-icon" onclick="togglePasswordVisibility('new-password')">
                                    <i class="material-icons closed-eye">visibility_off</i>
                                    <i class="material-icons open-eye" style="display: none;">visibility</i>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="field-change-password">
                        <label class="label-with-eye" for="retype-password">
                            <span class="info-label">retype Password</span>
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="retype-password" name="retype-password" placeholder="Retype your password">
                                <div class="eye-icon" onclick="togglePasswordVisibility('retype-password')">
                                    <i class="material-icons closed-eye">visibility_off</i>
                                    <i class="material-icons open-eye" style="display: none;">visibility</i>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="bottom-profile">
                        <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                        <a href="<?=ROOT?>/profile/myProfile"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>