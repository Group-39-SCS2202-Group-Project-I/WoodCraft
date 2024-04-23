<?php $this->view('customers/acc-header', $data) ?>
<br><br>
<?php $this->view('customers/acc-sidebar', $data) ?>
        
        <div class="main-container"> 

        <!-- <?php show($data); ?> -->

        <!-- edit addressbook -->
        <div class="container">
            <div class="title">
                <h2>Edit Address</h2>
            </div>

            <div class="content-edit-profile">
                <form method="post" action="<?= ROOT ?>/profile/updateAddress/<?= Auth::getCustomerID() ?>">  
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
        
                    <div class="field-edit-profile">
                        <label for="city">City</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="city" name="city" value="<?=get_value('city', $data['city'])?>" placeholder="Enter your city">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address">Zip Code</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address" name="address" value="<?=get_value('zip_code', $data['zip_code'])?>" placeholder="Enter zipcode">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address">Address Line 1</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address" name="address" value="<?=get_value('address_line_1', $data['address_line_1'])?>" placeholder="House no. / building / street / area">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address">Address Line 2</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address" name="address" value="<?=get_value('address_line_2', $data['address_line_2'])?>" placeholder="street / area">
                        </div>
                    </div>
        
                    <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                    <a href="<?=ROOT?>/profile/addressbook/<?= Auth::getCustomerId()?>"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
                </form>
            </div>
        </div>
    </main>

    <script src="manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>