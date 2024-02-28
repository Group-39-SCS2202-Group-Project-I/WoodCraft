<?php $this->view('customer/acc-header', $data) ?>
<br><br>
<?php $this->view('customer/acc-sidebar', $data) ?>
        
        <div class="main-container"> 

        <?php show($data); ?>

        <!-- edit addressbook -->
        <div class="container">
            <div class="title">
                <h2>Edit Address</h2>
            </div>

            <div class="content-edit-profile">
                <form method="post">
                    <div class="field-edit-profile">
                        <label for="first-name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="first-name" name="first-name" value="<?=get_value('first_name', $data['first_name'])?>" placeholder="Enter your first name">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="last-name">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="last-name" name="last-name" value="<?=get_value('last_name', $data['last_name'])?>" placeholder="Enter your last name">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="telephone">Mobile</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="telephone" name="telephone" value="<?=get_value('telephone', $data['telephone'])?>" placeholder="Enter your mobile number">
                        </div>
                    </div>

                    <!-- <div class="field-edit-profile">
                        <label for="province">Province</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="province" name="province" value="<?=get_value('province', $data['province'])?>" placeholder="Choose your province">
                        </div>
                    </div> -->
        
                    <div class="field-edit-profile">
                        <label for="city">City</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="city" name="city" value="<?=get_value('city', $data['city'])?>" placeholder="Choose your city">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address">Address</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address" name="address" value="<?=get_value('address_line_1', $data['address_line_1'])?> <?=get_value('address_line_2', $data['address_line_2'])?>" placeholder="House no. / building / street / area">
                        </div>
                    </div>
        
                    <!-- <div class="field-edit-profile">
                        <label for="landmark">Landmark (optional)</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="landmark" name="landmark" value="<?=get_value('land_mark', $data['land_mark'])?>" placeholder="E.g. beside train station">
                        </div>
                    </div> -->
        
                    <button type="button" class="save-changes-edit-profile" onclick="goToMyProfile()">SAVE CHANGES</button>
                    <a href="<?=ROOT?>/customer/manage-account"><button type="button" class="cancel-edit-profile" onclick="goToMyProfile()">CANCEL</button></a>
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