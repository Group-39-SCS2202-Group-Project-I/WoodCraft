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
                <form>
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
                        <label for="full-name">Province</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Choose your province">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="mobile">City</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Choose your city">
                        </div>
                    </div>

                    <div class="field-edit-profile">
                        <label for="full-name">Address</label>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" id="full-name" name="full-name" placeholder="House no. / building / street / area">
                        </div>
                    </div>
        
                    <div class="field-edit-profile">
                        <label for="mobile">Landmark (optional)</label>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="E.g. beside train station">
                        </div>
                    </div>
        
                    <button type="button" class="save-changes-edit-profile" onclick="goToMyProfile()">SAVE CHANGES</button>
                    <a href="<?=ROOT?>/customer/addressbook"><button type="button" class="cancel-edit-profile" onclick="goToMyProfile()">CANCEL</button>
                </form>
            </div>
        </div>
    </main>

    <script src="manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
</div></div>