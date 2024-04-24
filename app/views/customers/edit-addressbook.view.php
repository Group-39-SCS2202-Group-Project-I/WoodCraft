        <style>
            /* -- edit address -- */
            .content-edit-profile {
                padding: 30px;
                background-color: var(--bg2);
                border-radius: 20px;
            }

            .field-edit-profile {
                margin-bottom: 10px;
                display: flex;
            }

            label {
                font-weight: bold;
                width: 15%;
                padding: 10px;
            }

            .input-wrapper {
                background-color: var(--white);
                width: 80%;
                border-radius: 10px;
            }

            .form-control {
                border: 1px solid #ccc;
                transition: border-color 0.3s ease;
                border-radius: 10px;
                padding: 10px;
            }

            .form-control:focus {
                border-color: #007bff;
                outline: none;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }

            select {
                padding: 10px;
                margin: 8px 0;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .form-control:focus {
                border-color: #007bff;
                outline: none;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
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
                margin-top: 60px;
            }
        </style>

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