        <style>
            /* -- edit profile -- */
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

            select {
                padding: 10px;
                margin: 8px 0;
                box-sizing: border-box;
                border: 1px solid var(--bg2);
                border-radius: 5px;
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

            .content-edit-profile a {
                text-decoration: none;
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
            }

            .buttons-profile {
                text-align: center;
                margin-top: 20px;
                display: flex;
                justify-content: flex-end;
                flex-direction: column;
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
                            <li class="customer-sidebar-list-item sub-title selected <?= isCurrentPage('editProfile') ? 'selected' : '' ?>" id="editp-nav">
                                <a href="<?=ROOT?>/profile/editProfile">Edit Profile<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('editAddress') ? 'selected' : '' ?>" id="edita-nav">
                                <a href="<?=ROOT?>/profile/editAddress">Edit Address<span style="margin-left: 35px;"></span></a>
                            </li>
                            <li class="customer-sidebar-list-item sub-title <?= isCurrentPage('password') ? 'selected' : '' ?>" id="password-nav">
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

        <!-- edit profile -->
        <div class="container">
            <div class="title">
                <h2>Edit Profile</h2>
            </div>

            <div class="content-edit-profile">
                <form method="post" action="<?= ROOT ?>/profile/updateProfile/<?= Auth::getCustomerID()?>">
                    <div class="field-edit-profile">
                        <label for="first_name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" value="<?=get_value('first_name', $data['first_name'])?>">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="last_-name">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" value="<?=get_value('last_name', $data['last_name'])?>">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                        <!-- Disable the email input field -->
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?=get_value('email', $data['email'])?>" disabled>
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="telephone">Mobile</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Enter your mobile number" value="<?=get_value('telephone', $data['telephone'])?>">
                        </div>
                    </div>

                    <!-- Birthday select options -->
                    <!-- <?php
                    // Define months, days, and years arrays
                    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    $days = range(1, 31);
                    $years = range(date("Y"), date("Y") - 100);

                    // select options
                    function generateOptions($array, $selectedValue) {
                        $options = "";
                        foreach ($array as $value) {
                            $selected = ($selectedValue == $value) ? "selected" : "";
                            $options .= "<option value='$value' $selected>$value</option>";
                        }
                        return $options;
                    }
                    ?> -->

                    <!-- Birthday select fields -->
                    <!-- <div class="field-edit-profile">
                        <label for="birthday">Birthday</label>
                        <div class="input-wrapper">
                            <select id="birth-month" name="birth-month">
                                <option disabled selected>Month</option>
                                <?= generateOptions($months, $data['birth_month']) ?>
                            </select>
                            <select id="birth-day" name="birth-day">
                                <option disabled selected>Day</option>
                                <?= generateOptions($days, $data['birth_day']) ?>
                            </select>
                            <select id="birth-year" name="birth-year">
                                <option disabled selected>Year</option>
                                <?= generateOptions($years, $data['birth_year']) ?>
                            </select>
                        </div>
                    </div> -->

                    <!-- Gender select field -->
                    <!-- <div class="field-edit-profile">
                        <label for="gender">Gender</label>
                        <div class="input-wrapper">
                            <select id="gender" name="gender">
                                <option disabled selected>Select Gender</option>
                                <option value="male" <?= ($data['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= ($data['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="bottom-profile">
                        <a href="#" class="subscribe-link-edit-profile" onclick="showPopup()">Subscribe to our Newsletter</a>
                        <div class="buttons-profile">
                            <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                            <a href="<?=ROOT?>/profile/myProfile/<?= Auth::getCustomerId()?>"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Popup for newsletter subscription -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h3>Newsletter subscription</h3>
                <p>I have read and understood <a href="##">Privacy Policy</a></p>

                <div class="buttons">
                    <button class="cancel" onclick="closePopup()">Cancel</button>
                    <button class="subscribe" onclick="subscribe()">Subscribe</button>
                </div>
            </div>
        </div>
    </main>

    <script src="manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>