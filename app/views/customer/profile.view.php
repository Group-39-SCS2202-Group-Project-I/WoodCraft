        <?php $this->view('customer/acc-header', $data) ?>
        <br><br>
        <?php $this->view('customer/acc-sidebar', $data) ?> 

        <div class="main-container"> 

        <!-- my profile -->
        <div class="container">
            <div class="title">
                <h2>My Profile</h2>
            </div>

            <div class="content-profile">
                <div class="profile-info">
                    <span class="info-label">Full Name</span>
                    <span class="info-value">John Doe</span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Email</span>
                    <span class="info-value">john.doe@example.com</span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Mobile</span>
                    <span class="info-value">0715183937</span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Birthday</span>
                    <span class="info-value">2001-03-01</span>
                </div>
                <div class="profile-info">
                    <span class="info-label">Gender</span>
                    <span class="info-value">Male</span>
                </div>

                <div class="bottom-profile">
                    <a href="#" class="subscribe-link" onclick="showPopup()">Subscribe to our Newsletter</a>

                    <div class="buttons-profile">
                        <a href="edit-profile.view.php" class="edit-profile">EDIT PROFILE</a>
                        <a href="change-password.view.php" class="change-password">CHANGE PASSWORD</a>
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

                <div class="buttons">
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
</div></div>