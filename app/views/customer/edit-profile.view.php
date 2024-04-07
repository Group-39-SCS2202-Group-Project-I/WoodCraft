        <?php $this->view('customer/acc-header', $data) ?>
        <br><br>
        <?php $this->view('customer/acc-sidebar', $data) ?> 

        <div class="main-container">

        <!-- edit profile -->
        <div class="container">
            <div class="title">
                <h2>Edit Profile</h2>
            </div>

            <div class="content-edit-profile">
                <form method="post" action="<?= ROOT ?>/customer/updateProfile/<?= Auth::getCustomerID()?>">
                    <div class="field-edit-profile">
                        <label for="first_name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" value="<?=get_value('first_name', $data['first_name'])?>">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="full-name">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Enter your last name" value="<?=get_value('last_name', $data['last_name'])?>">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <!-- <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?=get_value('email', $data['email'])?>">
                        </div> -->
                        <!-- Disable the email input field -->
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?=get_value('email', $data['email'])?>" disabled>
                        </div>
                        <!-- Show an error message -->
                        <!-- <span class="error-message">You are not allowed to change your email address.</span> -->
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="telephone">Mobile</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Enter your mobile number" value="<?=get_value('telephone', $data['telephone'])?>">
                        </div>
                    </div>

                    <!-- Birthday select options -->
                    <?php
                    // Define months, days, and years arrays
                    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    $days = range(1, 31);
                    $years = range(date("Y"), date("Y") - 100);

                    // Function to generate select options
                    function generateOptions($array, $selectedValue) {
                        $options = "";
                        foreach ($array as $value) {
                            $selected = ($selectedValue == $value) ? "selected" : "";
                            $options .= "<option value='$value' $selected>$value</option>";
                        }
                        return $options;
                    }
                    ?>

                    <!-- Birthday select fields -->
                    <div class="field-edit-profile">
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
                    </div>

                    <!-- Gender select field -->
                    <div class="field-edit-profile">
                        <label for="gender">Gender</label>
                        <div class="input-wrapper">
                            <select id="gender" name="gender">
                                <option disabled selected>Select Gender</option>
                                <option value="male" <?= ($data['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= ($data['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div>


                    <a href="#" class="subscribe-link-edit-profile" onclick="showPopup()">Subscribe to our Newsletter</a>
                    <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                    <!-- <a href="<?=ROOT?>/customer/profile/<?= Auth::getCustomerId()?>"><button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button></a> -->
                    <a href="<?=ROOT?>/customer/profile/<?= Auth::getCustomerId()?>"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
                </form>
            </div>
        </div>

        <!-- Popup for newsletter subscription -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h3>Newsletter subscription</h3>
                <p>I have read and understood <a href="##.html">Privacy Policy</a></p>

                <div class="buttons-popup">
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