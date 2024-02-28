    <?php $this->view('customer/acc-header', $data) ?>
    <br><br>
    <?php $this->view('customer/acc-sidebar', $data) ?>
        
        <div class="main-container"> 
        
        <!-- address book -->
        <div class="container">
            <div class="title">
                <h2>Address Book</h2>
                <div class="new-address">
                    <a href="<?=ROOT?>/customer/add-address" class="add-address-link"><span class="highlight-plus">+</span> Add New Address</a>
                </div>
            </div>

            <div class="content-addressbook">
                <div class="address-box">
                    <div class="edit-option">
                        <a href="<?=ROOT?>/customer/edit-addressbook">EDIT</a>
                    </div>
        
                    <!-- Address information -->
                    <div class="address-info">
                        <div class="info-value"><?= esc($data['first_name']) ?> <?= esc($data['last_name']) ?></div>
                        <div class="info-value"><?= esc($data['telephone']) ?></div>
                        <div class="info-value"><?= esc($data['address_line_1']) ?> <?= esc($data['address_line_2']) ?>.</div>
        
                        <div class="additional-addressbook">
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
</div></diV>
