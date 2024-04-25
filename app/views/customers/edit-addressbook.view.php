        <style>
            /* -- edit address -- */
            .content-edit-profile {
                padding: 30px;
                background-color: var(--bg2);
                border-radius: 20px;
                padding-top: 50px;
                margin-left: 60px;
            }

            .field-edit-profile {
                margin-bottom: 10px;
                display: flex;
            }

            label {
                font-weight: bold;
                width: 20%;
                padding: 10px;
            }

            .input-wrapper {
                /* background-color: var(--light); */
                width: 70%;
                border-radius: 10px;
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

            .subscribe-link-edit-profile {
                display: block;
                margin-top: 20px;
                color: var(--green2);
                cursor: pointer;
                font-size: 12px;
                padding-top: 20px;
                width: 220px;
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
                /* margin: 10px; */
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
                            <!-- <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editProfile') ? 'selected' : '' ?>" id="editp-nav">
                                <a href="<?=ROOT?>/profile/editProfile">Edit Profile<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title selected <?= isCurrentPage('editAddress') ? 'selected' : '' ?>" id="edita-nav">
                                <a href="<?=ROOT?>/profile/editAddress">Edit Address<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('password') ? 'selected' : '' ?>" id="password-nav">
                                <a href="<?=ROOT?>/profile/password">Change Password<span style="margin-left: 35px;"></span></a>
                            </li> -->
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('orders') ? 'selected' : '' ?>" id="orders-nav">
                            <a href="<?=ROOT?>/orders"><span style="margin-left: 5px;">My Orders</span></a>
                        </li>
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('bulkOrders') ? 'selected' : '' ?>" id="bulk-nav">
                            <a href="<?=ROOT?>/orders/bulkOrders"><span style="margin-left: 5px;">My Bulk Orders</span></a>
                        </li>
                        <li class="customer-sidebar-list-item main-title <?= isCurrentPage('review') ? 'selected' : '' ?>" id="review-nav">
                            <a href="<?=ROOT?>/review"><span style="margin-left: 5px;">My Reviews</span></a>
                        </li>
                    </ul>
            </div>

        <!-- edit addressbook -->
        <div class="container">
            <div class="title">
                <h2>Edit Address</h2>
            </div>

            <div class="content-edit-profile">
                <form method="post" action="<?= ROOT ?>/profile/updateAddress/<?= Auth::getCustomerID() ?>">  
                    <div class="field-edit-profile">
                        <label for="first_name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?=get_value('first_name', $data['first_name'])?>" placeholder="Enter your first name">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="last_name">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?=get_value('last_name', $data['last_name'])?>" placeholder="Enter your last name">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="telephone">Mobile</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="telephone" name="telephone" value="<?=get_value('telephone', $data['telephone'])?>" placeholder="Enter your mobile number">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="city">City</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="city" name="city" value="<?=get_value('city', $data['city'])?>" placeholder="Enter your city">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="zip_code">Zip Code</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?=get_value('zip_code', $data['zip_code'])?>" placeholder="Enter zipcode">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address_line_1">Address Line 1</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address_line_1" name="address_line_1" value="<?=get_value('address_line_1', $data['address_line_1'])?>" placeholder="House no. / building / street / area">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address_line_2">Address Line 2</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="<?=get_value('address_line_2', $data['address_line_2'])?>" placeholder="street / area">
                        </div>
                    </div>

                    <div class="bottom-profile">
                        <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                        <a href="<?=ROOT?>/profile/myProfile/<?= Auth::getCustomerId()?>"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
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