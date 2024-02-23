        <?php $this->view('manage/acc-header', $data) ?>
        <?php $this->view('manage/acc-sidebar', $data) ?> 

        <!-- manage my account -->
        <div class="container">
            <div class="title">
                <h2>Manage My Account</h2>
            </div>
                
            <div class="content">
                <div class="profile">
                    <div class="content-title">
                        <h3>Personal Profile  <span class="highlight">|</span>
                        <a href="<?=ROOT?>/manage/edit-profile">EDIT</a></h3>
                    </div>

                    <div class="profile-content">
                        <div class="profile-info">
                            <span class="info-value"><?=esc($row->firstname)?> <?=esc($row->lastname)?></span>
                        </div>
                        <div class="profile-info">
                            <span class="info-value"><?=esc($row->email)?>/span>
                        </div>
                    </div>

                    <a href="#" class="subscribe-link-manage-account" onclick="showPopup()">Subscribe to our Newsletter</a>
                </div>
                
                <div class="address">
                    <div class="content-title">
                        <h3>Address Book  <span class="highlight">|</span>
                        <a href="addressbook.view.php">EDIT</a></h3>
                    </div>
                    <div class="address-content">
                        <div class="shipping">
                            DEFAULT SHIPPING ADDRESS
                        </div>
                        <div class="billing">
                            DEFAULT BILLING ADDRESS
                        </div>
                    </div> 
                </div>
            </div>
        </div> 
        
        <!-- Popup for newsletter subscription -->
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h3>Newsletter subscription</h3>
                <p>I have read and understood <a href="##">Privacy Policy</a></p>

                <div class="buttons-popup">
                    <button class="cancel" onclick="closePopup()">Cancel</button>
                    <button class="subscribe" onclick="subscribe()">Subscribe</button>
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo ROOT; ?>/assets/js/manage-account.js"></script>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>