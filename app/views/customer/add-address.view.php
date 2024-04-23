<?php $this->view('customer/acc-header', $data) ?>
<br><br>
<?php $this->view('customer/acc-sidebar', $data) ?>
        
    <div class="main-container fixed-container">


        <!-- edit addressbook -->
        <div class="container">
            <div class="title">
                <h2>Add New Address</h2>
            </div>

            <div class="content-edit-profile">
                <form method="post" action="<?= ROOT ?>/customer/addAddress/<?= Auth::getCustomerId()?>">
                    <div class="field-edit-profile">
                        <label for="full-name">First Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Enter your first name">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="full-name">Last Name</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Enter your last name">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="mobile">Mobile</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="mobile">City</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your city">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address">Zip Code</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter zipcode">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address">Address Line 1</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address" name="address" placeholder="House no. / building / street / area">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="address">Address Line 2</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="address" name="address" placeholder="street / area">
                        </div>
                    </div>
        
                    <button type="submit" class="save-changes-edit-profile">SAVE CHANGES</button>
                    <a href="<?=ROOT?>/customer/addressbook/<?= Auth::getCustomerId()?>"><button type="button" class="cancel-edit-profile">CANCEL</button></a>
                </form>
            </div>
        </div>
    </main>

    <script src="manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>