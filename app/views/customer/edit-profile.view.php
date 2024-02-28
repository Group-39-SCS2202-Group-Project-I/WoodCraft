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
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?=get_value('email', $data['email'])?>">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="telephone">Mobile</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Enter your mobile number" value="<?=get_value('telephone', $data['telephone'])?>">
                        </div>
                    </div>
        
                    <!-- <div class="field-edit-profile">
                        <label for="birthday">Birthday</label>
                        <div class="input-wrapper">
                            <select id="birth-month" name="birth-month">
                                <option disabled selected>Month</option>
                            </select>
                            <select id="birth-day" name="birth-day">
                                <option disabled selected>Day</option>
                            </select>
                            <select id="birth-year" name="birth-year">
                                <option disabled selected>Year</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="gender">Gender</label>
                        <div class="input-wrapper">
                            <select id="gender" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div> -->
        
                    <a href="#" class="subscribe-link-edit-profile" onclick="showPopup()">Subscribe to our Newsletter</a>
                    <!-- <a href="<?=ROOT?>/customer/manage-account"><button type="button" class="save-changes-edit-profile" onclick="goToMyProfile()">SAVE CHANGES</button></a> -->
                    <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                    <a href="<?=ROOT?>/customer/index/<?= Auth::getCustomerId()?>"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
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