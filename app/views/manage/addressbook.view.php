        <?php $this->view('manage/acc-header', $data) ?>
        <?php $this->view('manage/acc-sidebar', $data) ?> 
        
        <!-- address book -->
        <div class="container">
            <div class="title">
                <h2>Address Book</h2>
                <div class="new-address">
                    <a href="##.html" class="add-address-link"><span class="highlight-plus">+</span> Add New Address</a>
                </div>
            </div>

            <div class="content-addressbook">
                <div class="address-box">
                    <div class="edit-option">
                        <a href="#">EDIT</a>
                    </div>
        
                    <!-- Address information -->
                    <div class="address-info">
                        <div class="info-value">John Doe</div>
                        <div class="info-value">0712345678</div>
                        <div class="info-value">123 Main Street, City</div>
        
                        <div class="addotional-addressbook">
                            <div class="address-type">Home Address</div>
                            <div class="additional-info">Default Delivery Address</div>
                            <div class="additional-info">Default Billing Address</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

<?php $this->view('includes/footer', $data) ?>
</html>
