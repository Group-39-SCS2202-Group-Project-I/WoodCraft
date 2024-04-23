<?php $this->view('customers/acc-header', $data) ?>
        <br><br>
        <?php $this->view('customers/acc-sidebar', $data) ?> 

        <div class="main-container"> 

        <!-- my profile -->
        <div class="container">
            <div class="title">
                <h2>My Profile</h2>
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